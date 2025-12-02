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
                        <h2 class="mb-0">Roles</h2>
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
                                            <div class="col-12 col-sm-auto">
                                                <button class="btn-xs btn btn-default"style="background-color:#01aef0;color:#fff"  data-bs-toggle="modal" data-bs-target="#RolCModal">Crear</button>
                                            </div>
                                            <div class="modal fade" id="RolCModal" tabindex="-1" role="dialog" aria-labelledby="RolCModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="RolCModalLabel">Ingresar Rol</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="" method="POST" action="{{ url('roles_create') }}" >
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- Formulario con los inputs -->
                                                                <div class="form-group">
                                                                    <label for="ubicacion1">Rol:</label>
                                                                    <input type="text" class="form-control rol_descripcion" id="rol_descripcion" placeholder="Ingrese un Rol"  oninput="this.value = this.value.toUpperCase()" name="rol_descripcion" required>
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
                                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Rol</th>
                                                        <th>Estado</th>
                                                        
                                                        <th class="dt-no-sorting">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($roles as $rol)
                                                    <tr>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$rol->id}}</td>
                                                        <td>{{$rol->rol_descripcion}}</td>
                                                        <td>Activo</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <i class="fas fa-cog dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Procesamiento_editar{{$rol->id}}">Editar</a></li>
                                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Procesamiento_eliminar{{$rol->id}}">Eliminar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!--MODAL PARA EDITAR-->
                                                    
                                                    <div class="modal fade" id="Procesamiento_editar{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="Procesamiento_editar{{$rol->id}}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editarModalLabel{{$rol->id}}">Editar</h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="{{ route('roles.update', $rol->id) }}"enctype="multipart/form-data"  >
                                                                @csrf
                                                                {{ method_field('PUT') }}
                                                                <div class="modal-body">
                                                                    <!-- Aquí colocas el formulario de edición -->
                                                                    <div class="form-group">
                                                                        <label for="rol_descripcion">Rol:</label>
                                                                        <input type="text" class="form-control" id="rol_descripcion" value="{{$rol->rol_descripcion}}" placeholder="Pallet o estante" name="rol_descripcion" required>
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

                                                    <div class="modal fade" id="Procesamiento_eliminar{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="Procesamiento_eliminar{{$rol->id}}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="eliminarModalLabel{{$rol->id}}">Eliminar</h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="modal-body">
                                                                    ¿Estás seguro de que deseas eliminar este rol?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <form method="POST" action="{{ route('roles.update', $rol->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--MODAL PARA ELIMINAR-->
                                                    <!-- <div class="modal fade" id="Procesamiento_eliminar{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="Procesamiento_eliminar" aria-hidden="true">
                                                        <div class="modal-dialog modal-danger" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <center>
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" style="font-weight: bold;">¿Desea eliminar el rol {{$rol->rol_descripcion}}?</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{url('/roles/'.$rol->id) }}" method="post">
                                                                        @csrf
                                                                        {{ method_field('DELETE') }}
                                                                            <br>
                                                                            <input type="submit" class="btn btn-danger btn-sm"  value="Eliminar">
                                                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                                                                <i class="fa fa-times fa-2x"></i> Cerrar
                                                                            </button>
                                                                    </form>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
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
            $('#html5-extension').DataTable({
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
