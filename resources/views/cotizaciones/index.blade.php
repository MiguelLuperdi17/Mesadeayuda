<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
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
                    <h2 class="mb-0">Cotizaciones</h2>
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
                                        <div class="col-12 col-sm-auto">
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#01aef0;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#miModal">Importar Archivo
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="miModal" tabindex="-1"
                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Cargar Cotización</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" name="formArchivo" class="cliente"
                                                              id="formArchivo" enctype="multipart/form-data">
                                                            <!-- <form id="formArchivo" method="POST" action="{{url('cargar_html')}}" enctype="multipart/form-data"> -->
                                                            @csrf
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- Primer campo de selección -->
                                                                        <div class="mb-3">
                                                                            <select class="form-select select33"
                                                                                    name="id_cliente" id="select3"
                                                                                    data-choices="data-choices"
                                                                                    data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                    required>
                                                                                <option value="0" selected>Seleccionar
                                                                                </option>
                                                                                @foreach ($lista_cliente as $clientes_l)
                                                                                    <option
                                                                                        value="{{ $clientes_l->id }}">{{ $clientes_l->razon_social }}</option>
                                                                                    <!-- Asegúrate de cambiar 'nombre' por el nombre del campo que contiene el nombre del cliente -->
                                                                                @endforeach
                                                                            </select>
                                                                            <!-- <select class="form-select" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'> -->
                                                                        </div>
                                                                        <!-- Segundo campo de selección -->
                                                                        <div class="mb-3">
                                                                            <select class="form-select select22"
                                                                                    name="id_proyecto" id="select2"
                                                                                    required>
                                                                                <!-- <option value="0" selected>Proyecto</option> -->
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="file"
                                                                                   class="form-control archivo"
                                                                                   id="archivo" name="archivo"
                                                                                   accept=".html, .htm, .xlsx, .xls"
                                                                                   required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-md-6" id="inputs-datos">

                                                                    <div class="col-12">

                                                                        <div id="inputs-container"
                                                                             class="tabla-container inputs-container">
                                                                            <center><img src="./recursos/gif.gif"
                                                                                         class="gif" id="gif"
                                                                                         style="width:100px; position:absolute;display:none;">
                                                                            </center>
                                                                            <!-- <div class="table-title" id="table-title"></div> -->
                                                                            <!-- Aquí se agregarán dinámicamente los inputs -->
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row col-md-6">
                                                                </div> -->
                                                                <div class="row col-md-6">
                                                                    <!-- Primer campo de selección -->

                                                                    <div class="mb-3">
                                                                        <div id="vistaPrevia" class="contenido-archivo"
                                                                             style="height: 450px; ">

                                                                            <!-- Aquí se mostrará la vista previa -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <!-- Botones para enviar y cerrar el modal -->
                                                                        <div class="loader"></div>
                                                                        <br>

                                                                        <div class="modal-footer">
                                                                            <button type="button" id="btnEnviar"
                                                                                    class="btn btn-primary btnEnviare">
                                                                                Confirmar
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cerrar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Cotización</th>
                                                <th>Proyecto</th>
                                                <th>Cliente</th>
                                                <th>Total Productos</th>
                                                <th>Avance</th>
                                                <th>Usuario</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($lista as $listado)
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->id }}</td>
                                                    <td>{{ $listado->fecha }}</td>
                                                    <td>{{ $listado->cotizacion }}</td>
                                                    <td>{{ $listado->proyecto->proyecto }}</td>
                                                    <td>{{ $listado->cliente->razon_social }}</td>
                                                    <td>
                                                        {{ $listado->programado }}
                                                    </td>
                                                    <td>
                                                        @if($listado->avance == NULL)
                                                            0 &nbsp; (0%)
                                                        @else
                                                            {{ $listado->avance }} &nbsp;
                                                            ({{ round(($listado->avance / $listado->programado) * 100, 2) }}
                                                            %)
                                                        @endif
                                                    </td>
                                                    <td>{{ $listado->user->username }}</td>
                                                    <td>
                                                        @if($listado->estado == 1)
                                                            <h6 style="color:orange;">Pendiente</h6>
                                                        @elseif($listado->estado == 2)
                                                            <h6 style="color:green;">Finalizado</h6>
                                                        @elseif($listado->estado == 3)
                                                            <h6 style="color:red;">Anulada</h6>
                                                        @endif
                                                    </td>

                                                    <td>

                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <li><a class="dropdown-item"
                                                                       href="{{ url('despacho/' . $listado->id) }}">Visualizar</a>
                                                                </li>
                                                                @if ($listado->estado != 3)
                                                                    <li><a class="dropdown-item" href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#despachoModal{{$listado->id}}">Despacho</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#editarModal{{$listado->id}}">Editar</a>
                                                                    </li>
                                                                    @if($listado->avance == 0)
                                                                        <li><a class="dropdown-item" href="#"
                                                                               data-bs-toggle="modal"
                                                                               data-bs-target="#AnularModal{{$listado->id}}">Anular</a>
                                                                        </li>
                                                                    @else
                                                                        <li><a class="dropdown-item" href="#"
                                                                               data-bs-toggle="modal"
                                                                               data-bs-target="#NotaIngreso{{$listado->id}}">Nota
                                                                                de Ingreso</a>
                                                                        </li>
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>

                                                        <div class="modal fade" id="despachoModal{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="miModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Linkear Guia</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" name="formArchivo"
                                                                              action="{{url('link_c_guia')}}"
                                                                              id="formArchivo">
                                                                            @csrf
                                                                            <div class="col-12">
                                                                                <!-- Tercer campo de selección -->
                                                                                <div class="mb-3">
                                                                                    <!-- <select class="form-select" name="guia"  id="guia" required> -->

                                                                                    <input type="hidden"
                                                                                           class="id_cotizacion"
                                                                                           name="id_cotizacion"
                                                                                           value="{{$listado->id}}">

                                                                                    <select class="form-select guias"
                                                                                            name="guias" id="guias"
                                                                                            data-choices="data-choices"
                                                                                            data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                            required>
                                                                                        <option value="0" selected>
                                                                                            Seleccionar
                                                                                        </option>
                                                                                        @foreach ($lista_guias_filtro as $guias_l)
                                                                                            <option
                                                                                                value="{{ $guias_l->id }}">{{ $guias_l->guia }}</option>
                                                                                            <!-- Asegúrate de cambiar 'nombre' por el nombre del campo que contiene el nombre del cliente -->
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Cerrar
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                    Linkear
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="editarModal{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="miModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Editar Correlativo</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" name="formArchivo"
                                                                              action="{{url('editar_correlativo')}}"
                                                                              id="formArchivo">
                                                                            @csrf
                                                                            <div class="col-12">
                                                                                <!-- Tercer campo de selección -->
                                                                                <div class="mb-3">
                                                                                    <!-- <select class="form-select" name="guia"  id="guia" required> -->
                                                                                    <input type="hidden"
                                                                                           class="id_cotizacion"
                                                                                           name="id_cotizacion"
                                                                                           value="{{$listado->id}}">
                                                                                    <label>Ingresar Codigo</label>
                                                                                    <input type="text"
                                                                                           class="form-control codigo"
                                                                                           name="codigo" id="codigo"
                                                                                           value="{{$listado->cotizacion}}"
                                                                                           required>
                                                                                    <br>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Cerrar
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                    Guardar
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="AnularModal{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="miModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Anular Cotización</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" name="formArchivo"
                                                                              action="{{url('anular')}}"
                                                                              id="formArchivo">
                                                                            @csrf
                                                                            <div class="col-12">
                                                                                <div class="mb-3">
                                                                                    <h4 style="text-align: center;">
                                                                                        ¿Estás Seguro que deseas anular
                                                                                        la cotización?</h4>
                                                                                    <br>
                                                                                    <h4 style="text-align: center;">{{$listado->cotizacion}}</h4>
                                                                                    <input type="hidden"
                                                                                           class="id_cotizacion"
                                                                                           name="id_cotizacion"
                                                                                           value="{{$listado->id}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer"
                                                                                 style="justify-content: center;">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Cancelar
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">Anular
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="NotaIngreso{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="miModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <!-- Cambia modal-lg a modal-md para tamaño mediano -->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="miModalLabel">
                                                                            Agregar Despacho</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{url('NotaIngreso')}}" method="POST">
                                                                        <div class="modal-body">
                                                                            @csrf <!-- Agrega esto si estás utilizando CSRF protection en Laravel -->
                                                                            <!-- Row para alinear los elementos en la misma fila -->
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label"
                                                                                               for="sel_guia{{$listado->id}}">Guía:</label>
                                                                                        <select class="form-control"
                                                                                                id="sel_guia{{$listado->id}}"
                                                                                                name="sel_guia"
                                                                                                data-choices="data-choices"
                                                                                                data-options='{"removeItemButton":true,"placeholder":true}'>
                                                                                            @if($listado->guias)
                                                                                                <option value="">
                                                                                                    Selecciona una Guía
                                                                                                </option>
                                                                                                @foreach($listado->guias as $guia)
                                                                                                    <option
                                                                                                        value="{{$guia->id}}">{{$guia->guia}}</option>
                                                                                                @endforeach
                                                                                            @else
                                                                                                <option value="">No
                                                                                                    existen guías
                                                                                                </option>
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3"
                                                                                         id="material{{$listado->id}}">
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
                                                                        <div class="loader"></div>
                                                                        <br>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cerrar
                                                                            </button>
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">Guardar
                                                                            </button>
                                                                        </div>
                                                                    </form>
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
{{--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/css/select2.min.css" rel="stylesheet"/>--}}
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

@foreach($lista as $listado)
    <script>
        document.getElementById('sel_guia{{$listado->id}}').addEventListener('change', function () {
            var guiaId = this.value;
            var cont = 0;
            console.log(guiaId);
            var materialContainer = document.getElementById('material{{$listado->id}}');

            if (guiaId) {
                fetch('/materiales/' + guiaId)
                    .then(response => response.json())
                    .then(data => {
                        let tableHtml = `
                    <h2>Materiales:</h2>
                    <table class="table table-striped table-bordered" style="text-align: center; vertical-align: middle;">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th>Cantidad</th>
                                <th>Devuelto</th>
                            </tr>
                        </thead>
                        <tbody>`;

                        data.forEach(material => {
                            if (material.cantidad === 0) {
                                tableHtml += '<tr><td colspan="4">Tiene nota de ingreso</td></tr>'
                            }else{
                                tableHtml += `
                                <tr>
                                    <td style="width: 25%">${material.descripcion}</td>
                                    <td style="width: 25%">${material.codigo}</td>
                                    <td style="width: 25%">${material.cantidad}</td>
                                    <td style="width: 25%"><input class="form-control" type="number" min="0" max="${material.cantidad}" name="devuelto_${material.id}" id="devuelto_${material.id}" placeholder="Devuelto"></td>
                                </tr>`;
                            }
                        });

                        tableHtml += `</tbody></table>`;
                        materialContainer.innerHTML = tableHtml;
                    })
                    .catch(error => {
                        console.error('Error fetching materials:', error);
                        materialContainer.innerHTML = '<p>Error loading materials. Please try again.</p>';
                    });
            } else {
                materialContainer.innerHTML = '<p>No existe</p>';
            }
        });
    </script>
@endforeach


<script>
    $(document).ready(function () {
        // Función para habilitar o deshabilitar el campo de entrada de archivos
        function toggleFileInput() {
            var proyectoSeleccionado = $('.select22').val() != '0';
            var clienteSeleccionado = $('.select33').val() != '0';

            // Si ambos selectores tienen un valor seleccionado, habilitar el campo de entrada de archivos
            if (proyectoSeleccionado && clienteSeleccionado) {
                $('#archivo').prop('disabled', false);
            } else {
                // De lo contrario, deshabilitarlo
                $('#archivo').prop('disabled', true);
            }
        }

        // Llamar a la función toggleFileInput al cambiar la selección en cualquiera de los selectores
        $('#select2, #select3').change(function () {
            toggleFileInput();
        });

        // Llamar a la función al cargar la página para asegurarse de que el estado inicial del campo de entrada de archivos sea correcto
        toggleFileInput();
    });
</script>
<script>
    document.getElementById('cliente2').addEventListener('change', function () {
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
<script>
    document.getElementById('archivo').addEventListener('change', function () {
        var archivo = this.files[0];
        var lector = new FileReader();

        lector.onload = function (evento) {
            var contenido = evento.target.result;

            // Verificar si el archivo es HTML
            if (archivo.name.endsWith('.html') || archivo.name.endsWith('.htm')) {
                // Visualizar el contenido HTML
                var preElement = document.createElement('pre');
                preElement.style.height = '450px'; // Cambia el valor de 500px al ancho deseado
                preElement.innerHTML = contenido;
                document.getElementById('vistaPrevia').innerHTML = '';
                document.getElementById('vistaPrevia').appendChild(preElement);
            } else {
                // Leer el archivo de Excel (XLSX)
                var workbook = XLSX.read(contenido, {type: 'binary'});
                var sheet = workbook.Sheets[workbook.SheetNames[0]];
                var html = XLSX.utils.sheet_to_html(sheet);

                // Mostrar la vista previa del archivo de Excel
                document.getElementById('vistaPrevia').innerHTML = html;

                // Aplicar estilos a la tabla generada
                document.querySelectorAll('#vistaPrevia table').forEach(table => {
                    table.style.borderCollapse = 'collapse';
                    table.style.width = '100%';
                    table.style.border = '1px solid #ddd';
                });

                document.querySelectorAll('#vistaPrevia th, #vistaPrevia td').forEach(cell => {
                    cell.style.padding = '8px';
                    cell.style.border = '1px solid #ddd';
                });

                document.querySelectorAll('#vistaPrevia th').forEach(cell => {
                    cell.style.backgroundColor = '#f2f2f2';
                    cell.style.color = '#333';
                });
            }

            // Cambiar el texto y el color del botón
            document.getElementById('btnEnviar').innerText = 'Guardar';
            document.getElementById('btnEnviar').classList.remove('btn-primary');
            document.getElementById('btnEnviar').classList.add('btn-success');
        }

        if (archivo.name.endsWith('.html') || archivo.name.endsWith('.htm')) {
            // Leer el contenido del archivo HTML como texto
            lector.readAsText(archivo);
        } else {
            // Leer el contenido del archivo como una secuencia binaria
            lector.readAsBinaryString(archivo);
        }
    });
</script>

<script>
    $(function () {
        $(".archivo").on("change", function () {
            if ($(this).val() !== '') {
                // Limpiar la tabla antes de cargar nuevos datos
                $('#inputs-container').empty();

                var url = "/cargar_html";
                var data = new FormData(document.getElementById("formArchivo"));
                $(".gif").show(); // Mostrar el gif de carga
                $.ajax({
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    url: url,
                    success: function (response) {
                        var archivo_formato = response.archivo_formato; // Suponiendo que la data necesaria está dentro de la propiedad 'data' de response
                        if (archivo_formato == "html") {
                            console.log("deberia html", response);
                            // Parsear la respuesta JSON
                            var responseData = response;

                            // Verificar si las variables están presentes en la respuesta
                            if (responseData.hasOwnProperty('variable1') && responseData.hasOwnProperty('variable2') && responseData.hasOwnProperty('variable3')) {
                                var variable3Parte = responseData.variable3;
                                if (typeof variable3Parte === 'string') {
                                    // Buscar la parte de la cadena que comienza con "COT" utilizando una expresión regular
                                    var regex = /COT-.*/;
                                    var match = variable3Parte.match(regex);
                                    if (match && match.length > 0) {
                                        variable3Parte = match[0];
                                    }
                                }
                                // Crear el título de la tabla con la parte deseada de variable3
                                var tableTitle = $('<h5>').text("COTIZACIÓN: " + variable3Parte).addClass('text-center mt-4'); // Clases de Bootstrap para centrar y agregar margen arriba
                                $('#inputs-container').append(tableTitle);
                                console.log("esponseData.variable3", variable3Parte);

                                var consolidatedData = consolidateData(responseData.variable1, responseData.variable2, responseData.variable4);

                                var tabla = $('<table>').addClass('table mt-4  my-table'); // Agregar margen arriba a la tabla
                                var headerRow = $('<tr>');
                                headerRow.append($('<th>').text('CODIGO'));
                                headerRow.append($('<th>').text('DESCRIPCION'));
                                headerRow.append($('<th>').text('CANTIDAD'));
                                tabla.append(headerRow);
                                // Iterar sobre los datos consolidados y agregarlos a la tabla
                                consolidatedData.forEach(function (item) {
                                    var fila = $('<tr>');
                                    var variable1Cell = $('<td>').text(item.variable1);
                                    var variable4Cell = $('<td>'); // Celda para la descripción truncada
                                    var fullDescription = item.variable4; // Descripción completa para el atributo title
                                    if (fullDescription.length > 30) {
                                        // Si la descripción es más larga de 30 caracteres, truncarla y agregar puntos suspensivos
                                        var truncatedDescription = fullDescription.substring(0, 30) + '...';
                                        variable4Cell.attr('title', fullDescription).text(truncatedDescription);
                                    } else {
                                        // Si la descripción es corta, mostrarla completa y sin puntos suspensivos
                                        variable4Cell.text(fullDescription);
                                    }
                                    var variable2Cell = $('<td>').text(item.variable2);
                                    fila.append(variable1Cell).append(variable4Cell).append(variable2Cell);
                                    tabla.append(fila);
                                });

                                $('#inputs-container').append(tabla);

                                // Resaltar las filas correspondientes
                                var codigosNoExistentes = responseData.codigos_no_existentes;
                                var codigosNoExistentesCount = 0; // Contador para los códigos inexistentes

                                if (codigosNoExistentes) {
                                    console.log("Códigos no existentes:", codigosNoExistentes); // Verificar qué valores contiene codigosNoExistentes

                                    // Verificar si codigosNoExistentes es un array
                                    if (Array.isArray(codigosNoExistentes)) {
                                        console.log("Es un array");
                                        // Si es un array, iterar sobre cada código no existente
                                        codigosNoExistentes.forEach(function (codigo) {
                                            console.log("Código no existente:", codigo);
                                            $('table tr').each(function () {
                                                var codigoFila = $(this).find('td:eq(0)').text().trim(); // Suponiendo que el código está en la primera columna
                                                // Excluir cadena vacía de las comparaciones
                                                if (codigoFila !== "") {
                                                    console.log("Código en la fila:", codigoFila);
                                                    // Convertir ambos códigos a cadenas antes de comparar
                                                    if (codigoFila.toString() === codigo.toString()) {
                                                        console.log("Coincidencia encontrada:", codigo);
                                                        $(this).css('background-color', 'red');
                                                        // Cambiar el color del texto a white
                                                        $(this).find('td').css('color', 'white');
                                                        // Incrementar el contador de códigos inexistentes
                                                        codigosNoExistentesCount++;
                                                        // Agregar atributo title a la fila
                                                        $(this).attr('title', 'Este código no se encuentra registrado');
                                                    }
                                                }
                                            });
                                        });
                                    } else {
                                        console.log("No es un array");
                                        // Si no es un array, asumimos que es un objeto con claves numéricas
                                        // Iterar sobre cada clave del objeto
                                        Object.keys(codigosNoExistentes).forEach(function (key) {
                                            var codigo = codigosNoExistentes[key];
                                            console.log("Código no existente:", codigo);
                                            $('table tr').each(function () {
                                                var codigoFila = $(this).find('td:eq(0)').text().trim(); // Suponiendo que el código está en la primera columna
                                                // Excluir cadena vacía de las comparaciones
                                                if (codigoFila !== "") {
                                                    console.log("Código en la fila:", codigoFila);
                                                    // Convertir ambos códigos a cadenas antes de comparar
                                                    if (codigoFila.toString() === codigo.toString()) {
                                                        console.log("Coincidencia encontrada:", codigo);
                                                        $(this).css('background-color', 'red');
                                                        // Cambiar el color del texto a white
                                                        $(this).find('td').css('color', 'white');
                                                        // Incrementar el contador de códigos inexistentes
                                                        codigosNoExistentesCount++;
                                                        // Agregar atributo title a la fila
                                                        $(this).attr('title', 'Este código no se encuentra registrado');
                                                    }
                                                }
                                            });
                                        });
                                    }
                                }

                                // Deshabilitar el botón Confirmar si hay al menos un código inexistente
                                if (codigosNoExistentesCount > 0) {
                                    $('#btnEnviar').prop('disabled', true);
                                    $('#btnEnviar').attr('title', 'No se puede confirmar mientras haya códigos no registrados');
                                } else {
                                    $('#btnEnviar').prop('disabled', false);
                                    $('#btnEnviar').removeAttr('title');
                                }

                            } else {
                                console.log('Las variables no están presentes en la respuesta JSON.');
                            }

                            // Ocultar el gif de carga después de un tiempo
                            $(".gif").hide();
                        } else {
                            console.log("deberia excel", response);
                            var responseData = response;

                            if (responseData.hasOwnProperty('codigos') && responseData.hasOwnProperty('descripciones') && responseData.hasOwnProperty('precios')) {
                                // Crear el título de la tabla
                                var tableTitle = $('<h5>').text("COTIZACIÓN: " + responseData.cotizacion).addClass('text-center mt-4'); // Clases de Bootstrap para centrar y agregar margen arriba
                                $('#inputs-container').append(tableTitle);

                                // var tableTitle = $('<h5>').text("Datos del archivo cargado").addClass('text-center mt-4');
                                // $('#inputs-container').append(tableTitle);

                                var tabla = $('<table>').addClass('table mt-4 my-table');
                                var headerRow = $('<tr>');
                                headerRow.append($('<th>').text('CODIGO'));
                                headerRow.append($('<th>').text('DESCRIPCION'));
                                headerRow.append($('<th>').text('CANTIDAD'));
                                tabla.append(headerRow);

                                // Iterar sobre los datos y agregarlos a la tabla
                                // for (var i = 0; i < responseData.codigos.length; i++) {
                                //     var fila = $('<tr>');
                                //     fila.append($('<td>').text(responseData.descripciones[i]));
                                //     fila.append($('<td>').text(responseData.descripciones_encontradas[i]));
                                //     fila.append($('<td>').text(responseData.codigos[i]));
                                //     tabla.append(fila);
                                // }
                                for (var i = 0; i < responseData.codigos.length; i++) {
                                    var descripcionCompleta = responseData.descripciones_encontradas[i];
                                    var descripcionCortaConPuntos = '';

                                    // Verificar si hay una descripción completa disponible
                                    if (descripcionCompleta) {
                                        var descripcionCorta = descripcionCompleta.substring(0, 18);
                                        descripcionCortaConPuntos = (descripcionCompleta.length > 18) ? descripcionCorta + '...' : descripcionCorta;
                                    }

                                    var descripcionCell = $('<td>').text(descripcionCortaConPuntos);
                                    // Establecer el título solo si hay una descripción completa
                                    if (descripcionCompleta) {
                                        descripcionCell.attr('title', descripcionCompleta);
                                    }

                                    var fila = $('<tr>');
                                    fila.append($('<td>').text(responseData.descripciones[i]));
                                    fila.append(descripcionCell);
                                    fila.append($('<td>').text(responseData.codigos[i]));
                                    tabla.append(fila);
                                }

                                $('#inputs-container').append(tabla);
                                // Resaltar las filas correspondientes
                                var codigosNoExistentes = responseData.codigos_no_existentes;
                                var codigosNoExistentesCount = 0; // Contador para los códigos inexistentes

                                if (codigosNoExistentes) {
                                    console.log("Códigos no existentes:", codigosNoExistentes); // Verificar qué valores contiene codigosNoExistentes

                                    // Verificar si codigosNoExistentes es un array
                                    if (Array.isArray(codigosNoExistentes)) {
                                        console.log("Es un array");
                                        // Si es un array, iterar sobre cada código no existente
                                        codigosNoExistentes.forEach(function (codigo) {
                                            console.log("Código no existente:", codigo);
                                            $('table tr').each(function () {
                                                var codigoFila = $(this).find('td:eq(0)').text().trim(); // Suponiendo que el código está en la primera columna
                                                // Excluir cadena vacía de las comparaciones
                                                if (codigoFila !== "") {
                                                    console.log("Código en la fila:", codigoFila);
                                                    // Convertir ambos códigos a cadenas antes de comparar
                                                    if (codigoFila.toString() === codigo.toString()) {
                                                        console.log("Coincidencia encontrada:", codigo);
                                                        $(this).css('background-color', 'red');
                                                        // Cambiar el color del texto a white
                                                        $(this).find('td').css('color', 'white');
                                                        // Incrementar el contador de códigos inexistentes
                                                        codigosNoExistentesCount++;
                                                        // Agregar atributo title a la fila
                                                        $(this).attr('title', 'Este código no se encuentra registrado');
                                                    }
                                                }
                                            });
                                        });
                                    } else {
                                        console.log("No es un array");
                                        // Si no es un array, asumimos que es un objeto con claves numéricas
                                        // Iterar sobre cada clave del objeto
                                        Object.keys(codigosNoExistentes).forEach(function (key) {
                                            var codigo = codigosNoExistentes[key];
                                            console.log("Código no existente:", codigo);
                                            $('table tr').each(function () {
                                                var codigoFila = $(this).find('td:eq(0)').text().trim(); // Suponiendo que el código está en la primera columna
                                                // Excluir cadena vacía de las comparaciones
                                                if (codigoFila !== "") {
                                                    console.log("Código en la fila:", codigoFila);
                                                    // Convertir ambos códigos a cadenas antes de comparar
                                                    if (codigoFila.toString() === codigo.toString()) {
                                                        console.log("Coincidencia encontrada:", codigo);
                                                        $(this).css('background-color', 'red');
                                                        // Cambiar el color del texto a white
                                                        $(this).find('td').css('color', 'white');
                                                        // Incrementar el contador de códigos inexistentes
                                                        codigosNoExistentesCount++;
                                                        // Agregar atributo title a la fila
                                                        $(this).attr('title', 'Este código no se encuentra registrado');
                                                    }
                                                }
                                            });
                                        });
                                    }
                                }

                                // Deshabilitar el botón Confirmar si hay al menos un código inexistente
                                if (codigosNoExistentesCount > 0) {
                                    $('#btnEnviar').prop('disabled', true);
                                    $('#btnEnviar').attr('title', 'No se puede confirmar mientras haya códigos no registrados');
                                } else {
                                    $('#btnEnviar').prop('disabled', false);
                                    $('#btnEnviar').removeAttr('title');
                                }
                            } else {
                                console.log('Los datos no están presentes en la respuesta JSON.');
                            }

                            // Ocultar el gif de carga después de un tiempo
                            $(".gif").hide();
                        }


                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $(".gif").hide(); // Ocultar el gif de carga en caso de error
                        $('#ajax-alert').addClass('alert-danger').show(function () {
                            $(this).html(xhr.responseText); // Mostrar el mensaje de error en la alerta de peligro
                        });
                        setTimeout(function () {
                            $('#ajax-alert').removeClass('alert-danger').hide();
                        }, 5000);
                    }
                });
            }
        });
    });

    // Función para consolidar los datos repetidos y sumar sus cantidades
    function consolidateData(variable1, variable2, variable4) {
        var consolidatedData = [];
        var indexMap = {};

        // Iterar sobre los datos originales
        for (var i = 0; i < variable1.length; i++) {
            var key = variable1[i] + '-' + variable2[i] + '-' + variable4[i];
            if (indexMap.hasOwnProperty(key)) {
                // Si ya existe una entrada para esta combinación, sumar la cantidad
                consolidatedData[indexMap[key]].variable2 += parseFloat(variable2[i]);
            } else {
                // Si no existe, agregar una nueva entrada
                indexMap[key] = consolidatedData.length;
                consolidatedData.push({
                    variable1: variable1[i],
                    variable2: parseFloat(variable2[i]), // Convertir a número
                    variable4: variable4[i]
                });
            }
        }

        return consolidatedData;
    }

    // Evento para mostrar el mensaje al pasar el mouse sobre el botón bloqueado
    $('#btnEnviar').mouseenter(function () {
        if ($(this).prop('disabled')) {
            $(this).attr('title', 'No se puede confirmar mientras haya códigos no registrados');
        }
    });

    // Evento para eliminar el mensaje al retirar el mouse del botón bloqueado
    $('#btnEnviar').mouseleave(function () {
        $(this).removeAttr('title');
    });
</script>
<script>
    $('.btnEnviare').click(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var variableProyecto = null;
        var variableCliente = null;
        var variable1Values = [];
        var variable2Values = [];
        var variable4Values = [];
        var variable5Values = [];

        var proyectoSeleccionado = $('#select2').val() != '0';
        var clienteSeleccionado = $('#select3').val() != '0';
        var archivoSeleccionado = $('#archivo').val() != '';

        if (proyectoSeleccionado && clienteSeleccionado && archivoSeleccionado) {
            variableProyecto = $('#select2').val();
            variableCliente = $('#select3').val();
            var tableTitle = $('#inputs-container').find('h5').text().trim();
            var regex = /COT-.*/;
            var match = tableTitle.match(regex);
            if (match && match.length > 0) {
                tableTitle = match[0];
            }
            variable5Values.push(tableTitle);

            $('#inputs-container').find('table  tr').slice(1).each(function () {
                var variable1 = $(this).find('td:eq(0)').text().trim();
                var variable4 = $(this).find('td:eq(1)').text().trim();
                var variable2 = $(this).find('td:eq(2)').text().trim();

                // Agregar valores a los arrays
                variable1Values.push(variable1);//CODGIO
                variable4Values.push(variable4);//DESCRIPCION
                variable2Values.push(variable2);//CANTIDAD
            });
            console.log('Variable 1:', variable1Values);
            console.log('Variable 4:', variable4Values);
            console.log('Variable 2:', variable2Values);
            console.log('titulo:', variable5Values);

            $.ajax({
                method: 'POST',
                url: 'cargar_html_post',
                data: {
                    codigo: variable1Values,
                    desripcion: variable4Values,
                    cantidad: variable2Values,
                    titulo: variable5Values,
                    variableProyecto: variableProyecto,
                    variableCliente: variableCliente
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    console.log(response);
                    $('#ajax-alert').addClass('alert-info').show(function () {
                        $(this).html("Registrado Correctamente");
                    });
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#ajax-alert').addClass('alert-danger').show(function () {
                        $(this).html(xhr.responseText); // Mostrar el mensaje de error en la alerta de peligro
                    });
                    setTimeout(function () {
                        $('#ajax-alert').removeClass('alert-danger').hide();
                    }, 5000);
                }
            });
        } else {
            alert('Por favor completa todos los campos antes de enviar los datos.');
        }
    });

</script>
<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function () {
        // Obtiene el elemento select de cliente
        var selectCliente = document.getElementById('select3');

        // Añade un evento de cambio al select de cliente
        selectCliente.addEventListener('change', function () {
            var clienteId = this.value;
            var selectProyectos = document.getElementById('select2');

            // Realizar la solicitud AJAX
            fetch('/proyectos-por-cliente?cliente_id=' + clienteId)
                .then(response => response.json())
                .then(data => {
                    // Limpiar el select de proyectos
                    selectProyectos.innerHTML = '';

                    // Agregar las opciones de proyectos
                    data.forEach(proyecto => {
                        var option = document.createElement('option');
                        option.value = proyecto.id;
                        option.textContent = proyecto.proyecto; // Suponiendo que tienes un campo 'nombre' en tu modelo Proyecto
                        selectProyectos.appendChild(option);
                    });
                });
        });
    });
</script>

</body>
</html>
