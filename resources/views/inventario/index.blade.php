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
                    <h2 class="mb-0">Inventario
                        <a target="_blank" href="https://app.powerbi.com/view?r=eyJrIjoiZTEwMTZlMmMtMTJlMi00YTc4LTk3NGUtZGQ4MWFiOTM2ZDUzIiwidCI6IjUwYjViYWQ5LWVhMzQtNGZiMC04YjRlLWJiMjczNjQ0OTM5YSIsImMiOjR9">
                            <button class="btn-xs btn btn-default"
                                    style="background-color:#01aef0;color:#fff" data-bs-toggle="modal">
                                Reporte Power BI
                            </button>
                        </a>
                    </h2>
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
                                        <div class="table-responsive table-container">
                                            <!-- <div class="col-12 col-sm-auto">
                                                <button class="btn-xs btn btn-default" style="background-color:#01aef0;color:#fff" data-bs-toggle="modal" data-bs-target="#miModal">Importar Archivo</button>
                                            </div><br> -->

                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Cod.Art</th>
                                                    <th>Artículo</th>
                                                    <th>Total</th>
                                                    <th>Recuperable</th>
                                                    <th>Destrucción</th>
                                                    <!--<th>Préstamos</th>-->
                                                    <!--<th>Cambios</th>-->
                                                    <th>Reservado</th>
                                                    <!--<th>Disponible</th>-->
                                                    <th>Ubicacíon</th>
                                                    <th>Usuario</th>
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                                </thead>
                                                <style>
                                                    .right-align {
                                                        text-align: right; /* Alinear texto a la derecha */
                                                    }
                                                </style>
                                                <tbody>
                                                @foreach ($grupos as $grupo)
                                                    <tr>
                                                        <td>{{ $grupo['codigo'] }}</td>
                                                        <td title="{{ $grupo['descripcion'] }}">
                                                            @if(strlen($grupo['descripcion']) > 18)
                                                                {{ substr($grupo['descripcion'], 0, 20) . '...' }}
                                                            @else
                                                                {{ $grupo['descripcion'] }}
                                                            @endif
                                                        </td>
                                                        <td class="right-align">
                                                            @if ($grupo['cantidad'] != 0)
                                                                {{$grupo['cantidad'] }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="right-align">
                                                            @if (number_format($grupo['estado_2']) != 0)
                                                                {{ number_format($grupo['estado_2']) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="right-align">
                                                            @if (number_format($grupo['estado_3'] ) != 0)
                                                                {{ number_format($grupo['estado_3'] ) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <!--<td class="right-align">-->
                                                        <!--    @if (number_format($grupo['prestamo'] ) != 0)-->
                                                        <!--        {{ number_format($grupo['prestamo'] ) }}-->
                                                        <!--    @else-->
                                                        <!--        --->
                                                        <!--    @endif-->

                                                        <!--</td>-->
                                                        <!--<td class="right-align">-->
                                                        <!--    @if (number_format($grupo['cambios'] ) != 0)-->
                                                        <!--        {{ number_format($grupo['cambios'] ) }}-->
                                                        <!--    @else-->
                                                        <!--        --->
                                                        <!--    @endif-->
                                                        <!--</td>-->
                                                        <td class="right-align">
                                                            @if (number_format($grupo['cotizacion'] ) != 0)
                                                                {{ number_format($grupo['cotizacion'] ) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>

                                                        <td title="{{ $grupo['ubicacion'] }}">{{ \Illuminate\Support\Str::limit($grupo['ubicacion'], 15) }}</td>
                                                        <td title="{{ $grupo['usuario'] }}">{{ \Illuminate\Support\Str::limit($grupo['usuario'], 15) }}</td>
                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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

</body>
</html>
