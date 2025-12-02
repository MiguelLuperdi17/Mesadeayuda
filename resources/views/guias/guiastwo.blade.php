<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">
@include('layouts.tableStyle')
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <section class="pt-1 pb-9">
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Guías 002</h2>
                </div>
            </div>
            @include('layouts.alerta')

            <div class="row g-3 mb-6">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="border-bottom border-dashed border-300 pb-4">
                                <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                    <div class="col-12 col-sm-auto flex-1">
                                        <div class="col-12 col-sm-auto">
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#01aef0;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#miModal">Crear Guía
                                            </button>
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#2ba708;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#miModalAnulada">Guia Nula
                                            </button>
                                        </div>
                                        <div class="modal fade" id="miModalAnulada" tabindex="-1" aria-labelledby="miModalLabelA" aria-hidden="true">
                                            <div class="modal-dialog modal-xs"> <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabelA">Crear Guia Nula</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <form   method="POST" name="formArchivo" id="formArchivo" enctype="multipart/form-data"> -->
                                                        <form method="POST" name="formArchivo" id="cliente" action="{{url('guia_nulas_two')}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12" id="inputs-datos">
                                                                    <div class="col-12">
                                                                        <!-- Tercer campo de selección -->
                                                                        <div class="mb-2">
                                                                            <input type="hidden" name="dato_nulo" value="{{ obtenerNuevoCorrelativo() }}">
                                                                            <!-- Mostrar el nuevo correlativo -->
                                                                            <label id="correlativo" readonly> ¿Esta seguro de crear la  guía {{ obtenerNuevoCorrelativo() }} nula ?</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="loader"></div><br>
                                                                        <!-- Botones para enviar y cerrar el modal -->
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btnEnviar" class="btn btn-primary" {{ obtenerNuevoCorrelativo() == '' ? 'disabled' : '' }}>Guardar</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        @php
                                                            function obtenerNuevoCorrelativo() {
                                                                // Realizar una consulta para obtener el último correlativo
                                                                $ultimoCorrelativo = App\Models\GuiasTwo::orderBy('id', 'desc')->pluck('guia')->first();
                                                                // Si hay un último correlativo, extraer el número y sumar 1
                                                                if ($ultimoCorrelativo) {
                                                                    $ultimoNumero = intval(substr($ultimoCorrelativo, strrpos($ultimoCorrelativo, '-') + 1));
                                                                    $nuevoNumero = $ultimoNumero + 1;
                                                                    // Agregar ceros adelante para que el número tenga al menos 4 dígitos
                                                                    $nuevoCorrelativo = substr($ultimoCorrelativo, 0, strrpos($ultimoCorrelativo, '-') + 1) . sprintf('%07d', $nuevoNumero);
                                                                    return $nuevoCorrelativo;
                                                                } else {
                                                                    return ''; // Si no hay registros, devolver una cadena vacía
                                                                }
                                                            }
                                                        @endphp
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl"> <!-- Cambia modal-lg a modal-md para tamaño mediano -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Agregar Despacho</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form   action="{{url('guiastwo_guardar')}}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf <!-- Agrega esto si estás utilizando CSRF protection en Laravel -->
                                                            <!-- Row para alinear los elementos en la misma fila -->
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="cliente2">Cliente:</label>
                                                                        <select class="form-control" id="cliente2" name="cliente_id2" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                                                                            <option value="">Selecciona un cliente</option>
                                                                            @foreach($clientes as $cliente)
                                                                                <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="proyecto2">Proyecto:</label>
                                                                        <select id="proyecto2" name="proyecto_id2" class="required form-control" required>
                                                                            <option value="">Selecciona un proyecto</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                                <!-- Columna para el input de correlativo -->
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <label for="correlativo" class="form-label">Correlativo:</label>
                                                                        <input type="number" name="correlativo" class="form-control" id="correlativo">
                                                                    </div>
                                                                </div>

                                                                <!-- Columna para el select de motivo -->
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <label for="motivo" class="form-label">Motivo:</label>
                                                                        <select class="form-control" id="motivo" name="motivo" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                                                                            <option value="Despacho por cotización">Despacho por cotización</option>
                                                                            <option value="Despacho sin cotización">Despacho sin cotización</option>
                                                                            <option value="Cambio por garantía">Cambio por garantía</option>
                                                                            <option value="Préstamo">Préstamo</option>
                                                                            <option value="Muestras">Muestras</option>
                                                                            <option value="Transferencia gratuita">Transferencia gratuita</option>
                                                                            <option value="Consignación">Consignación</option>
                                                                            <option value="Venta">Venta</option>
                                                                            <option value="Otros">Otros</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <label for="motivo" class="form-label"></label><br>
                                                                        <button type="button" class="btn btn-success" onclick="agregarElemento()">Agregar Material</button>

                                                                    </div>
                                                                </div>
                                                            </div> <!-- Fin del row -->

                                                            <!-- Botón para agregar elementos dinámicos -->

                                                            <!-- Elementos dinámicos -->
                                                            <div id="dynamicElements">
                                                                <br>
                                                                <!-- Aquí se añadirán los elementos dinámicos -->
                                                            </div>
                                                        </div>
                                                        <div class="loader"></div><br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary" >Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Fecha / Hora</th>
                                                <th>Cliente</th>
                                                <th>Proyecto</th>
                                                <th>Motivo</th>
                                                <th>Guía</th>
                                                <!-- <th>Cod.Art.</th>
                                                <th>Artículo</th> -->
                                                <th>Cantidad</th>
                                                <th>Estado</th>
                                                <th>Usuario</th>
                                                <th>Acción</th>
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <br>
                                            @foreach ($lista as $listado)
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->fecha }}</td>
                                                    <td>{{ $listado->cliente ? $listado->cliente->razon_social : '-' }}</td>
                                                    <td>{{ $listado->proyecto ? $listado->proyecto->proyecto : '-'}}</td>
                                                    <td>{{ $listado->motivo == null ? '-' : $listado->motivo}}</td>
                                                    <td>{{ $listado->guia }}</td>
                                                    <!-- <td></td> -->
                                                    <!-- <td></td> -->
                                                    <td>{{ $listado->cantidad  == null ? '-' : $listado->cantidad}}</td>
                                                    <td>
                                                        @if($listado->estado == 1)
                                                            <h6 style="color:green;">Activo</h6>
                                                        @elseif($listado->estado == 2)
                                                            <h6 style="color:red;">Anulado</h6>
                                                        @elseif($listado->estado == 3)
                                                            <h6 style="color:orange;">Asignado a {{$listado->g1}}</h6>
                                                        @elseif($listado->estado == 4)
                                                            <h6 style="color:orange;">Retorno Completo</h6>
                                                        @elseif($listado->estado == 5)
                                                            <h6 style="color:orange;">Pendiente de Revisión</h6>
                                                        @elseif($listado->estado == 6)
                                                            <h6 style="color:orange;">Pendiente de Retorno</h6>
                                                        @elseif($listado->estado == 0)
                                                            <h6 style="color:red;">Guía Nula</h6>
                                                        @endif
                                                    </td>
                                                    <td>{{ $listado->user->username }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>

                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <!-- <li><a class="dropdown-item" href="#">Editar</a></li> -->
                                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                       data-bs-target="#ver_guia{{$listado->id}}">Visualizar</a>
                                                                </li>
                                                                @if($listado->estado == 1)
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                           data-bs-target="#eliminarModalP{{$listado->id}}">Anular</a>
                                                                    </li>
                                                                @endif
                                                                @if(($listado->motivo == 'Despacho por cotización' || $listado->motivo == 'Despacho sin cotización') && $listado->g1 == null)
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                           data-bs-target="#T01ModalP{{$listado->id}}">Pasar a T001</a>
                                                                    </li>
                                                                @endif
                                                                @if($listado->motivo == 'Cambio por garantía' || $listado->motivo == 'Préstamo' || $listado->motivo == 'Consignación' || $listado->motivo == 'Muestras')
                                                                    <li>
                                                                        <form method="POST"
                                                                                  action="{{ url('estados_guiatwo') }}">
                                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{$listado->id}}">
                                                                                <input type="hidden" name="estado" value="4">
                                                                                <button class="dropdown-item" data-bs-toggle="modal" type="submit">
                                                                                    Retorno Completo
                                                                                </button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        <form method="POST"
                                                                              action="{{ url('estados_guiatwo') }}">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$listado->id}}">
                                                                            <input type="hidden" name="estado" value="5">
                                                                            <button class="dropdown-item" data-bs-toggle="modal" type="submit">
                                                                                Pendiente de Revisón
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        <form method="POST"
                                                                              action="{{ url('estados_guiatwo') }}">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$listado->id}}">
                                                                            <input type="hidden" name="estado" value="6">
                                                                            <button class="dropdown-item" data-bs-toggle="modal" type="submit">
                                                                                Pendiente de Retorno
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                            @if($listado->estado == 1)
                                                                <div class="modal fade"
                                                                     id="eliminarModalP{{$listado->id}}" tabindex="-1"
                                                                     aria-labelledby="eliminarModalP{{$listado->id}}Label"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="eliminarModalP{{$listado->id}}Label">
                                                                                    Anular Guia</h5>
                                                                                <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!-- Aquí puedes mostrar un mensaje de confirmación de eliminación -->
                                                                                <p>¿Desea Anular la guía T002
                                                                                    seleccionado?.</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form method="POST"
                                                                                      action="{{ url('eliminar_guiatwo/' . $listado->id) }}">
                                                                                    @csrf
                                                                                    <!-- @method('DELETE') -->
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">
                                                                                        Anular
                                                                                    </button>
                                                                                </form>
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Cancelar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($listado->motivo == 'Despacho por cotización' || $listado->motivo == 'Despacho sin cotización')
                                                            <div class="modal fade"
                                                                 id="T01ModalP{{$listado->id}}" tabindex="-1"
                                                                 aria-labelledby="T01ModalP{{$listado->id}}Label"
                                                                 aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="T01ModalP{{$listado->id}}Label">
                                                                                Transportar Guia a T001</h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí puedes mostrar un mensaje de confirmación de eliminación -->
                                                                            <p>¿Desea Asignar como guía T001?.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form method="POST"
                                                                                  action="{{ url('transportar_guiatwo/' . $listado->id) }}">
                                                                                @csrf
                                                                                <!-- @method('POST') -->
                                                                                <button type="submit"
                                                                                        class="btn btn-success">
                                                                                    Asignar
                                                                                </button>
                                                                            </form>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cancelar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="modal fade" id="ver_guia{{$listado->id}}"
                                                                 tabindex="-1" aria-labelledby="ver_guia"
                                                                 aria-hidden="true">
                                                                <!-- <div class="modal-dialog"> -->
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Guia
                                                                                - {{$listado->guia}}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <!-- Agrega la clase table-responsive a la tabla -->
                                                                                <div class="table-responsive">
                                                                                    <table id="users-table"
                                                                                           class="table table-striped table-bordered">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Codigo</th>
                                                                                            <th>Descripción</th>
                                                                                            <th>Unidad</th>
                                                                                            <!-- Agrega más columnas según tus necesidades -->
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        @php
                                                                                            $subGuias = App\Models\SubGuiasTwo::where('id_guia_two', $listado->id)->get();
                                                                                        @endphp

                                                                                        @foreach ($subGuias as $subGuia)
                                                                                            <tr>
                                                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $subGuia->materiales->codigo }}</td>
                                                                                                <td>{{ $subGuia->materiales->descripcion }}</td>
                                                                                                <td>{{ $subGuia->unidad }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cerrar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>--}}
