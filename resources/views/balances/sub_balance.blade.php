<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<style>
    .text-rojo {
    color: red;
    }

    .text-azul {
        color: blue;
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
                        <h2 class="mb-0">Balance - {{$codigo_d->fecha}}</h2><br>
                        <!-- <h5 class="mb-0">Cotización N° {{$codigo_d->cotizacion}}</h5> -->
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
                                        <div  class="table-responsive">
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                        <div>
                                            <button class="btn-xs btn btn-default" style="background-color:#2ba708;color:#fff; display: inline-block;" data-bs-toggle="modal" data-bs-target="#importModal">Quitar registros nulos</button>

                                            <form id="formAnular" action="{{ url('actualizar_balances_3') }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <input class="form-control" type="hidden" name="id_balance" id="id_balance" value="{{$codigo_d->id}}" required>

                                                <button class="btn-xs btn btn-default" type="submit" style="background-color:#2ba708;color:#fff; display: inline-block;">Actualizar conteos</button>
                                            </form>

                                            <button class="btn-xs btn btn-default" style="background-color:#ed1c3e;color:#fff; display: inline-block;" data-bs-toggle="modal" data-bs-target="#importModal_log">Log</button>

                                        </div>
                                        <br>
                                        <div class="modal fade" id="importModal_log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Materiales no registrados</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="mb-3">
                                                            <table id="users-table-nulo" class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>#</th> -->
                                                                        <th>Cod.Articulo</th>
                                                                        <!-- <th>Articulo</th> -->
                                                                        <!-- <th style="display:none;">Filtro</th> -->

                                                                        <!-- Agrega más columnas según tus necesidades -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($lista_nulos->groupBy('codigo') as $codigo => $items)
                                                                    <tr>
                                                                        <td colspan="2"><strong>{{ $codigo }}</strong></td>
                                                                    </tr>

                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Quitar registros nulos</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('balances_cero') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="excelFile">¿Se eliminarán los registros que tienen cantidad 0, se recomienda realizar este procedimiento al finalizar el cuadre?</label>
                                                                <input class="form-control" type="hidden" name="id_balance" id="id_balance" value="{{$codigo_d->id}}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                            <!-- <button type="submit" class="btn btn-primary">Importar</button> -->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cod.Articulo</th>
                                                    <th>Articulo</th>
                                                    <th>Stock Sistema</th>
                                                    <th>Conteo físico</th>
                                                    <th>Diferencia</th>
                                                    <th>Valorizado</th>
                                                    <th>Usuario Conteo</th>
                                                    <th>Ubicación</th>
                                                    <th style="display:none;">Filtro</th>

                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <style>
                                                    .right-align {
                                                        text-align: right; /* Alinear texto a la derecha */
                                                    }
                                                </style>
                                                @foreach ($lista as $listado)
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->id }}</td>
                                                    <td>
                                                         {{ $listado->codigo }}
                                                    </td>
                                                    <td title="{{$listado->descripcion_pro}}">{{ \Illuminate\Support\Str::limit($listado->descripcion_pro, 30) }}</td>

                                                    <td style="text-align: right; padding-right: 35px;">
                                                        @if ($listado->stock_fisico == NULL||$listado->stock_fisico == 0)
                                                            -
                                                        @else
                                                        {{ $listado->stock_fisico }}
                                                        @endif
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        @if ($listado->conteo == NULL||$listado->conteo == 0)
                                                            -
                                                        @else
                                                        {{ $listado->conteo }}
                                                        @endif
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">  @if ($listado->diferencia == 0)
                                                            -
                                                        @else
                                                            @php
                                                                $resultado = $listado->diferencia;
                                                                $clase_color = ($resultado < 0) ? 'text-rojo' : 'text-azul';
                                                            @endphp
                                                            <span class="{{ $clase_color }}">
                                                                @if ($resultado < 0)
                                                                    -{{ abs($resultado) }}
                                                                @else
                                                                    {{ $resultado }}
                                                                @endif
                                                            </span>
                                                        @endif</td>

                                                    <td  style="text-align: right; padding-right: 35px;">
                                                    @if ($listado->materiales === null || $listado->materiales->costo_unitario == 0)
                                                        -
                                                    @else
                                                        @php
                                                            // Convertir costo_unitario a un número utilizando la función floatval()
                                                            $costo_unitario = floatval($listado->materiales->costo_unitario);

//                                                            $resultado = abs($listado->valorizado);
//                                                            $resultado_formateado = number_format(abs($resultado), 2); // Formatear el resultado con 2 decimales
//                                                            $resultado_con_moneda = ($resultado > 0) ? "-$ $resultado_formateado" : "$ $resultado_formateado";
//                                                            $clase_color = ($resultado > 0) ? 'text-rojo' : 'text-azul';
                                                            $resultado = $listado->diferencia*$costo_unitario;
                                                            $resultado_formateado = number_format($resultado, 2); // Formatear el resultado con 2 decimales
                                                            $resultado_con_moneda = ($resultado < 0) ? "-$ $resultado_formateado" : "$ $resultado_formateado";
                                                            $clase_color = ($resultado < 0) ? 'text-rojo' : 'text-azul';
                                                        @endphp
                                                        <span class="{{ $clase_color }}">
                                                            {{ $resultado_con_moneda }}
                                                        </span>
                                                    @endif

                                                    </td>

                                                    <td title="{{$listado->usuario_conteo}}">{{ str_limit_custom($listado->usuario_conteo, 12, '...') }}</td>
                                                    <td title="{{$listado->ubicacion  }}">{{ str_limit_custom($listado->ubicacion, 12, '...') }}</td>
                                                    <td style="display:none;">
                                                        @if($listado->stock_fisico !== '' && $listado->stock_fisico !== null &&
                                                            $listado->conteo !== '' && $listado->conteo !== null &&
                                                            $listado->diferencia !== '' && $listado->diferencia !== null &&
                                                            $listado->valorizado !== '' && $listado->valorizado !== null)
                                                            no nulos
                                                        @endif
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
        <script>
            $(document).ready(function() {
                $('#users-table').DataTable({
                    "paging": true,  // Activar paginación
                    "pageLength": 10,  // Número de registros por página inicial
                    "lengthMenu": [10, 20, 50, 100],  // Opciones de cantidad de registros por página
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",  // Texto para la cantidad de registros por página
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando página _PAGE_ de _PAGES_",  // Información de la paginación
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' + // Mover lengthMenu y search a una fila separada
                        '<"row"<"col-sm-12"B>>' + // Botones en una fila separada
                        '<"row"<"col-sm-12"t>>' + // Tabla en una fila separada
                        '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    "pagingType": "simple_numbers",
                    "order": [
                        [2, 'desc']
                    ],
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
                });
            });
        </script>
        <script>
            $('#users-table-nulo').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "",
                        "previous": ""
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "pagingType": "simple_numbers",
                "searching": false, // Deshabilitar la función de búsqueda
            });
        </script>
        <!-- <script>
            $('.modal').on('shown.bs.modal', function () {


            $('#despacho-table').DataTable({
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
                // "language": {
                //     "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                // },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "pagingType": "simple_numbers",
                // "lengthChange": false,
                // "pageLength": 5,
                // "info": true
            });
        });
        </script> -->



    </body>
</html>
