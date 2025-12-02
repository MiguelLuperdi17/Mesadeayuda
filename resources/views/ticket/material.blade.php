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
                    <h2 class="mb-0">Material de Ayuda</h2>
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
                                        @if (session('success'))
                                            <div class="alert alert-soft-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 10%;vertical-align: middle;text-align: -webkit-center;">
                                                    Fecha de Publicación
                                                </th>
                                                <th style="width: 10%;vertical-align: middle;text-align: -webkit-center;">
                                                    Tipo
                                                </th>
                                                <th style="width: 50%">Detalle</th>
                                                <th style="width: 30%">Ver</th>
                                                {{--                                                <th style="width: 10%">Acciones</th>--}}
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($materiales as $material)
                                                <tr>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">
                                                        @php
                                                            $fecha = date('Y-m-d', strtotime($material->fecha_registro));
                                                            $hora = date('H:i:s', strtotime($material->fecha_registro));
                                                        @endphp
                                                        {{$fecha}}<br>{{$hora}}</td>
                                                    </td>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">
                                                        {{$material->tipo}}
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <br>
                                                        {{--                                                        <font style="font-weight: 900">Usuario: </font>--}}
                                                        {{--                                                        <br>--}}
                                                        <font
                                                            style="font-weight: 900">Titulo: </font>{{$material->titulo}}
                                                        <br>
                                                        <font style="font-weight: 900">Detalle: </font>
                                                        <br>
                                                        {!! wordwrap($material->detalle, 100, "<br>\n", false) !!}
                                                        <br><br>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="col-12 col-sm-auto">
                                                            <button class="btn-xs btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#miModalMaterial{{$material->id}}">Visualizar
                                                                Material
                                                            </button>
                                                        </div>
                                                        <div class="modal fade" id="miModalMaterial{{$material->id}}" tabindex="-1"
                                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="miModalLabel">
                                                                            Visualización de Material
                                                                            - {{$material->tipo}}</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="align-self: center;">
                                                                        <iframe
                                                                            src="{{ asset('archivos/' . $material->archivo) }}"
                                                                            width="800" height="600"
                                                                            style="border:none; overflow:auto;"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </td>
                                                </tr>
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