<script>
    $(document).ready(function() {
        {{--var text = {{strtoupper($variable)}}--}}
        $('#users-table').DataTable({
            // paging: false,
            // scrollY: 400,
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
            "dom": '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"t>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "pagingType": "simple_numbers",
            "order": [
                [2, 'desc']
            ],
            // "buttons": [
            //     { extend: 'copy', className: 'btn-xs btn btn-default' },
            //     { extend: 'excel', className: 'btn-xs btn btn-default' },
            //     { extend: 'print', className: 'btn-xs btn btn-default' }
            // ]
            "buttons": [
                {
                    extend: 'copy',
                    text: 'Copiar',
                    className: 'btn-xs btn btn-default',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn-xs btn btn-default',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn-xs btn btn-default',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-xs btn btn-default',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
            ]
            // "buttons": [
            //     'copy', 'excel', 'print'
            // ]
        });
    });
</script>
<!-- <style>
    /* Ajustes de estilo para el select y el input */
    .choices-select {
        width: 70%; /* Ajusta el ancho del select según tus necesidades */
    }

    input[type="number"] {
        width: 20%; /* Ajusta el ancho del input de cantidad según tus necesidades */
        margin-left: 10px; /* Añade un espacio entre el select y el input */
    }

    .btn-danger {
        margin-left: 10px; /* Añade un espacio entre el input de cantidad y el botón */
    }
</style> -->

<script>
    var materiales = @json($materiales); // Convertir la variable PHP a JavaScript

    // Función para agregar elementos dinámicos
    function agregarElemento() {
        var container = document.getElementById('dynamicElements');
        var div = document.createElement('div');
        div.classList.add('mb-3');
        div.innerHTML = `
                    <table class="table-responsive" >
                        <tr>
                            <td style="width:80%">
                                <select style="width:57%" class="form-select choices-select" required name="elemento[]">
                                    <option value="">Seleccione</option>
                                    ${materiales.map(mat => `<option value="${mat.id}">${mat.codigo} - ${mat.descripcion}</option>`).join('')}
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="cantidad[]" placeholder="UND" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminarElemento(this)">Eliminar</button>
                            </td>
                        </tr>
                    </table>`;
        container.appendChild(div);

        // Inicializar Choices para el nuevo select
        var selects = document.querySelectorAll('.choices-select');
        selects.forEach(select => {
            new Choices(select, {
                removeItemButton: true,
                placeholder: true
            });
        });
    }

    // Función para eliminar elementos dinámicos
    function eliminarElemento(button) {
        button.parentElement.parentElement.parentElement.remove();
    }
</script>
<script>
    document.getElementById('cliente2').addEventListener('change', function() {
        var clienteId = this.value;
        console.log(this)
        if (clienteId) {
            fetch('/proyecto/' + clienteId)
                .then(response => response.json())
                .then(data => {
                    var proyectoSelect = document.getElementById('proyecto2');
                    proyectoSelect.innerHTML = '<option value="">Selecciona un proyecto</option>';
                    data.forEach(proyecto => {
                        proyectoSelect.innerHTML += '<option value="' + proyecto.id + '">' + proyecto.proyecto + '</option>';
                    });
                });
        } else {
            document.getElementById('proyecto2').innerHTML = '<option value="">No existe</option>';
        }
    });
</script>

{{--<script>--}}
{{--    document.getElementById('cliente').addEventListener('change', function() {--}}
{{--        var clienteId = this.value;--}}
{{--        if (clienteId) {--}}
{{--            fetch('/proyecto/' + clienteId)--}}
{{--                .then(response => response.json())--}}
{{--                .then(data => {--}}
{{--                    var proyectoSelect = document.getElementById('proyecto');--}}
{{--                    proyectoSelect.innerHTML = '<option value="">Selecciona un proyecto</option>';--}}
{{--                    data.forEach(proyecto => {--}}
{{--                        proyectoSelect.innerHTML += '<option value="' + proyecto.id + '">' + proyecto.proyecto + '</option>';--}}
{{--                    });--}}
{{--                });--}}
{{--        } else {--}}
{{--            document.getElementById('proyecto').innerHTML = '<option value="">Selecciona un proyecto</option>';--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
