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

            <h3 class="mb-3">Gestión de Soluciones</h3>

            {{-- Filtros --}}
            <form id="formFiltro" class="row g-2 mb-3">
                <div class="col-md-8">
                    <select name="atencion_id" class="form-select" data-choices="data-choices">
                        <option value="">-- Filtrar por Atención --</option>
                        @foreach ($atenciones as $a)
                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" name="buscar" class="form-control"
                        placeholder="Buscar por título o contenido">
                </div>
            </form>

            {{-- Tabla --}}
            <table class="table table-bordered table-striped" id="tablaSoluciones">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Título</th>
                        <th>Atención</th>
                        <th>Estado</th>
                        <th width="180">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Se llena por AJAX --}}
                </tbody>
            </table>
        </div>

        {{-- Modal Editar --}}
        <div class="modal fade" id="modalEditar" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form id="formEditar" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Solución</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <label>Título</label>
                            <input type="text" name="titulo" id="editTitulo" class="form-control mb-2" required>

                            <label>Descripción</label>
                            {{-- Asegúrate de que este textarea esté vacía por defecto --}}
                            <textarea name="descripcion" id="editDescripcion"></textarea>

                            <label class="mt-3">Estado</label>
                            <select class="form-control" name="estado" id="editEstado">
                                {{-- Es posible que quieras cambiar 1 y 2 por Pendiente y Aprobado, o viceversa, dependiendo de tu lógica de negocio --}}
                                <option value="1">Pendiente</option>
                                <option value="2">Aprobado</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Guardar cambios</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal para comentarios - no se usa en la función de edición, pero se mantiene --}}
        {{-- DEBES ASEGURARTE DE TENER EL MODAL CON ID 'MisComentarios' Y UN ELEMENTO CON ID 'comentarios' EN ALGÚN LADO SI USAS cargarDatos(id) --}}
        {{-- Ejemplo de estructura que necesitarías si usas 'cargarDatos':
        <div class="modal fade" id="MisComentarios" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Comentarios del Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="comentarios">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        --}}

        @extends('layouts.chat')

    </main>
    @extends('layouts.setting')

    @extends('layouts.scripts')

    <script src="{{ asset('/template/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>

    <script>
        let editorDescripcion;

        // **Función initEditor eliminada ya que no es necesaria con la nueva lógica en editarSolucion**

        function editarSolucion(id) {

            // Cargar datos del servidor
            $.get("/soluciones_vista/" + id, function(sol) {

                // Llenar campos simples
                $('#editTitulo').val(sol.titulo);
                $('#editEstado').val(sol.estado);

                // 1. Destruir el editor existente si lo hay
                if (editorDescripcion) {
                    editorDescripcion.destroy()
                        .catch(error => console.error('Error al destruir el editor existente:', error));
                    editorDescripcion = null;
                }

                // 2. Crear (inicializar) el nuevo editor
                ClassicEditor.create(document.querySelector('#editDescripcion'))
                    .then(editor => {
                        editorDescripcion = editor;

                        // 3. Establecer el contenido DENTRO del .then(), cuando el editor está listo
                        // Esto asegura que la descripción se muestre correctamente.
                        editorDescripcion.setData(sol.descripcion ?? '');

                        // 4. Mostrar el modal SOLAMENTE después de que el editor se haya cargado con los datos
                        new bootstrap.Modal(document.getElementById('modalEditar')).show();
                    })
                    .catch(error => {
                        console.error('Error al crear el editor:', error);
                        // Si falla la creación del editor, al menos muestra el modal con el textarea simple
                        new bootstrap.Modal(document.getElementById('modalEditar')).show();
                    });

                // 🔥 RUTA CORRECTA PARA EL FORMULARIO
                $("#formEditar").attr("action", "/soluciones_editar/" + id);

                // 🔥 evitar que se acumulen submits duplicados
                $("#formEditar").off('submit').on("submit", function(e){
                    e.preventDefault();

                    let formData = new FormData(this);
                    // Obtener datos del editor o del textarea simple si el editor no se inicializó
                    formData.set('descripcion', editorDescripcion ? editorDescripcion.getData() : $('#editDescripcion').val());

                    $.ajax({
                        url: this.action,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        // Laravel necesita esto para simular un PUT
                        headers: {'X-HTTP-Method-Override': 'PUT'},
                        success: function() {
                            $('#modalEditar').modal('hide');
                            cargarSoluciones();
                            // Aquí podrías añadir un mensaje de éxito con Swal.fire o similar
                        },
                        error: function(xhr) {
                            console.error("Error al guardar:", xhr.responseText);
                            // Aquí podrías mostrar un mensaje de error al usuario
                        }
                    });
                });
            });
        }

        function eliminarSolucion(id) {
            Swal.fire({
                title: "¿Eliminar solución?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/soluciones/${id}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(() => cargarSoluciones());
                }
            });
        }

        // -----------------------------
        //  Cargar Soluciones AJAX
        // -----------------------------
        function cargarSoluciones() {
            let atencion = $("[name='atencion_id']").val();
            let buscar = $("[name='buscar']").val();

            $.ajax({
                url: "/admin/soluciones/listar/" + (atencion ? atencion : ''),
                type: "GET",
                data: {
                    buscar: buscar
                },
                success: function(data) {
                    let tbody = $("#tablaSoluciones tbody");
                    tbody.html("");

                    data.forEach(sol => {
                        tbody.append(`
                            <tr>
                                <td>${sol.id}</td>
                                <td>${sol.titulo}</td>
                                <td>${sol.atencion_nombre ?? '-'}</td>

                                <td>
                                    ${sol.estado == 2
                                        ? '<span class="badge bg-success">Aprobado</span>'
                                        : '<span class="badge bg-secondary">Pendiente</span>'}
                                </td>

                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editarSolucion(${sol.id})">
                                        Editar
                                    </button>

                                    <button class="btn btn-danger btn-sm" onclick="eliminarSolucion(${sol.id})">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

        // Eventos
        $("[name='atencion_id']").change(cargarSoluciones);
        $("[name='buscar']").keyup(cargarSoluciones);

        // Cargar al iniciar
        cargarSoluciones();
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