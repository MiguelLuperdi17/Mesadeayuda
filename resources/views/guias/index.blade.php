<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
@include('layouts.tableStyle')
<style>
    .my-table th,
    .my-table td {
        font-size: 12px; /* Ajusta el tamaño de la letra según tus preferencias */
    }
</style>
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <section class="pt-1 pb-9">
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Guias T001</h2>
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
                                    <div class="col-12 col-sm-auto flex-1">
                                        <!-- <div class="col-12 col-sm-auto ">
                                            <button class="btn btn-default" style="background-color:#01aef0;color:#fff">Cargar Archivo</button>
                                        </div> -->
                                        <div class="col-12 col-sm-auto">
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#01aef0;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#miModal">Cargar Archivo
                                            </button>
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#2ba708;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#miModalAnulada">Guia Nula
                                            </button>

                                        </div>
                                        <br>
                                        <!-- Modal -->
                                        <div class="modal fade" id="miModal" tabindex="-1"
                                             aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Cargar Guia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <form   method="POST" name="formArchivo" id="formArchivo" enctype="multipart/form-data"> -->
                                                        <form method="POST" name="formArchivo" id="formArchivo"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class=" col-md-6" id="inputs-datos">

                                                                    <div class="col-12">
                                                                        <!-- Tercer campo de selección -->
                                                                        <div class="mb-3">
                                                                            <label>Motivo</label>
                                                                            <select class="form-select select22"
                                                                                    name="select2" id="select2"
                                                                                    required>
                                                                                <!-- <option value="0" selected >Motivo</option> -->
                                                                                <option value="Despacho por cotización">
                                                                                    Despacho por cotización
                                                                                </option>
                                                                                <option value="Despacho sin cotización">
                                                                                    Despacho sin cotización
                                                                                </option>
                                                                                <option value="Cambio por garantía">
                                                                                    Cambio por garantía
                                                                                </option>
                                                                                <option value="Préstamo">Préstamo
                                                                                </option>
                                                                                <option value="Muestras">Muestras
                                                                                </option>
                                                                                <option value="Transferencia gratuita">
                                                                                    Transferencia gratuita
                                                                                </option>
                                                                                <option value="Consignación">
                                                                                    Consignación
                                                                                </option>
                                                                                <option value="Venta">Venta</option>
                                                                                <option value="Otros">Otros</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <!-- Primer campo de selección -->
                                                                        <div class="mb-3">
                                                                            <input type="file"
                                                                                   class="form-control archivo"
                                                                                   id="archivo" name="archivo"
                                                                                   accept=".html, .htm" required>
                                                                        </div>
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
                                                                    <div class="mb-3">
                                                                        <div id="vistaPrevia" class="contenido-archivo"
                                                                             style="height: 500px; ">

                                                                            <!-- Aquí se mostrará la vista previa -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <!-- Botones para enviar y cerrar el modal -->
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

                                        <!-- Modal -->
                                        <div class="modal fade" id="miModalAnulada" tabindex="-1"
                                             aria-labelledby="miModalLabelA" aria-hidden="true">
                                            <div class="modal-dialog modal-xs">
                                                <!-- Cambiado de modal-dialog a modal-xl -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabelA">Crear Guia Nula</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <form   method="POST" name="formArchivo" id="formArchivo" enctype="multipart/form-data"> -->
                                                        <form method="POST" id="cliente" name="formArchivo"
                                                              action="{{url('guia_nulas')}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12" id="inputs-datos">
                                                                    <div class="col-12">
                                                                        <!-- Tercer campo de selección -->
                                                                        <div class="mb-2">
                                                                            <input type="hidden" name="dato_nulo"
                                                                                   value="{{ obtenerNuevoCorrelativo() }}">
                                                                            <!-- Mostrar el nuevo correlativo -->
                                                                            <label id="correlativo" readonly> ¿Esta
                                                                                seguro de crear la
                                                                                guía {{ obtenerNuevoCorrelativo() }}nula
                                                                                ?</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="loader"></div>
                                                                        <br>
                                                                        <!-- Botones para enviar y cerrar el modal -->
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btnEnviar"
                                                                                    class="btn btn-primary" {{ obtenerNuevoCorrelativo() == '' ? 'disabled' : '' }}>
                                                                                Guardar
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

                                                        @php
                                                            function obtenerNuevoCorrelativo() {
                                                                // Realizar una consulta para obtener el último correlativo
                                                                $ultimoCorrelativo = App\Models\Guias::orderBy('id', 'desc')->pluck('guia')->first();
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
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Fecha/Hora</th>
                                                <th>Motivo</th>
                                                <th>Guía</th>
                                                <th>Cantidad</th>
                                                <th>Link</th>
                                                <th>Usuario</th>
                                                <th>Status</th>

                                                <th>Acciones</th>

                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($lista as $listado)
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;{{ $listado->fecha }}</td>
                                                    <td>{{ $listado->motivo }}</td>
                                                    <td>{{ $listado->guia }}</td>
                                                    <td>{{ $listado->cantidad }}</td>
                                                    <td>
                                                        @if($listado->link != "" || $listado->link != NULL )
                                                            {{ $listado->cotizador->cotizacion }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $listado->user->username }}</td>
                                                    <td>
                                                        @if($listado->estado == 1)
                                                            <h6 style="color:red;">Pendiente</h6>
                                                        @elseif($listado->estado == 4)
                                                            <h6 style="color:orange;">Retorno Completo</h6>
                                                        @elseif($listado->estado == 5)
                                                            <h6 style="color:orange;">Pendiente de Revisión</h6>
                                                        @elseif($listado->estado == 6)
                                                            <h6 style="color:orange;">Pendiente de Retorno</h6>
                                                        @elseif($listado->estado == 2)
                                                            <h6 style="color:orange;">En uso</h6>
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
                                                                <!-- <li><a class="dropdown-item" href="#">Visualizar</a></li>
                                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#despachoModal{{$listado->id}}">Despacho</a></li> -->
                                                                @if($listado->estado == 1)
                                                                    <li><a class="dropdown-item" href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#guiasModal{{$listado->id}}">Linkear</a>
                                                                    </li>
                                                                @endif
                                                                <li><a class="dropdown-item" href="#"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#ver_guia{{$listado->id}}">Visualizar</a>
                                                                </li>
                                                                @if($listado->link == "" || $listado->link == NULL)
                                                                    <li>
                                                                        <form method="POST"
                                                                              action="{{ url('estados_guia') }}">
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
                                                                              action="{{ url('estados_guia') }}">
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
                                                                              action="{{ url('estados_guia') }}">
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

                                                        </div>
                                                        <div class="modal fade" id="ver_guia{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="ver_guia"
                                                             aria-hidden="true">
                                                            <!-- <div class="modal-dialog"> -->
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Guia - {{$listado->guia}}</h5>
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
                                                                                        <th>Cantidad</th>
                                                                                        <!-- Agrega más columnas según tus necesidades -->
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @php
                                                                                        $subGuias = App\Models\SubGuias::where('id_guia', $listado->id)->get();
                                                                                    @endphp

                                                                                    @foreach ($subGuias as $subGuia)
                                                                                        <tr>
                                                                                            <td>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $subGuia->codigo }}</td>
                                                                                            <td>{{ $subGuia->descripcion }}</td>
                                                                                            <td>{{ $subGuia->cantidad }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cerrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="guiasModal{{$listado->id}}"
                                                             tabindex="-1" aria-labelledby="miModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Linkear Cotización</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" name="formArchivo"
                                                                              action="{{url('link_c_cotizacion')}}"
                                                                              id="formArchivo">
                                                                            @csrf
                                                                            <div class="col-12">
                                                                                <!-- Tercer campo de selección -->
                                                                                <div class="mb-3">
                                                                                    <!-- <select class="form-select" name="guia"  id="guia" required> -->

                                                                                    <input type="hidden" class="guias"
                                                                                           name="guias"
                                                                                           value="{{$listado->id}}">

                                                                                    <select
                                                                                        class="form-select id_cotizacion"
                                                                                        name="id_cotizacion"
                                                                                        id="id_cotizacion"
                                                                                        data-choices="data-choices"
                                                                                        data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                        required>
                                                                                        <option value="0" selected>
                                                                                            Seleccionar
                                                                                        </option>
                                                                                        @foreach ($lista_cotizacion_filtro as $cotizacion_l)
                                                                                            <option
                                                                                                value="{{ $cotizacion_l->id }}">{{ $cotizacion_l->cotizacion }}
                                                                                                - {{ $cotizacion_l->proyecto->proyecto }}</option>
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
                                                                                        class="btn btn-primary">Linkear
                                                                                </button>
                                                                            </div>
                                                                        </form>
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
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>--}}
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
<!-- <script>
    $(document).ready(function() {
        // Función para habilitar o deshabilitar el campo de entrada de archivos
        function toggleFileInput() {
            var proyectoSeleccionado = $('#correlativo').val() != '0';
            var clienteSeleccionado = $('#motivo').val() != '0';

            // Si ambos selectores tienen un valor seleccionado, habilitar el campo de entrada de archivos
            if (proyectoSeleccionado && clienteSeleccionado) {
                $('#archivo').prop('disabled', false);
            } else {
                // De lo contrario, deshabilitarlo
                $('#archivo').prop('disabled', true);
            }
        }

        // Llamar a la función toggleFileInput al cambiar la selección en cualquiera de los selectores
        $('#select2, #select3').change(function() {
            toggleFileInput();
        });

        // Llamar a la función al cargar la página para asegurarse de que el estado inicial del campo de entrada de archivos sea correcto
        toggleFileInput();
    });
