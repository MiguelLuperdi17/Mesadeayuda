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
                                            <h4 class="mb-3">Historial de incidentes por Equipo</h4>
                                        </div>
                                    </div>

                                    <!-- Select de atenciones -->
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Seleccionar Equipo:</label>
                                            <select id="selectEquipo" class="form-select" data-choices="data-choices">
                                                <option value="">-- Seleccione un equipo --</option>
                                                @foreach ($equipos as $e)
                                                    <option value="{{ $e->id }}">{{ $e->serial }} - {{ $e->nombre_equipo }} - {{$e->usuario}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Buscador -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Buscar solución:</label>
                                        <input type="text" id="buscarTexto" class="form-control" placeholder="Buscar por título...">
                                    </div>
                                    <br>
                                    <!-- Tabla -->
                                    <div id="tablaEquipoSoluciones" style="display:none;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Ticket</th>
                                                    <th>Detalle</th>
                                                    <th>Solución</th>
                                                </tr>
                                            </thead>
                                            <tbody id="equiposSolucionBody"></tbody>
                                        </table>
                                    </div>

                                    <!-- Modal Detalle -->
                                    <div class="modal fade" id="modalSolucion" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tituloSolucionModal"></h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div id="descripcionSolucionModal"></div>
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

        const selectEquipo = document.getElementById('selectEquipo');
        const buscarTexto = document.getElementById('buscarTexto');
        const tabla = document.getElementById('tablaEquipoSoluciones');
        const cuerpo = document.getElementById('equiposSolucionBody');

        let solucionesGlobal = [];

        // Load solutions when selecting a team
        selectEquipo.addEventListener('change', function () {

            const id = this.value;
            cuerpo.innerHTML = '';
            tabla.style.display = 'none';
            solucionesGlobal = [];

            if (!id) return;

            fetch(`/soluciones-equipo/${id}`)
                .then(res => res.json())
                .then(data => {
                    solucionesGlobal = data;
                    renderTabla();
                    tabla.style.display = 'block';
                })
                .catch(err => {
                    console.error(err);
                    cuerpo.innerHTML = `
                        <tr><td colspan="5" class="text-danger text-center">Error al cargar datos.</td></tr>`;
                    tabla.style.display = 'block';
                });
        });

        // Search filter
        buscarTexto.addEventListener('keyup', function () {
            renderTabla();
        });


        function renderTabla() {

            const filtro = buscarTexto.value.toLowerCase();
            cuerpo.innerHTML = '';

            let filtrados = solucionesGlobal.filter(s =>
                s.titulo.toLowerCase().includes(filtro)
            );

            if (filtrados.length === 0) {
                cuerpo.innerHTML = `
                    <tr><td colspan="5" class="text-center">No se encontraron resultados.</td></tr>`;
                return;
            }

            filtrados.forEach(s => {
                cuerpo.innerHTML += `
                    <tr>
                        <td>${s.id}</td>
                        <td>${s.titulo}</td>
                        <td>${s.ticket_codigo}</td>
                        <td>${s.ticket_detalle}</td>
                        <td>
                            <button class="btn btn-primary btn-sm"
                                onclick="verSolucion(${s.id})">
                                Ver solución
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        });


        // Open modal with full solution
        function verSolucion(id) {

        fetch(`/soluciones-atencion/detalle/${id}`)
            .then(res => res.json())
            .then(sol => {

                // Insertar título
                document.getElementById('tituloSolucionModal').innerText = sol.titulo;

                // Insertar HTML original
                const contenedor = document.getElementById('descripcionSolucionModal');
                contenedor.innerHTML = sol.descripcion;

                // Buscar <oembed> generado por CKEditor
                const oembed = contenedor.querySelector('figure.media oembed');

                if (oembed) {
                    const url = oembed.getAttribute('url');
                    let videoId = '';

                    // Formatos válidos de YouTube
                    if (url.includes('youtu.be/')) {
                        videoId = url.split('youtu.be/')[1].split(/[?&]/)[0];
                    }
                    else if (url.includes('youtube.com/watch?v=')) {
                        videoId = url.split('v=')[1].split(/[?&]/)[0];
                    }

                    if (videoId) {
                        const iframe = document.createElement('iframe');
                        iframe.setAttribute('width', '100%');
                        iframe.setAttribute('height', '315');
                        iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}`);
                        iframe.setAttribute('frameborder', '0');
                        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                        iframe.setAttribute('allowfullscreen', true);

                        // Reemplazar el <figure> con el <iframe>
                        const figure = oembed.closest('figure.media');
                        if (figure) {
                            figure.parentNode.replaceChild(iframe, figure);
                        }
                    }
                }

                // Mostrar modal
                new bootstrap.Modal(document.getElementById('modalSolucion')).show();
            })
            .catch(err => console.error(err));
        }


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
