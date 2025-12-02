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
                    <!-- <div class="row align-items-center justify-content-between g-3 mb-4">
                        <div class="col-auto">
                        <h2 class="mb-0">Proyectos</h2>
                        </div>
                    </div> -->
                    @include('layouts.alerta')

                    <div class="col-12 col-lg-12">
                            <div class="card h-100">
                                <div class="card-body">
                                <div class="border-bottom border-dashed border-300 pb-4">
                                    <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                    <div  class="table-responsive">
                                        <div class="col-12 col-sm-auto flex-1">

                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <h2 class="mb-0">Proyectos</h2>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn-xs btn btn-default" style="background-color:#01aef0;color:#fff" data-bs-toggle="modal" data-bs-target="#miModalP">Crear</button>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="miModalP" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Crear Proyecto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" id="cliente"  action="{{url('cargar_proyecto')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label>Cliente</label>

                                                                        <select class="form-select" name="id_cliente" id="id_cliente" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}' required>
                                                                            <option selected disabled></option>
                                                                            @foreach ($lista as $clientes_l)
                                                                                <option value="{{ $clientes_l->id }}">{{ $clientes_l->razon_social }}</option>
                                                                                <!-- Asegúrate de cambiar 'nombre' por el nombre del campo que contiene el nombre del cliente -->
                                                                            @endforeach
                                                                        </select>


                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Proyecto</label>
                                                                        <textarea class="form-control" name="proyecto" id="proyecto" placeholder="Nombre del Proyecto" required></textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Dirección</label>
                                                                        <textarea class="form-control" name="direccion" id="direccion" placeholder="Dirección" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="loader"></div><br>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <table id="users-table-two" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Proyecto</th>
                                                    <th>Dirección</th>
                                                    <!--<th ></th>-->
                                                    <!--<th ></th>-->
                                                    <!--<th ></th>-->
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lista_proyecto as $proyectos_l)
                                                <tr>
                                                    <td  title="{{ $proyectos_l->client->razon_social }}">&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{ $proyectos_l->client->razon_social }}</td>
                                                    <td title="{{ $proyectos_l->proyecto }}">
                                                        @if(strlen($proyectos_l->proyecto) > 20)
                                                            {{ substr($proyectos_l->proyecto, 0, 20) . '...' }}
                                                        @else
                                                            {{ $proyectos_l->proyecto }}
                                                        @endif
                                                    </td>
                                                    <td title="{{$proyectos_l->direccion}}">
                                                    {{ \Illuminate\Support\Str::limit($proyectos_l->direccion, 20, $end='...') }}
                                                    </td>
                                                    <!-- <td>{{ strtolower($proyectos_l->client->razon_social) }}</td>-->
                                                    <!--<td >{{ strtolower($proyectos_l->proyecto) }}</td>-->
                                                    <!--<td >{{ strtolower($proyectos_l->direccion) }}</td>-->
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#editar_proyecto{{$proyectos_l->id}}">Editar</a></li>
                                                                <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#eliminarModalP{{$proyectos_l->id}}">Eliminar</a></li>
                                                                <!-- <li><a class="dropdown-item" href="#">Eliminar</a></li> -->
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <div class="modal fade" id="editar_proyecto{{$proyectos_l->id}}" tabindex="-1" aria-labelledby="editar_proyecto{{$proyectos_l->id}}Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editar_proyecto{{$proyectos_l->id}}Label">Editar Proyecto</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Aquí puedes colocar los campos de edición -->
                                                                    <!-- Por ejemplo, puedes reutilizar el formulario de creación y precargar los datos del cliente -->
                                                                    <form method="POST" action="{{ url('editar_proyecto/' . $proyectos_l->id) }}" enctype="multipart/form-data"  >
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <select name="id_cliente" id="id_cliente" class="form-control" required disabled>
                                                                                @foreach ($lista as $clientes_l)
                                                                                    <option value="{{ $clientes_l->id }}" @if ($proyectos_l->id_cliente == $clientes_l->id) selected @endif>
                                                                                        {{ $clientes_l->razon_social }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Proyecto</label>
                                                                            <textarea class="form-control" name="proyecto" id="proyecto" placeholder="Nombre del Proyecto" required>{{ $proyectos_l->proyecto }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Dirección</label>
                                                                            <textarea class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>{{ $proyectos_l->direccion }}</textarea>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="eliminarModalP{{$proyectos_l->id}}" tabindex="-1" aria-labelledby="eliminarModalP{{$proyectos_l->id}}Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="eliminarModalP{{$proyectos_l->id}}Label">Eliminar Cliente</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Aquí puedes mostrar un mensaje de confirmación de eliminación -->
                                                                    <p>¿Desea eliminar el proyecto seleccionado?.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="POST" action="{{ url('eliminar_proyecto/' . $proyectos_l->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div><br>
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
               $('#users-table-two').DataTable({
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
        <script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>

    </body>
</html>
