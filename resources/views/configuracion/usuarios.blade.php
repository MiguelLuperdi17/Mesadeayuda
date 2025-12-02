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
                        <h2 class="mb-0">Usuarios</h2>
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
                                                <button class="btn-xs btn btn-default" style="background-color:#01aef0;color:#fff" data-bs-toggle="modal" data-bs-target="#usuarioModal">Crear</button>
                                            </div>
                                            <br>
                                            <div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="usuarioModalLabel">Registrar Usuario</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="usuarioForm" method="POST" action="{{ url('guardar_usuario') }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <!-- Nombres -->
                                                                        <div class="form-group">
                                                                            <label for="nombre">Nombres:</label>
                                                                            <input type="text" class="form-control" id="name" placeholder="Ingrese el nombre" name="name" required>
                                                                        </div><br>
                                                                        <!-- Apellidos -->
                                                                        <div class="form-group">
                                                                            <label for="apellidos">Correo:</label>
                                                                            <input type="email" class="form-control" id="email" placeholder="Ingrese su correo" name="email" required>
                                                                        </div><br>
                                                                        <!-- Sede -->
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label for="sede">Sede:</label>--}}
{{--                                                                            <select class="form-control" id="sede" name="id_sede" required>--}}
{{--                                                                                <option value="1">Lima</option>--}}
{{--                                                                                <!-- Agrega más opciones según necesites -->--}}
{{--                                                                            </select>--}}
{{--                                                                        </div><br>--}}
                                                                        <div class="form-group">
                                                                            <label for="apellidos">Celular:</label>
                                                                            <input type="number" class="form-control" id="movil" placeholder="Ingrese su celular" name="movil" required>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label for="apellidos">Usuario:</label>
                                                                            <input type="text" class="form-control" id="username" placeholder="Ingrese su usuario" name="username" required autocomplete="new-password" oninput="this.value = this.value.toUpperCase()">
                                                                        </div><br>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <!-- Apellidos -->
                                                                        <div class="form-group">
                                                                            <label for="apellidos">Apellidos:</label>
                                                                            <input type="text" class="form-control" id="surnames" placeholder="Ingrese los apellidos" name="surnames" required>
                                                                        </div><br>
                                                                        <!-- Tipo de usuario -->
                                                                        <div class="form-group">
                                                                            <label for="tipo">Tipo de usuario:</label>
                                                                            <select class="form-control" id="rol_id" name="rol_id" required>
                                                                                <option disabled selected>Seleccionar</option>
                                                                                <option value="1">Administrador</option>
                                                                                <option value="2">Usuario</option>
                                                                                <option value="3">Analista</option>
                                                                                <option value="4">Aprobador</option>
                                                                                <option value="5">Jefe de Sistemas</option>
                                                                                <option value="6">Proveedor</option>
                                                                            </select>
                                                                        </div><br>
                                                                        <div class="form-group">
                                                                            <label for="apellidos">Contraseña: <spam style="font-size:12px;">(Min 8 caracteres)</spam></label>
                                                                            <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" name="password" required minlength="8" autocomplete="new-password">
                                                                        </div><br>
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
                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>

                                                        <th>Usuario</th>
                                                        <th>Nombre</th>
                                                        <th>Correo</th>
{{--                                                        <th>Sede</th>--}}
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        <th>Acción</th>
                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lista as $listado)
                                                    <tr>
                                                        <!-- <td>{{ $listado->id }}</td> -->
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $listado->username }}</td>
                                                        <td>{{ $listado->name }} {{ $listado->surnames }}</td>
                                                        <td>{{ $listado->email }}</td>
                                                        <td>  @if($listado->rol_id == 1)
                                                                Administrador
                                                            @elseif($listado->rol_id == 2)
                                                                Usuario
                                                            @elseif($listado->rol_id == 3)
                                                                Analista
                                                            @elseif($listado->rol_id == 4)
                                                                Aprobador
                                                            @elseif($listado->rol_id == 5)
                                                                Jefe de Sistemas
                                                            @elseif($listado->rol_id == 6)
                                                                Proveedor
                                                            @endif</td>
                                                        <td>
                                                            <h6 style="color:green;">Activo</h6>

                                                        </td>
                                                        <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-cog dropdown-toggle"></i>
                                                            </button>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li><a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#Editar{{$listado->id}}">Editar</a></li>
                                                                @if(($listado->id) != 1)
                                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eliminarModal{{$listado->id}}">Eliminar</a></li>
                                                                @endif
                                                                <!-- <li><a class="dropdown-item" href="#">Eliminar</a></li> -->
                                                            </ul>
                                                        </div>
                                                        <div class="modal fade" id="Editar{{$listado->id}}" tabindex="-1" role="dialog" aria-labelledby="EditarLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="EditarLabel">Editar Usuario</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="usuarioForm" method="POST" action="{{ url('editar_usuario/' . $listado->id) }}">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <!-- Nombres -->
                                                                                    <div class="form-group">
                                                                                        <label for="nombre">Nombres:</label>
                                                                                        <input type="text" class="form-control" id="name" value="{{$listado->name}}" placeholder="Ingrese el nombre" name="name" required>
                                                                                    </div><br>
                                                                                    <!-- Apellidos -->
                                                                                    <div class="form-group">
                                                                                        <label for="apellidos">Correo:</label>
                                                                                        <input type="email" class="form-control" id="email" value="{{$listado->email}}" placeholder="Ingrese su correo" name="email" required>
                                                                                    </div><br>
                                                                                    <!-- Sede -->
{{--                                                                                    <div class="form-group">--}}
{{--                                                                                        <label for="sede">Sede:</label>--}}
{{--                                                                                        <select class="form-control" id="sede" name="id_sede" required>--}}
{{--                                                                                            <option value="1">Lima</option>--}}
{{--                                                                                            <!-- Agrega más opciones según necesites -->--}}
{{--                                                                                        </select>--}}
{{--                                                                                    </div><br>--}}
                                                                                    <div class="form-group">
                                                                                        <label for="apellidos">Celular:</label>
                                                                                        <input type="number" class="form-control" id="movil" value="{{$listado->movil}}" placeholder="Ingrese su celular" name="movil" required>
                                                                                    </div><br>
                                                                                    <div class="form-group">
                                                                                        <label for="apellidos">Usuario:</label>
                                                                                        <input type="text" class="form-control" id="username"  value="{{$listado->username}}" placeholder="Ingrese su usuario" name="username" required autocomplete="new-password">
                                                                                    </div><br>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <!-- Apellidos -->
                                                                                    <div class="form-group">
                                                                                        <label for="apellidos">Apellidos:</label>
                                                                                        <input type="text" class="form-control" id="surnames" value="{{$listado->surnames}}" placeholder="Ingrese los apellidos" name="surnames" required>
                                                                                    </div><br>
                                                                                    <!-- Tipo de usuario -->
                                                                                    <div class="form-group">
                                                                                        <label for="tipo">Tipo de usuario:</label>
                                                                                        <select class="form-control" id="rol_id" name="rol_id" required>
                                                                                            <option value="1" @selected($listado->rol_id == 1)>Administrador</option>
                                                                                            <option value="2" @selected($listado->rol_id == 2)>Usuario</option>
                                                                                            <option value="3" @selected($listado->rol_id == 3)>Analista</option>
                                                                                            <option value="4" @selected($listado->rol_id == 4)>Aprobador</option>
                                                                                            <option value="4" @selected($listado->rol_id == 5)>Jefe de Sistemas</option>
                                                                                            <option value="4" @selected($listado->rol_id == 6)>Proveedor</option>
                                                                                        </select>
                                                                                    </div><br>
                                                                                    <div class="form-group">
                                                                                        <label for="apellidos">Contraseña: <spam style="font-size:12px;">(Min 8 caracteres)</spam></label>
                                                                                        <input type="password" class="form-control" id="password" value="{{$listado->password}}" placeholder="Ingrese su contraseña" name="password" required minlength="8" autocomplete="new-password">
                                                                                    </div><br>
                                                                                    <!--<div class="form-group">
                                                                                        <label for="apellidos">Usuario:</label>
                                                                                        <input type="text" class="form-control" id="username"  value="{{$listado->username}}" placeholder="Ingrese su usuario" name="username" required autocomplete="new-password">
                                                                                    </div><br>-->
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
                                                                                ¿Estás seguro de que deseas eliminar este usuario?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                                <form method="POST" action="{{ url('eliminar_usuario/' . $listado->id) }}">
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
