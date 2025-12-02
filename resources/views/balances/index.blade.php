<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
@include('layouts.tableStyle')
    <body>
        <main class="main" id="top">
            @include('layouts.menu')
            <div class="content">
            <section class="pt-1 pb-9">
                    <div class="row align-items-center justify-content-between g-3 mb-4">
                        <div class="col-auto">
                        <h2 class="mb-0">Balances</h2>
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
                                        <div class="col-12 col-sm-auto ">
                                            <button class="btn-xs btn btn-default" style="background-color:#2ba708;color:#fff" data-bs-toggle="modal" data-bs-target="#importModal">Crear</button>

                                        </div>
                                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Importar Excel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('import_balances') }}" id="cliente" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="excelFile" class="form-label">Seleccionar archivo Excel</label>
                                                                <input class="form-control" type="file" name="excelFile" id="excelFile" required>
                                                            </div>
                                                            <div class="loader"></div><br>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Subir</button>
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

                                                    <th>Fecha</th>
                                                    <th>Resp. Inv</th>
                                                    <th>Resp. Saldo</th>
                                                    <th>Val. Total</th>
                                                    <th>Val. Dis</th>
                                                    <th>Val. Recup</th>
                                                    <th>Val. Destruc</th>
                                                    <th>Val. Dif</th>
                                                    <th>Estado</th>
                                                    <th>Verificado Por</th>
                                                    <th>Acciones</th>
                                                    <th style="display:none;">Filtro</th>
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lista as $listado)
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->fecha }}</td>
                                                    <td title="{{ $listado->responsable_saldo }}">
                                                        {{ str_limit_custom($listado->responsable_saldo, 12, '...') }}
{{--                                                        <?php--}}
{{--                                                        // Obtener todos los valores de usuario_conteo para este id_balance--}}
{{--                                                        $usuarios_conteo = DB::table('sub_balances')--}}
{{--                                                                            ->where('id_balance', $listado->id)--}}
{{--                                                                            ->pluck('usuario_conteo')--}}
{{--                                                                            ->toArray();--}}

{{--                                                        // Eliminar registros duplicados (si es necesario)--}}
{{--                                                        $usuarios_conteo = array_unique($usuarios_conteo);--}}

{{--                                                        // Obtener los dos primeros registros directamente--}}
{{--                                                        $firstTwoUsers = array_slice($usuarios_conteo, 0, 2);--}}

{{--                                                        // Obtener el resto de los registros (después de los dos primeros)--}}
{{--                                                        $remainingUsers = array_slice($usuarios_conteo, 2);--}}

{{--                                                        // Mostrar los dos primeros registros directamente separados por coma--}}
{{--                                                        echo implode(',', $firstTwoUsers);--}}

{{--                                                        // Mostrar el resto de los registros en un atributo title (tooltip)--}}
{{--                                                        if (!empty($remainingUsers)) {--}}
{{--                                                            echo '<span title="' . implode(', ', $remainingUsers) . '">...</span>';--}}
{{--                                                        }--}}
{{--                                                        ?>--}}
                                                    </td>
                                                    <td>{{ $listado->user->username }}</td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        <?php
                                                            // Obtener la sumatoria de precio de SubBalances para este id_balance
                                                            $valorTotal = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio');

                                                            // Formatear el resultado como moneda ($84.00)
                                                            echo '$' . number_format($valorTotal, 2); // 2 decimales
                                                        ?>
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        <?php
                                                            // Obtener la sumatoria de precio de SubBalances para este id_balance
                                                            $valorTotal_1 = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio');
                                                            $valorTotal_2 = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio_2');
                                                            $valorTotal_3 = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio_3');

                                                            // Realizar cálculos
                                                            $resultado = $valorTotal_1 - $valorTotal_2 - $valorTotal_3;

                                                            // Formatear el resultado como moneda ($84.00)
                                                            echo '$' . number_format($resultado, 2); // 2 decimales
                                                        ?>
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        <?php
                                                            // Obtener la sumatoria de precio_2 de SubBalances para este id_balance
                                                            $valorTotal = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio_2');

                                                            // Formatear el resultado como moneda ($84.00)
                                                            echo '$' . number_format($valorTotal, 2); // 2 decimales
                                                        ?>
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        <?php
                                                            // Obtener la sumatoria de precio_3 de SubBalances para este id_balance
                                                            $valorTotal = DB::table('sub_balances')
                                                                            ->where('id_balance', $listado->id)
                                                                            ->sum('precio_3');

                                                            // Formatear el resultado como moneda ($84.00)
                                                            echo '$' . number_format($valorTotal, 2); // 2 decimales
                                                        ?>
                                                    </td>
                                                    <?php
                                                        // Obtener la sumatoria de valorizado de SubBalances para este id_balance
                                                        $valorTotal = DB::table('sub_balances')
                                                                        ->where('id_balance', $listado->id)
                                                                        ->sum('valorizado');

                                                        // Mostrar el valor de $valorTotal (para depuración)
                                                        // echo "Valor total: " . $valorTotal . "<br>";

                                                        // Aplicar estilo al <td> según el valor de $valorTotal
                                                        ?>
                                                        <td style="text-align: right; padding-right: 35px;
                                                            <?php echo ($valorTotal >= 0) ? 'color: blue;' : 'color: red;'; ?>
                                                        ">
                                                            <?php
                                                            // Formatear el resultado como moneda ($84.00)
                                                            echo '$' . number_format($valorTotal, 2); // 2 decimales
                                                            ?>
                                                        </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        @if($listado->estado == 1)
                                                        <h6 style="color:red;">Abierto</h6>
                                                        @elseif($listado->estado == 2)
                                                        <h6 style="color:blue;">Cerrado</h6>
                                                        @endif
                                                    </td>
                                                    <td  style="text-align: right; padding-right: 35px;">
                                                        @if($listado->verificador == NULL)
                                                            -
                                                        @else
                                                        {{$listado->user_verificador->username}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <!-- @if ($listado->fecha == \Carbon\Carbon::today()->toDateString())
                                                                <li>
                                                                    <form action="{{ url('actualizar_sub_balance') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="fecha" value="{{ $listado->fecha }}">
                                                                        <button type="submit" class="dropdown-item">Actualizar</button>
                                                                    </form>
                                                                </li>
                                                                @endif -->
                                                                <li><a class="dropdown-item" href="{{ url('sub_balances_view/' . $listado->id) }}">Visualizar</a></li>
                                                                <li>
                                                                    <form action="{{ url('verificar_balance/' . $listado->id) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">Verificar</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ url('cerrar_balance/' . $listado->id) }}" method="POST">
                                                                        @csrf
                                                                        <!-- Input oculto para enviar la fecha -->
                                                                        <button type="submit" class="dropdown-item">Cerrar</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </td>
                                                    <td style="display:none;">
                                                        @if($listado->validacion_dif == 0)
                                                        <h6> == 0</h6>
                                                        @elseif($listado->validacion_dif > 0)
                                                        <h6> > 0</h6>
                                                        @elseif($listado->validacion_dif < 0)
                                                        <h6> < 0</h6>
                                                        @endif
                                                    </td>
                                                                                                        <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div><br>
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
{{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>--}}
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

    </body>
</html>
