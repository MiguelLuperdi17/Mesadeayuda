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
                    <h2 class="mb-0">Seguimiento de Tickets</h2>
                </div>
            </div>
            @include('layouts.alerta')
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="row g-3 mb-6">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="border-bottom border-dashed border-300 pb-4">
                                <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                    <div class="table-responsive">
                                        @if (session('success'))
                                            <div class="alert alert-soft-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="MisComentarios" tabindex="-1"
                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Comentarios</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: -webkit-center;"
                                                         id="comentarios">
                                                        <table class="table table-striped table-bordered"
                                                               style="width: 90%">
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
                                                            <tr>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered" >
                                            <thead>
                                            <tr>
                                                <th style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                    Ticket
                                                </th>
                                                <th style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                    Fecha
                                                </th>
                                                <th style="width: 35%">Detalle</th>
                                                <th style="width: 15%">Estado</th>
                                                <th style="width: 20%">Comentarios</th>
                                                {{--                                                <th style="width: 10%">Acciones</th>--}}
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tickets as $ticket)
                                                <tr>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">{{$ticket->codigo}}</td>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">
                                                        @php
                                                            $fecha = date('Y-m-d', strtotime($ticket->fecha_creacion));
                                                            $hora = date('H:i:s', strtotime($ticket->fecha_creacion));
                                                        @endphp
                                                        {{$fecha}}<br>{{$hora}}</td>
                                                    <td style="vertical-align: middle;">
                                                        <br>
                                                        {{--                                                        <font style="font-weight: 900">Usuario: </font>--}}
                                                        {{--                                                        <br>--}}
                                                        <font style="font-weight: 900">Usuario: </font>
                                                        {{$ticket->usercreador->username}}
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Categoría: </font>{{$ticket->atencion->servicio->categoria->nombre}}
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Servicio: </font>{{$ticket->atencion->servicio->nombre}}
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Requerimiento/Incidente: </font>{!! wordwrap($ticket->atencion->nombre, 80, "<br>\n", false) !!}
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Creado: </font>{{$ticket->fecha_creacion}}
                                                            @if ($ticket->aprobadores->count())
                                                            <br>
                                                            <font
                                                            style="font-weight: 900">Aprobaciones: </font>
                                                            @foreach ($ticket->aprobadores as $aprobador)
                                                            @if($aprobador->estado == "A")
                                                            <span class="badge badge-phoenix badge-phoenix-success">{{$aprobador->user->username}}</span>
                                                            @else
                                                                <span class="badge badge-phoenix badge-phoenix-danger">{{$aprobador->user->username}}</span>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                        <br><br>
                                                        <font style="font-weight: 900">Detalle: </font>
                                                        <br>
                                                        {!! wordwrap($ticket->detalle, 80, "<br>\n", false) !!}
                                                        @if($ticket->adjuntos->count() > 0)
                                                            <br><br>
                                                            <font style="font-weight: 900">Adjuntos: </font>
                                                            <br>
                                                            @foreach($ticket->adjuntos as $adjunto)
                                                                <a href="{{ asset('archivos/' . $adjunto->detalle) }}"
                                                                   target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                                                         height="16px" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-link fs-3">
                                                                        <path
                                                                            d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                                                        <path
                                                                            d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                                                    </svg> {{$adjunto->detalle}}</a>&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @endforeach
                                                        @endif
                                                        <br><br>

                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        {{--                                                        <font style="font-weight: 900">Usuario: </font>--}}
                                                        {{--                                                        <br>--}}
                                                        <font style="font-weight: 900">Estado: </font>
                                                        @if($ticket->estado == "P")
                                                            <span class="badge badge-phoenix badge-phoenix-warning">Sin Asignar</span>
                                                        @elseif($ticket->estado == "A")
                                                            <span class="badge badge-phoenix badge-phoenix-info">En Proceso</span>
                                                        @else
                                                            <span class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                        @endif
                                                        <br>
                                                        <font style="font-weight: 900">Tiempo de atención: </font>{{$ticket->atencion->atencion}}D
                                                        <br>
                                                        <font style="font-weight: 900">Analista
                                                            asignado: </font>{{$ticket->user ? $ticket->user->username : ""}}
                                                        <br>
                                                        <font style="font-weight: 900">Fecha de asignación: <br>
                                                        </font>{{$ticket->fecha_asignacion}}
                                                        <br>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: -webkit-center;">
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
                                                            @foreach($ticket->comentarios->take(3) as $comentarios)
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
                                                        @if($ticket->comentarios->count() > 3)
                                                            <br>
                                                            {{--                                                            <button class="btn-xs btn btn-success"--}}
                                                            {{--                                                                    data-bs-toggle="modal"--}}
                                                            {{--                                                                    onclick="cargarDatos({{$ticket->id}})"--}}
                                                            {{--                                                                    >Ver todos los--}}
                                                            {{--                                                                comentarios--}}
                                                            {{--                                                            </button>--}}
                                                            <form method="POST">
                                                                <input type="hidden" value="{{csrf_token()}}"
                                                                       name="_token"
                                                                       id="token">
                                                                <a data-toggle="modal" title="MisComentarios"
                                                                   data-target="#MisComentarios">
                                                                    <input onclick="cargarDatos({{$ticket->id}})"
                                                                           type="button" class="btn btn-success btn-sm"
                                                                           id="Editar"
                                                                           value="Ver todos los comentarios">
                                                                </a>
                                                            </form>
                                                        @endif
                                                        <br>
                                                        <form method="POST" name="formComentario"
                                                              class="row g-3"
                                                              action="{{url('reasignar_ticket')}}"
                                                              id="formComentario" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="ticket_id"
                                                                   value="{{ $ticket->id }}">
                                                            <div class="col-md-3" style="align-self: center;">
                                                                <label class="form-label" for="inputCity">Reasignar: </label>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <select class="form-select" id="analista" name="analista">
                                                                    <option selected="selected">-- Lista de analistas --</option>
                                                                    @foreach($analistas as $analista)
                                                                    <option value="{{$analista->id}}">{{$analista->username}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary" style="width: 100%"
                                                                        type="submit">Reasignar
                                                                </button>
                                                            </div>
                                                        </form>
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
    function limitarNumeroArchivos(event) {
        var input = event.target;
        // Obtener la cantidad de archivos seleccionados
        var files = input.files;
        if (files.length > 3) {
            alert("Solo se pueden seleccionar hasta 3 archivos");
            // Limpiar la selección de archivos
            input.value = '';
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
                contenidoModal += '<tr><td style="border: 1px solid #9fa6bc;">' + datos[0][x].fecha + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc;">' + datos[0][x].username + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc;">' + datos[0][x].comentario + '</td></tr>';
            }
            contenidoModal += '</tbody></table>';

            // Agregar contenido al modal
            $('#comentarios').html(contenidoModal);

            // Abrir el modal
            $('#MisComentarios').modal('show');
        });
    }
</script>
</body>
</html>
