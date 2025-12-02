<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">

<style>
    .contenido-archivo {
        font-size: 16px;
        /* Tamaño de fuente más grande */
        overflow: auto;
        /* Permitir que el contenido se ajuste sin barras de desplazamiento */
        white-space: pre-wrap;
        /* Mantener el formato del texto */
    }

    .tabla-container {
        max-height: 400px;
        /* Altura máxima del contenedor */
        overflow-y: auto;
        /* Scroll vertical automático */
    }

    .my-table th,
    .my-table td {
        font-size: 12px;
        /* Ajusta el tamaño de la letra según tus preferencias */
    }
</style>
@include('layouts.tableStyle')

<body>
    <main class="main" id="top">
        @include('layouts.menu')
        <div class="content">
            <section class="pt-1 pb-9">
                <div class="row g-3 mb-6">
                    <div class="col-12 col-lg-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="border-bottom border-dashed border-300 pb-4">
                                    <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start mb-4">
                                        <div class="col-12 col-sm-auto">
                                            <h4 class="mb-3">Base de Conocimiento</h4>
                                        </div>
                                    </div>

                                    <!-- Select de atenciones -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="selectAtencion" class="form-label fw-bold">Seleccionar
                                                Atención:</label>
                                            <select id="selectAtencion" class="form-select"data-choices="data-choices"
                                                data-options='{"removeItemButton":true,"placeholder":true}'>
                                                <option value="">-- Seleccione una atención --</option>
                                                @foreach ($atenciones as $atencion)
                                                    <option value="{{ $atencion->id }}">{{ $atencion->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Buscador -->
                                    <div id="buscadorContainer" class="row mb-3" style="display:none;">
                                        <div class="col-md-5">
                                            <input type="text" id="buscadorSolucion" class="form-control"
                                                placeholder="Buscar solución por título o descripción...">
                                        </div>
                                    </div>

                                    <!-- Tabla -->
                                    <div id="tablaSoluciones" style="display:none;">
                                        <table id="soluciones-table"
                                            class="table table-striped table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%;text-align:center;">ID</th>
                                                    <th style="width:30%;">Título</th>
                                                    <th style="width:35%;">Descripción</th>
                                                    <th style="width:10%;text-align:center;">Tickets</th>
                                                    <th style="width:15%;text-align:center;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="solucionesBody">
                                                <!-- Se llena dinámicamente -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Modal Detalle -->
                                    <div class="modal fade" id="modalSolucion" tabindex="-1"
                                        aria-labelledby="modalSolucionLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalSolucionLabel">Detalle de Solución
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 id="tituloSolucion" class="fw-bold"></h5>
                                                    <hr>
                                                    <p id="descripcionSolucion" style="white-space: pre-wrap;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /border -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('layouts.footer')
        </div>
        @extends('layouts.chat')
    </main>
    @extends('layouts.setting')

    @extends('layouts.scripts')

    <script src="{{ asset('/template/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAtencion = document.getElementById('selectAtencion');
            const tablaSoluciones = document.getElementById('tablaSoluciones');
            const solucionesBody = document.getElementById('solucionesBody');
            const buscador = document.getElementById('buscadorSolucion');
            const buscadorContainer = document.getElementById('buscadorContainer');

            let solucionesData = []; // La variable donde almacenamos los datos de soluciones

            // --- Manejador para el cambio de selección de atención ---
            selectAtencion.addEventListener('change', function() {
                const atencionId = this.value;
                solucionesBody.innerHTML = '';
                tablaSoluciones.style.display = 'none';
                buscadorContainer.style.display = 'none';

                if (atencionId) {
                    fetch(`/soluciones/${atencionId}`)
                        .then(response => response.json())
                        .then(data => {
                            solucionesData = data;
                            renderTabla(data);
                            tablaSoluciones.style.display = 'block';
                            buscadorContainer.style.display = 'block';
                        })
                        .catch(err => {
                            console.error(err);
                            solucionesBody.innerHTML =
                                `<tr><td colspan="5" class="text-center text-danger">Error al cargar soluciones</td></tr>`;
                            tablaSoluciones.style.display = 'block';
                        });
                }
            });

            // --- Manejador para la función de búsqueda (filtrado) ---
            buscador.addEventListener('input', function() {
                const valor = this.value.toLowerCase();
                const filtradas = solucionesData.filter(sol =>
                    sol.titulo.toLowerCase().includes(valor) ||
                    sol.descripcion.toLowerCase().includes(valor)
                );
                renderTabla(filtradas);
            });

            // --- Función para renderizar la tabla ---
            function renderTabla(soluciones) {
                solucionesBody.innerHTML = '';
                if (soluciones.length > 0) {
                    soluciones.forEach(solucion => {
                        solucionesBody.innerHTML += `
                            <tr>
                                <td style="text-align:center;">${solucion.id}</td>
                                <td>${solucion.titulo}</td>
                                <td>${solucion.descripcion.length > 100 ? solucion.descripcion.substring(0, 100) + '...' : solucion.descripcion}</td>
                                <td style="text-align:center;">
                                    <span class="badge bg-info text-white">${solucion.tickets}</span>
                                </td>
                                <td style="text-align:center;">
                                    <button class="btn btn-sm btn-primary"
                                        onclick="verDetalle(${solucion.id})">
                                        Ver detalle
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    solucionesBody.innerHTML =
                        `<tr><td colspan="5" class="text-center">No hay soluciones registradas.</td></tr>`;
                }
            }

            // --- Función para ver detalle y convertir <oembed> a <iframe> (Globalmente accesible) ---
            window.verDetalle = function(solucionId) {
                const idABuscar = parseInt(solucionId);
                const solucion = solucionesData.find(sol => sol.id === idABuscar);

                if (solucion) {
                    const descripcionElement = document.getElementById('descripcionSolucion');

                    document.getElementById('tituloSolucion').innerText = solucion.titulo;

                    // 1. Insertar el HTML completo de la descripción
                    descripcionElement.innerHTML = solucion.descripcion;

                    // 2. Lógica para convertir <oembed> a <iframe> (SOLUCIÓN DEL VIDEO)
                    const oembed = descripcionElement.querySelector('figure.media oembed');

                    if (oembed) {
                        const videoUrl = oembed.getAttribute('url');
                        let videoId = '';

                        // Extraer el ID del video de ambos formatos de URL de YouTube
                        if (videoUrl.includes('youtu.be/')) {
                            videoId = videoUrl.split('youtu.be/')[1].split(/[?&]/)[0];
                        } else if (videoUrl.includes('youtube.com/watch?v=')) {
                            videoId = videoUrl.split('v=')[1].split(/[?&]/)[0];
                        }

                        if (videoId) {
                            // Crear el elemento iframe
                            const iframe = document.createElement('iframe');
                            iframe.setAttribute('width', '100%');
                            iframe.setAttribute('height', '315');
                            // Usar la URL de embed estándar de YouTube
                            iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}`);
                            iframe.setAttribute('frameborder', '0');
                            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                            iframe.setAttribute('allowfullscreen', 'true');

                            // Reemplazar la etiqueta contenedora <figure class="media"> con el <iframe>
                            const figure = oembed.closest('figure.media');
                            if (figure) {
                                figure.parentNode.replaceChild(iframe, figure);
                            }
                        }
                    }

                    // 3. Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById('modalSolucion'));
                    modal.show();
                } else {
                     console.error(`Solución con ID ${solucionId} no encontrada.`);
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                "responsive": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "",
                        "previous": ""
                    }
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' + // Ajuste aquí para la parte superior izquierda
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12"p>>',
                "pagingType": "simple_numbers",
                "order": [
                    [2, 'desc']
                ], // Ordenar por la tercera columna (0-indexado)
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ] // Menú de selección de registros por página
            });
        });
    </script>
    <script>
        function validarArchivos(event) {
            var input = event.target;
            var files = input.files;
            var allowedExtensions = ['pdf', 'docx', 'xlsx', 'xls', 'png']; // Extensiones permitidas
            var maxFiles = 3; // Número máximo de archivos permitido

            // Validar número de archivos
            if (files.length > maxFiles) {
                alert("Solo se pueden seleccionar hasta " + maxFiles + " archivos.");
                input.value = ''; // Limpiar la selección de archivos
                return; // Salir de la función si se excede el número máximo de archivos
            }

            // Validar tipos de archivos
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileExtension = file.name.split('.').pop().toLowerCase(); // Obtener la extensión del archivo

                if (allowedExtensions.indexOf(fileExtension) === -1) {
                    alert("Archivo '" + file.name +
                        "' no es válido. Solo se permiten archivos con las siguientes extensiones: .pdf, .docx, .xlsx, .xls, .png"
                    );
                    input.value = ''; // Limpiar la selección de archivos
                    return; // Salir de la función si se encuentra un archivo no válido
                }
            }
        }
    </script>
    <script>
        function cargarDatos(id) {
            console.log(id);

            // Limpiar contenido anterior
            $('#comentarios').html('');

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{ url('MisComentarios') }}', // Ajusta la URL según tu configuración
                method: 'POST',
                data: {
                    ticket_id: id,
                    _token: '{{ csrf_token() }}' // Obtener el token CSRF de manera adecuada
                }
            }).done(function(res) {
                var datos = JSON.parse(res);
                console.log(datos);

                // Construir el contenido del modal
                var contenidoModal =
                    '<table class="table table-striped table-bordered" ><tbody><tr><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Fecha</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Usuario</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">Comentario</th></tr>';
                // var contenidoModal = '<h5>Editar Material - ' + datos[0].codigo + '</h5>';
                for (var x = 0; x < datos[0].length; x++) {
                    contenidoModal += '<tr><td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[
                        0][x].fecha + '</td>';
                    contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x]
                        .username + '</td>';
                    contenidoModal +=
                        '<td style="border: 1px solid #9fa6bc; align-content: center; white-space: pre-line;">' +
                        datos[0][x].comentario + '</td></tr>';
                }
                contenidoModal += '</tbody></table>';

                // Agregar contenido al modal
                $('#comentarios').html(contenidoModal);

                // Abrir el modal
                $('#MisComentarios').modal('show');
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Suponiendo que tienes una forma de verificar si el usuario está autenticado
            var isAuthenticated = {{ $variable }} /* lógica para verificar autenticación */ ;

            if (!isAuthenticated) {
                alert("Tu sesión ha expirado o no tienes acceso a esta página.");
                window.location.href = "/login"; // Redirige a la página de inicio de sesión
            }
        });
    </script>
</body>

</html>