</script> -->

<script>
    $(document).ready(function () {
        // Función para habilitar o deshabilitar el campo de entrada de archivos
        function toggleFileInput() {
            var proyectoMotivo = $('#select2').val() != '0';

            // Si ambos selectores tienen un valor seleccionado, habilitar el campo de entrada de archivos
            if (proyectoMotivo) {
                console.log("fales");
                $('#archivo').prop('disabled', false);
            } else {
                console.log("true");
                // De lo contrario, deshabilitarlo
                $('#archivo').prop('disabled', true);
            }
        }

        // Llamar a la función toggleFileInput al cambiar la selección en cualquiera de los selectores
        $('#select2').change(function () {
            toggleFileInput();
        });

        // Llamar a la función al cargar la página para asegurarse de que el estado inicial del campo de entrada de archivos sea correcto
    });
</script>
<script>
    document.getElementById('archivo').addEventListener('change', function () {
        var archivo = this.files[0];
        var lector = new FileReader();

        lector.onload = function (evento) {
            var contenido = evento.target.result;
            var preElement = document.createElement('pre');
            preElement.style.height = '500px'; // Cambia el valor de 500px al ancho deseado
            preElement.innerHTML = contenido;
            document.getElementById('vistaPrevia').innerHTML = '';
            document.getElementById('vistaPrevia').appendChild(preElement);

            // Cambiar el texto y el color del botón
            document.getElementById('btnEnviar').innerText = 'Guardar';
            document.getElementById('btnEnviar').classList.remove('btn-primary');
            document.getElementById('btnEnviar').classList.add('btn-success');
        }
        lector.readAsText(archivo);
    });

