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
                        <h2 class="mb-0">Cotizaciones - Despacho</h2><br>
                        <h5 class="mb-0">Cotización N° {{$codigo_d->cotizacion}}</h5>
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

                                        <br>
                                        <table id="users-table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Cod.Articulo</th>
                                                    <th>Articulo</th>
                                                    <th>Cantidad</th>
                                                    <th>Despachos</th>
                                                    <th>Saldo</th>
                                                    <th>Estado</th>
                                                    <th>Historial</th>

                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lista as $listado)
                                                <tr>
                                                    <td>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $listado->codigo }}
                                                    </td>
                                                    <td >{{ $listado->descripcion }}</td>
                                                    <td>{{ $listado->cantidad }}</td>
                                                    <td>{{ $listado->despachado }}</td>
                                                    <td>{{ $listado->cantidad - $listado->despachado }}</td>
                                                    <td>@if($listado->estado == 1)
                                                        <h6 style="color:red;">Pendiente</h6>
                                                        @elseif($listado->estado == 2)
                                                        <h6 style="color:green;">Finalizado</h6>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#historialModal{{$listado->id}}">Historial</a></li>
{{--                                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editarModal{{$listado->id}}">Editar</a></li>--}}
                                                            </ul>
                                                        </div>

                                                        <div class="modal fade" id="historialModal{{$listado->id}}" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl"> <!-- Cambiado de modal-dialog a modal-xl -->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Historial</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <table id="despacho-table" class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Fecha - Hora</th>
                                                                                <th>Guia</th>
                                                                                <th>Cantidad</th>
                                                                                <!-- <th>Resp.Alm</th> -->
                                                                                <th>Responsable Recepción</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($lista_historial as $historial)
                                                                            <tr>
                                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$historial->date_subida}}</td>
                                                                                <td>{{$historial->t_guia->guia}}
                                                                                    @if($historial->estado == 2)
                                                                                        Nota de ingreso
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{$historial->cantidad * -1}}</td>
                                                                                <!-- <td>{{$historial->cantidad}}</td> -->
                                                                                <td>{{$historial->users->username}}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="editarModal{{$listado->id}}" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xs"> <!-- Cambiado de modal-dialog a modal-xl -->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form  method="POST" name="formArchivo"  action="{{url('editar_cantidad')}}"  id="formArchivo" >
                                                                        @csrf
                                                                        <div class="col-12">
                                                                            <!-- Tercer campo de selección -->
                                                                            <div class="mb-3">
                                                                                <!-- <select class="form-select" name="guia"  id="guia" required> -->

                                                                                <input type="hidden" class="id_cotizacion" name="id_cotizacion" value="{{$codigo_d->id}}">

                                                                                <input type="hidden" class="sub_cotizacion" name="sub_cotizacion" value="{{$listado->id}}">
                                                                                <input type="hidden" name="despachado" value="{{$listado->despachado}}">
                                                                                <label>Ingresar Cantidad</label>
                                                                                <input type="number" class="form-control cantidad" placeholder="La nueva cantidad no debe ser inferior a la despachada" min="{{$listado->despachado}}" name="cantidad"  value="{{$listado->cantidad}}" required>


                                                                                @if($listado->despachado == 0 || $listado->despachado  == "" )
                                                                                <br>
                                                                                    <label>Ingresar Codigo</label>
                                                                                    <input type="text" class="form-control codigo" placeholder="El codigo ya no se podra ser editado cuando tenga un despacho" min="{{$listado->despachado}}" name="codigo"  value="{{$listado->codigo}}" required>
                                                                                @else
                                                                                    <input type="hidden" class="form-control" name="codigo" value="{{$listado->codigo}}">
                                                                                @endif

                                                                            </div>
                                                                        </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="submit" class="btn btn-primary">Guardar</button>
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
