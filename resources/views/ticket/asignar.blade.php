<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">
<link href="{{ asset('/template/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet"/>

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
                    <h2 class="mb-0">Asignar Tickets</h2>
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
                                        <!-- Botón para abrir el modal -->
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
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                    Ticket
                                                </th>
                                                <th style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                    Fecha
                                                </th>
                                                <th style="width: 50%">Estado / Detalle</th>
                                                <th style="width: 20%">Analista</th>
                                                <th style="width: 20%">Firmas</th>
                                                {{--                                                <th style="width: 10%">Acciones</th>--}}
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tickets as $ticket)
                                                <tr data-ticket-id="{{ $ticket->id }}">
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">{{$ticket->codigo}}</td>
                                                    <td style="vertical-align: middle;text-align: -webkit-center;">
                                                        @php
                                                            $fecha = date('Y-m-d', strtotime($ticket->fecha_creacion));
                                                            $hora = date('H:i:s', strtotime($ticket->fecha_creacion));
                                                        @endphp
                                                        {{$fecha}}<br>{{$hora}}</td>
                                                    <td style="vertical-align: middle;">
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Usuario: </font>{{$ticket->usercreador->username}}
                                                        <br>
                                                        <font
                                                            style="font-weight: 900">Creado: </font>{{$ticket->fecha_creacion}}
                                                        <br>
                                                        <font style="font-weight: 900">Estado: </font>
                                                        @if($ticket->estado == "P")
                                                            <span class="badge badge-phoenix badge-phoenix-warning">Sin Asignar</span>
                                                        @elseif($ticket->estado == "A")
                                                            <span class="badge badge-phoenix badge-phoenix-info">Pendiente</span>
                                                        @else
                                                            <span class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                        @endif
                                                        <br>
                                                        <font style="font-weight: 900">Tiempo de
                                                            atención: </font>{{$ticket->atencion->atencion}}D
                                                        <br>
                                                        <br>
                                                        <font style="font-weight: 900">Requerimiento/Incidente: </font>
                                                        <select class="organizer-select" id="organizerSingle"
                                                                name="atencion"
                                                                data-choices="data-choices"
                                                                data-options='{"removeItemButton":true,"placeholder":true}'
                                                                required>
                                                            <option value="" selected> -- Seleccione una Opción --
                                                            </option>
                                                            @foreach($atenciones as $atencion)
                                                                <option
                                                                    value="{{ $atencion->id }}"
                                                                    @if($atencion->id == $ticket->atencion_id) selected @endif
                                                                    >{{str_limit_custom( $atencion->nombre, 80)}}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="validationCustom04"
                                                                       style="font-weight: 900">Impacto:</label>
                                                                <select class="form-select" id="impactoSelect"
                                                                        name="impacto" required="">
                                                                    <option selected="" disabled="" value="">--
                                                                        Seleccionar Valor --
                                                                    </option>
                                                                    <option value="1">Baja</option>
                                                                    <option value="2">Media</option>
                                                                    <option value="3">Alta</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="urgenciaSelect"
                                                                       style="font-weight: 900">Urgencia:</label>
                                                                <select class="form-select" id="urgenciaSelect"
                                                                        name="urgencia"
                                                                        required="">
                                                                    <option selected="" disabled="" value="">--
                                                                        Seleccionar Valor --
                                                                    </option>
                                                                    <option value="1">Baja</option>
                                                                    <option value="2">Media</option>
                                                                    <option value="3">Alta</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <font style="font-weight: 900">Detalle: </font>
                                                        <br>
                                                        {!! wordwrap($ticket->detalle, 80, "<br>\n", false) !!}
                                                        <br><br>

                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <form method="POST" name="formComentario"
                                                              class="row-cols-lg-5 g-3"
                                                              action="{{url('asignar_ticket')}}"
                                                              id="formComentario" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="ticket_id"
                                                                   value="{{ $ticket->id }}">
                                                            <select class="form-select" id="analistaSelect" name="analista"
                                                                aria-label="Default select example" required>
                                                            <option value="0" selected>-- Seleccione una Opción --
                                                            </option>
                                                            @foreach($analistas as $analista)
                                                                <option
                                                                    value="{{$analista->id}}">{{$analista->username}}</option>
                                                            @endforeach
                                                        </select>
                                                            <div class="col-12" style="width: 100%">
                                                                <button class="btn btn-primary" style="width: 100%"
                                                                        type="submit">Asignar Analista
                                                                </button>
                                                            </div>
                                                        </form>
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
                                                                    </svg> {{$adjunto->detalle}}</a>
                                                                <br>
                                                            @endforeach
                                                        @endif
                                                        <br>
                                                        <br>
                                                        <form method="POST" name="formComentario"
                                                              class="row-cols-lg-5 g-3"
                                                              action="{{url('anular_ticket')}}"
                                                              id="formComentario" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="ticket_id"
                                                                   value="{{ $ticket->id }}">
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
                                                                <button class="btn btn-danger" style="width: 100%"
                                                                        type="submit">Anular Ticket
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td style="vertical-align: middle; text-align: -webkit-center;">
                                                        <label for="organizerSingle" style="font-weight: 900">Responsable:</label>
                                                        <select class="form-select approvers-select"
                                                                id="approvers-select-{{ $ticket->id }}"
                                                                data-choices="data-choices"
                                                                style="margin-bottom: 0"
                                                                data-options='{"removeItemButton":true,"placeholder":true}'>
                                                            <option value="" selected>Seleccionar Aprobador...</option>
                                                            @foreach($autorizadores as $autorizador)
                                                                <option
                                                                    value="{{ $autorizador->id }}">{{ $autorizador->username }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button class="btn btn-primary mt-2 add-approver"
                                                                data-ticket-id="{{ $ticket->id }}" id="añadirSelect"
                                                                @if(!in_array($ticket->atencion->id, $lista_aprobacion))
                                                                    disabled
                                                                @endif
                                                        >Añadir
                                                        </button>
                                                        <ul class="list-group mt-2"
                                                            id="approvers-list-{{ $ticket->id }}">
                                                            @foreach($ticket->aprobadores as $aprobador)
                                                                @php
                                                                    $colors = [
                                                                        'A' => 'green',
                                                                        'R' => 'red',
                                                                    ];
                                                                    $color = $colors[$aprobador->estado] ?? 'black';
                                                                @endphp
                                                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                                                    data-id="{{ $aprobador->id }}"
                                                                    style="color: {{$color}}; font-weight: 700">
                                                                    {{ $aprobador->user->username }}
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-approver"
                                                                        data-ticket-id="{{ $ticket->id }}"
                                                                        data-approver-id="{{ $aprobador->user_id }}">x
                                                                    </button>
                                                                </li>
                                                            @endforeach
                                                        </ul>
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

</script>
<script>
    $(document).ready(function () {
        var disableValues = @json($lista);
        var aprovValues = @json($lista_aprobacion);
        // Inicializar DataTable
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
            "order": [[0, 'desc']], // Ordenar por la tercera columna (0-indexado)
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]] // Menú de selección de registros por página
        });

        // Manejar el evento change en los selects de la tabla
        $('#users-table').on('change', '.organizer-select', function () {
            var $row = $(this).closest('tr');
            var selectedValue = $(this).val();
            var ticketId = $row.data('ticket-id');
            console.log(selectedValue);
            console.log(ticketId);

            $.post('/update-ticket', {
                _token: '{{ csrf_token() }}',
                ticket_id: ticketId,
                atencion_id: selectedValue
            }, function (response) {
                if (response.status === 'success') {
                    console.log("Valor actualizado correctamente.");
                } else {
                    alert("Hubo un error al actualizar el valor.");
                }
            });

            console.log("antes");
            if (aprovValues.includes(selectedValue)) {
                $row.find('#añadirSelect').prop('disabled', false);
                console.log("1");
            } else {
                $row.find('#añadirSelect').prop('disabled', true);
                console.log("2");
            }
            console.log("despuest");
            // Definir la lógica para habilitar o deshabilitar los selects
            if (disableValues.includes(selectedValue)) {
                $row.find('#impactoSelect').prop('disabled', false);
                $row.find('#urgenciaSelect').prop('disabled', false);
                console.log("Impacto y Urgencia deshabilitados");
            } else {
                $row.find('#impactoSelect').prop('disabled', true);
                $row.find('#urgenciaSelect').prop('disabled', true);
                console.log("Impacto y Urgencia habilitados");
            }
        });

        // Manejar el botón "Añadir"
        $(document).on('click', '.add-approver', function () {
            var ticketId = $(this).data('ticket-id');
            var selectedValue = $('#approvers-select-' + ticketId).val();
            var selectedText = $('#approvers-select-' + ticketId + ' option:selected').text();

            if (selectedValue && selectedText !== 'Seleccionar Aprobador...') {
                // Añadir al listado de aprobadores si no está ya en la lista
                if ($('#approvers-list-' + ticketId + ' li[data-id="' + selectedValue + '"]').length === 0) {
                    var listItem = `
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${selectedValue}">
                            ${selectedText}
                            <button class="btn btn-sm btn-danger remove-approver" data-ticket-id="${ticketId}" data-approver-id="${selectedValue}">x</button>
                        </li>`;
                    $('#approvers-list-' + ticketId).append(listItem);
                    saveApprover(ticketId, selectedValue, 'add');
                } else {
                    alert("Este aprobador ya está en la lista.");
                }
            }
        });

        // Manejar el botón "x" para eliminar
        $(document).on('click', '.remove-approver', function () {
            var ticketId = $(this).data('ticket-id');
            var approverId = $(this).data('approver-id');
            $(this).closest('li').remove();
            saveApprover(ticketId, approverId, 'remove');
        });

        // Guardar el aprobador en el servidor
        function saveApprover(ticketId, approverId, action) {
            $.post('/update-approver', {
                _token: '{{ csrf_token() }}',
                ticket_id: ticketId,
                approver_id: approverId,
                action: action
            }, function (response) {
                if (response.status === 'success') {
                    console.log("Operación realizada correctamente.");
                } else {
                    alert("Hubo un error al actualizar los aprobadores.");
                }
            });
        }
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
<script>
    document.getElementById('submitButton').addEventListener('click', function () {
        // Capturar valores de los selects
        var impactoValue = document.getElementById('impactoSelect').value;
        var urgenciaValue = document.getElementById('urgenciaSelect').value;
        var atencionValue = document.getElementById('organizerSingle').value;
        var analistaValue = document.getElementById('analistaSelect').value;

        if (atencionValue === '' || analistaValue === '') {
            alert('Por favor, complete todos los campos requeridos.');
            return; // No enviar el formulario si hay campos vacíos
        }

        // Asignar valores a los inputs ocultos
        document.getElementById('hiddenImpacto').value = impactoValue;
        document.getElementById('hiddenUrgencia').value = urgenciaValue;
        document.getElementById('hiddenAtencion').value = atencionValue;
        document.getElementById('hiddenAnalista').value = analistaValue;

        // Enviar el formulario oculto
        document.getElementById('hiddenForm').submit();
    });
</script>
</body>
</html>
