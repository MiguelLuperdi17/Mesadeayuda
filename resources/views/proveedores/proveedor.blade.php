<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">

<style>
    .contenido-archivo {
        font-size: 16px; /* Tamaño de fuente más grande */
        overflow: auto; /* Permitir que el contenido se ajuste sin barras de desplazamiento */
        white-space: pre-wrap; /* Mantener el formato del texto */
    }

    .tabla-container {
        max-height: 400px; /* Altura máxima del contenedor */
        overflow-y: auto; /* Scroll vertical automático */
    }

    .my-table th,
    .my-table td {
        font-size: 12px; /* Ajusta el tamaño de la letra según tus preferencias */
    }
</style>
@include('layouts.tableStyle')
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <section class="pt-1 pb-9">
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Proveedores</h2>
                </div>
            </div>
            @if (session('access_denied'))
                <script>
                    alert("No tienes permiso para acceder a esta página. Por favor, inicia sesión.");
                </script>
            @endif
            @include('layouts.alerta')
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="row g-3 mb-6">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="border-bottom border-dashed border-300 pb-4">
                                <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                    <div class="table-responsive">
                                        <!-- Botón para abrir el modal -->
                                        <div class="col-12 col-sm-auto">
                                            <button class="btn-xs btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#miModal">Crear Proveedor
                                            </button>
                                        </div>
                                        @if (session('success'))
                                            <div class="alert alert-soft-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="miModal" tabindex="-1"
                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Crear nuevo
                                                            Proveedor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" name="formArchivo" class="cliente"
                                                              action="{{url('crear_ticket_prov')}}"
                                                              id="formArchivo" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- Primer campo de selección -->
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Razón Social</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="razon_social"
                                                                                    placeholder="Ingrese la Razón Social">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Contacto</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="contacto"
                                                                                    placeholder="Ingrese el nombre del contacto">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Correo</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="correo"
                                                                                    placeholder="Ingrese el correo">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">telefono</label>
                                                                                <input type="number" max="999999999" min="900000000"
                                                                                    class="form-control me-2"
                                                                                    name="Teléfono"
                                                                                    placeholder="Ingrese el Teléfono">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Tipo</label>
                                                                                <select class="form-select select33"
                                                                                    name="id_categoria"
                                                                                    id="id_categoria"
                                                                                    data-choices="data-choices"
                                                                                    data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                    required>
                                                                                    <option value="" selected
                                                                                        disabled>
                                                                                        Seleccionar Tipo...
                                                                                    </option>
                                                                                    <option value="1">Desarrollo</option>
                                                                                    <option value="2">Mantenimiento</option>
                                                                                    <option value="3">Infraestructura</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="formFileMultiple">
                                                                                Seleccione sus archivos adjuntos
                                                                                <font color="red">(Máximo 3
                                                                                    archivos)</font>
                                                                            </label>
                                                                            <input class="form-control archivo"
                                                                                id="archivo" name="archivos[]"
                                                                                accept=".pdf, .docx, .xlsx, .xls"
                                                                                type="file" multiple="multiple"
                                                                                onchange="validarArchivos(event)" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row col-md-6">
                                                                </div> -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Cancelar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered" style="width:100%; text-align: center;">
                                            <thead>
                                            <tr>
                                                <th style="width: 20%;vertical-align: middle;text-align: -webkit-center;">
                                                    Razón Social
                                                </th>
                                                <th style="width: 20%;vertical-align: middle;text-align: -webkit-center;">
                                                    Correo
                                                </th>
                                                <th style="width: 20%">Contacto</th>
                                                <th style="width: 20%">telefono</th>
                                                <th style="width: 20%">Tipo</th>
                                                <th style="width: 20%">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proveedores as $proveedor)
                                                <tr>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">{{$proveedor->razon_social}}</td>
                                                    <td style="vertical-align: middle;">{{$proveedor->correo}}</td>
                                                    <td style="vertical-align: middle;">{{$proveedor->contacto}}</td>
                                                    <td style="vertical-align: middle;">{{$proveedor->telefono}}</td>
                                                    <td style="vertical-align: middle;">
                                                        @if ($proveedor->tipo == 1)
                                                            Consultor SAP
                                                        @else
                                                            otros
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <button class="btn-xs btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#miModalEditar">Editar</button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="miModalEditar" tabindex="-1"
                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Editar Proveedor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" name="formArchivo" class="cliente"
                                                              action="{{url('editar_proveedor')}}"
                                                              id="formArchivo" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- Primer campo de selección -->
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Razón Social</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="razon_social"
                                                                                    placeholder="Ingrese la Razón Social" value="{{$proveedor->razon_social}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Contacto</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="contacto"
                                                                                    placeholder="Ingrese el nombre del contacto" value="{{$proveedor->contacto}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Correo</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="correo"
                                                                                    placeholder="Ingrese el correo" value="{{$proveedor->correo}}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">telefono</label>
                                                                                <input type="number" max="999999999" min="900000000"
                                                                                    class="form-control me-2"
                                                                                    name="Teléfono"
                                                                                    placeholder="Ingrese el Teléfono"
                                                                                    value="{{$proveedor->telefono}}"
                                                                                    >

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Tipo</label>
                                                                                <select class="form-select select33"
                                                                                    name="id_categoria"
                                                                                    id="id_categoria"
                                                                                    data-choices="data-choices"
                                                                                    data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                    required>
                                                                                    <option @if ($proveedor->telefono == 1) selected @endif value="1">Desarrollo</option>
                                                                                    <option @if ($proveedor->telefono == 2) selected @endif value="2">Mantenimiento</option>
                                                                                    <option @if ($proveedor->telefono == 3) selected @endif value="3">Infraestructura</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row col-md-6">
                                                                </div> -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Cancelar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    $(document).ready(function () {
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
            "order": [[2, 'desc']], // Ordenar por la tercera columna (0-indexado)
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]] // Menú de selección de registros por página
        });
    });
</script>
<script>
    function validarArchivos(event) {
        var input = event.target;
        var files = input.files;
        var allowedExtensions = ['pdf', 'docx', 'xlsx', 'xls']; // Extensiones permitidas
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
                alert("Archivo '" + file.name + "' no es válido. Solo se permiten archivos con las siguientes extensiones: .pdf, .docx, .xlsx, .xls");
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
        }).done(function (res) {
            var datos = JSON.parse(res);
            console.log(datos);

            // Construir el contenido del modal
            var contenidoModal = '<table class="table table-striped table-bordered" ><tbody><tr><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Fecha</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Usuario</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">Comentario</th></tr>';
            // var contenidoModal = '<h5>Editar Material - ' + datos[0].codigo + '</h5>';
            for (var x = 0; x < datos[0].length; x++) {
                contenidoModal += '<tr><td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x].fecha + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x].username + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center; white-space: pre-line;">' + datos[0][x].comentario + '</td></tr>';
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
    document.addEventListener("DOMContentLoaded", function () {
        // Suponiendo que tienes una forma de verificar si el usuario está autenticado
        var isAuthenticated = {{$variable}}/* lógica para verificar autenticación */;

        if (!isAuthenticated) {
            alert("Tu sesión ha expirado o no tienes acceso a esta página.");
            window.location.href = "/login"; // Redirige a la página de inicio de sesión
        }
    });
</script>
</body>
</html>
