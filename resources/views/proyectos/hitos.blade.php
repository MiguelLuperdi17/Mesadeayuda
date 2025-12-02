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
                    <h2 class="mb-0">Hitos del programa - {{$proyecto->titulo}}</h2>
                </div>
                @if($user->rol_id == 5 || $user->rol_id == 1)
                <br>
                <div class="col-auto">
                    <h2 class="mb-0">
                        <a class="nav-link label-1" data-bs-target="#RechazarTicket{{ $proyecto->id }}" role="button"
                            data-bs-toggle="modal" aria-expanded="false">
                                <button class="btn btn-success">Cambiar fecha</button>
                            </a>
                    </h2>
                </div>
                @endif
                <div class="modal fade" id="RechazarTicket{{ $proyecto->id }}" tabindex="-1"
                    aria-labelledby="RechazarTicket" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <!-- Cambiado de modal-dialog a modal-xl -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="RechazarTicket">Rechazar Proyecto-{{$proyecto->correlativo}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('fechas_hitos') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $proyecto->id }}" name="proyecto_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="users-table2" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th style="width: 40%; vertical-align: middle; text-align: center;">Nombre</th>
                                                    <th style="width: 20%; vertical-align: middle; text-align: center;">Fecha Inicio</th>
                                                    <th style="width: 30%; vertical-align: middle; text-align: center;">Fecha Fin</th>
                                                    <th style="width: 10%;">Estado</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($hitos as $hito)
                                                    <tr>
                                                        <td>
                                                            {{$hito->id}}
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: center;">{{$hito->nombre}}</td>
                                                        @if($hito->estado != 3)
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <input class="form-control datetimepicker"
                                                                   id="fecha_inicio{{$hito->id}}"
                                                                   type="text" style="text-align: center;"
                                                                   name="hitos[{{$hito->id}}][fecha_inicio]"
                                                                   placeholder="{{ \Carbon\Carbon::parse($hito->fecha_inicio)->format('Y-m-d') }}"
                                                                   data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}'  />
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input class="form-control datetimepicker"
                                                                   id="fecha_fin{{$hito->id}}"
                                                                   type="text"  style="text-align: center;"
                                                                   name="hitos[{{$hito->id}}][fecha_fin]"
                                                                   placeholder="{{ \Carbon\Carbon::parse($hito->fecha_fin)->format('Y-m-d') }}"
                                                                   data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                                                                   <input type="hidden" name="hitos[{{$hito->id}}][id]" value="{{$hito->id}}">
                                                        </td>
                                                        @else
                                                        <td style="text-align: center;">{{$hito->fecha_inicio}}</td>
                                                        <td style="text-align: center;">{{$hito->fecha_fin}}</td>
                                                        @endif
                                                        <td style="vertical-align: middle;">
                                                            Estado:
                                                            @if($hito->estado == 1)
                                                                <span class="badge badge-phoenix badge-phoenix-warning">Vencido</span>
                                                            @elseif($hito->estado == 0)
                                                                <span class="badge badge-phoenix badge-phoenix-info">En Proceso</span>
                                                            @else
                                                                <span class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label" for="comentario">Ingrese el comentario para el cambio de programación</label>
                                                    <textarea class="form-control"
                                                              id="comentario"
                                                              name="comentario"
                                                              placeholder="Comentario para rechazar el proyecto"
                                                              rows="3"
                                                              maxlength="200"
                                                              required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
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
                                        <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th style="width: 30%;vertical-align: middle;text-align: -webkit-center;">
                                                    Nombre
                                                </th>
                                                <th style="width: 10%;vertical-align: middle;text-align: -webkit-center;">
                                                    Fecha de Inicio
                                                </th>
                                                <th style="width: 10%">Fecha Fin</th>
                                                <th style="width: 20%">Estado</th>
                                                <th style="width: 30%">Comentarios</th>
                                                {{--                                                <th style="width: 10%">Acciones</th>--}}
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($hitos as $hito)
                                                <tr>
                                                    <td>{{$hito->id}}</td>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">{{$hito->nombre}}</td>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">{{$hito->fecha_inicio}}</td>
                                                    <td style="vertical-align: middle;">{{$hito->fecha_fin}}</td>
                                                    <td style="vertical-align: middle;">
                                                        Estado:
                                                        @if($hito->estado == 1)
                                                            <span class="badge badge-phoenix badge-phoenix-warning">Vencido</span>
                                                        @elseif($hito->estado == 0)
                                                            <span class="badge badge-phoenix badge-phoenix-info">En Proceso</span>
                                                        @else
                                                            <span class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                        @endif
                                                        <br>
                                                        @if($user->id == $proyecto->id_responsable && $hito->estado != 3)
                                                    <form method="POST" name="formComentario"
                                                              class="row-cols-lg-5 g-3"
                                                              action="{{url('crear_comentario_hito')}}"
                                                              id="formComentario" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="proyecto_id"
                                                                   value="{{ $hito->id }}">
                                                            <div class="form-floating" style="width: 100%">
                                                                <textarea class="form-control" id="floatingTextarea2"
                                                                          name="comentario"
                                                                          placeholder="Registrar Comentario"
                                                                          style="height: 75px"
                                                                          maxlength="100" required></textarea>
                                                                <label for="floatingTextarea2">Registrar
                                                                    Comentario</label>
                                                            </div>
                                                            <div class="col-12" style="width: 100%">
                                                                <button class="btn btn-primary" style="width: 100%"
                                                                        type="submit">Guardar
                                                                </button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: -webkit-center;">
                                                        @if($user->id == $proyecto->id_responsable)
                                                        @if($hito->estado != 3)
                                                            <form method="POST" name="formComentario"
                                                                    class="row g-3"
                                                                    action="{{url('finalizar_hito')}}"
                                                                    id="formComentario" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="hito_id"
                                                                        value="{{ $hito->id }}">
                                                                    <div class="col-md-12">
                                                                        <button class="btn btn-primary" style="width: 100%"
                                                                                type="submit">Finalizar Hito
                                                                        </button>
                                                                    </div>
                                                            </form>
                                                            <br>
                                                            @endif
                                                            @endif
                                                        <table>
                                                            <tbody>
                                                            <tr>
                                                                <th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">
                                                                    Fecha
                                                                </th>
                                                                <th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">
                                                                    Usuario
                                                                </th>
                                                                <th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">
                                                                    Comentario
                                                                </th>
                                                            </tr>
                                                            @php
                                                                $coments = $hito->comentarios->sortByDesc('id');
                                                                $coments = $coments->take(3);
                                                                $coments = $coments->sortBy('id');
                                                            @endphp
                                                            @foreach($coments as $comentarios)
                                                                <tr>
                                                                    <td style="border: 1px solid #9fa6bc;">
                                                                        {{$comentarios->fecha}}</td>
                                                                    <td style="border: 1px solid #9fa6bc;">{{$comentarios->user->username}}</td>
                                                                    <td style="border: 1px solid #9fa6bc;"
                                                                        title="{{$comentarios->comentario}}">{{str_limit_custom($comentarios->comentario,30)}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                        @if($hito->comentarios->count() > 3)
                                                            <br>
                                                            <form method="POST">
                                                                <input type="hidden" value="{{csrf_token()}}"
                                                                       name="_token"
                                                                       id="token">
                                                                <a data-toggle="modal" title="MisComentarios"
                                                                   data-target="#MisComentarios">
                                                                    <input onclick="cargarDatos({{$hito->id}})"
                                                                           type="button" class="btn btn-success btn-sm"
                                                                           id="Editar"
                                                                           value="Ver todos los comentarios">
                                                                </a>
                                                            </form>
                                                        @endif
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
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
               '<"row"<"col-sm-12"t>>' +
               '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        "pagingType": "simple_numbers",
        "order": [[0, 'asc']], // Cambiar por la columna que deseas
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "columnDefs": [
            {
                "targets": [0], // Cambia según la columna a ocultar
                "visible": false,
                "searchable": false
            }
        ]
    });
});
</script>
<script>
    $(document).ready(function () {
    $('#users-table2').DataTable({
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
                "next": "<i class='fa fa-arrow-right'></i>",
                "previous": "<i class='fa fa-arrow-left'></i>"
            }
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
               '<"row"<"col-sm-12"t>>' +
               '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        "pagingType": "simple_numbers",
        "order": [[0, 'asc']], // Cambiar por la columna que deseas
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "columnDefs": [
            {
                "targets": [0], // Cambia según la columna a ocultar
                "visible": false,
                "searchable": false
            }
        ]
    });
});
</script>
<script>
    function cargarDatos(id) {
        console.log(id);

        // Limpiar contenido anterior
        $('#comentarios').html('');

        // Realizar la solicitud AJAX
        $.ajax({
            url: '{{ url('MisComentarios_hito') }}', // Ajusta la URL según tu configuración
            method: 'POST',
            data: {
                proyecto_id: id,
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