</script>
<script>
    $(function () {
        $(".archivo").on("change", function () {
            if ($(this).val() !== '') {
                var url = "/cargar_html_guias";
                var data = new FormData(document.getElementById("formArchivo"));
                $(".gif").show(); // Mostrar el gif de carga
                $.ajax({
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    dataType: 'html',
                    enctype: 'multipart/form-data',
                    url: url,
                    success: function (response) {
                        console.log(response);
                        // Parsear la respuesta JSON
                        var responseData = JSON.parse(response);
                        console.log("por entrar");
                        // Eliminar los datos previos de la tabla
                        $('#inputs-container').empty();
                        // $('#table-title').empty();

                        // Verificar si las variables están presentes en la respuesta
                        if (responseData.hasOwnProperty('variable1') && responseData.hasOwnProperty('variable2') && responseData.hasOwnProperty('variable3')) {
                            var variable3Parte = responseData.variable3;

                            // Crear el título de la tabla con la parte deseada de variable3
                            var tableTitle = $('<h5>').text("GUIAS: " + variable3Parte).addClass('text-center mt-4'); // Clases de Bootstrap para centrar y agregar margen arriba
                            $('#inputs-container').append(tableTitle);
                            console.log("esponseData.variable3", variable3Parte);

                            var consolidatedData = consolidateData(responseData.variable1, responseData.variable2, responseData.variable4);

                            var tabla = $('<table>').addClass('table mt-4 my-table'); // Agregar margen arriba a la tabla
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
                        } else {
                            console.log('Las variables no están presentes en la respuesta JSON.');
                        }

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

                        // Actualizar la imagen de acuerdo a la respuesta
                        $(".card-img-top").attr("src", responseData.imageSrc);
                        // Mostrar mensaje de éxito
                        $('#ajax-alert').addClass('alert-info').show(function () {
                            $(this).html("Cargado Correctamente");
                        });
                        // Ocultar el gif de carga después de un tiempo
                        $(".gif").hide();
                        // Ocultar el mensaje después de cierto tiempo
                        $(".alerta").fadeTo(2000, 500).slideUp(500, function () {
                            $(".alerta").slideUp(10000);
                        });
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
</script>
<script>
    $('.btnEnviare').click(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var variableMotivo = null;
        var variable1Values = [];
        var variable2Values = [];
        var variable4Values = [];
        var variable5Values = [];

        var variableMotivo = $('#select2').val() != '0';
        var archivoSeleccionado = $('#archivo').val() != '';

        if (variableMotivo && archivoSeleccionado) {
            variableMotivo = $('#select2').val();

            var tableTitle = $('#inputs-container').find('h5').text().trim();
            var regex = /T001-.*/;
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
            console.log('motivo:', variableMotivo);
            $.ajax({
                method: 'POST',
                url: 'cargar_html_post_g',
                data: {
                    codigo: variable1Values,
                    desripcion: variable4Values,
                    cantidad: variable2Values,
                    titulo: variable5Values,
                    variableMotivo: variableMotivo,
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
                    $(".gif").hide(); // Ocultar el gif de carga en caso de error
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

</body>
</html>
