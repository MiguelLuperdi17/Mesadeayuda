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
                        <h2 class="mb-0">Ubicaciones</h2>
                        </div>
                    </div>
                    @include('layouts.alerta')

                    <div class="row g-3 mb-6">
                        <div class="col-12 col-lg-12">
                            <div class="card h-100">
                                <div class="card-body">
                                <div class="border-bottom border-dashed border-300 pb-4">
                                    <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                        <div  class="table-responsive">
                                            <div class="col-12 col-sm-auto flex-1">
                                            <!-- Botón para abrir el modal -->
                                            <div class="col-12 col-sm-auto">
                                                <button class="btn-xs btn btn-default"style="background-color:#01aef0;color:#fff"  data-bs-toggle="modal" data-bs-target="#ubicacionModal">Crear</button>
                                            </div>
                                            <div class="modal fade" id="ubicacionModal" tabindex="-1" role="dialog" aria-labelledby="ubicacionModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ubicacionModalLabel">Ingresar Ubicaciones</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="ubicacionForm" method="POST" action="{{ url('guardar_ubicacion') }}" >
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- Formulario con los inputs -->
                                                                <div class="form-group">
                                                                    <label for="ubicacion1">Ubicación 1:</label>
                                                                    <input type="text" class="form-control" id="ubicacion1" placeholder="Pallet o estante" name="ubicacion1" required>
                                                                </div><br>
                                                                <div class="form-group">
                                                                    <label for="ubicacion2">Ubicación 2:</label>
                                                                    <input type="text" class="form-control" id="ubicacion2" placeholder="Zona" name="ubicacion2" required>
                                                                </div><br>
                                                                <div class="form-group">
                                                                    <label for="ubicacion3">Ubicación 3:</label>
                                                                    <input type="text" class="form-control" id="ubicacion3" placeholder="Almacén"name="ubicacion3" required>
                                                                </div><br>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary" >Guardar</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <br> 
                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Ubi 1 (Pallet o estante)</th>
                                                        <th>Ubi 2 (Zona)</th>
                                                        <th>Ubi 3 (Álmacen)</th>
                                                        <th>Estado</th>
                                                        <th>Acción</th>
                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lista as $listado)
                                                    <tr>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->ubicacion_1 }}</td>
                                                        <td>{{ $listado->ubicacion_2 }}</td>
                                                        <td>{{ $listado->ubicacion_3 }}</td>
                                                        <td> 
                                                            @if($listado->estado == 1)
                                                            <h6 style="color:green;">Activo</h6>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <i class="fas fa-cog dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editarModal{{$listado->id}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal{{$listado->id}}">Eliminar</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal fade" id="editarModal{{$listado->id}}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{$listado->id}}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="editarModalLabel{{$listado->id}}">Editar</h5>
                                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="{{ url('editar_ubicaciones/' . $listado->id) }}" enctype="multipart/form-data"  >
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <!-- Aquí colocas el formulario de edición -->
                                                                            <div class="form-group">
                                                                                <label for="ubicacion1">Ubicación 1:</label>
                                                                                <input type="text" class="form-control" id="ubicacion1" value="{{$listado->ubicacion_1}}" placeholder="Pallet o estante" name="ubicacion_1" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="ubicacion2">Ubicación 2:</label>
                                                                                <input type="text" class="form-control" id="ubicacion2" value="{{$listado->ubicacion_2}}" placeholder="Zona" name="ubicacion_2" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="ubicacion3">Ubicación 3:</label>
                                                                                <input type="text" class="form-control" id="ubicacion3" value="{{$listado->ubicacion_3}}"placeholder="Almacén" name="ubicacion_3" required>
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
                                                            

                                                            <!-- Modal de Eliminar -->
                                                            <div class="modal fade" id="eliminarModal{{$listado->id}}" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel{{$listado->id}}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="eliminarModalLabel{{$listado->id}}">Eliminar</h5>
                                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        
                                                                        <div class="modal-body">
                                                                            ¿Estás seguro de que deseas eliminar este elemento?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                            <form method="POST" action="{{ url('eliminar_ubicaciones/' . $listado->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
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
        </script>

    </body>
</html>
