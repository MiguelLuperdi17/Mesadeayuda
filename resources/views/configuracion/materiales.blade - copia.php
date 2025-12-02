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
                    <h2 class="mb-0">Materiales</h2>
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
                                        <!-- Botón para abrir el modal -->
                                        <div class="col-12 col-sm-auto">
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#01aef0;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#crearMaterial">Crear
                                            </button>
                                            <button class="btn-xs btn btn-default"
                                                    style="background-color:#2ba708;color:#fff" data-bs-toggle="modal"
                                                    data-bs-target="#importModal">Importar
                                            </button>
                                            <a href="{{ asset('/Plantilla_Global.xlsx') }}" title="DESCARGAR FORMATO"
                                               download>
                                                <button class="btn btn-sm btn-default"
                                                        style="background-color:#2ba708;color:#fff">
                                                    <i class="fas fa-download"></i>
                                                    <!-- Icono de descarga de Font Awesome -->
                                                </button>
                                            </a>
                                            <!-- <button class="btn-xs btn btn-default"  style="background-color:#01aef0;color:#fff"data-bs-toggle="modal" data-bs-target="#miModal">Costo</button> -->
                                        </div>

                                        <div class="modal fade" id="importModal" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Importar
                                                            Excel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('import_excel') }}" method="POST"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="excelFile" class="form-label">Seleccionar
                                                                    archivo Excel</label>
                                                                <input class="form-control" type="file" name="excelFile"
                                                                       id="excelFile" required>
                                                            </div>

                                                            <!-- Vista previa del archivo Excel -->
                                                            <div id="excelPreview" style="display: none;">
                                                                <h6>Vista previa del archivo Excel:</h6>
                                                                <div id="previewContent"></div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Subir
                                                                </button>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar
                                                                </button>
                                                            </div>
                                                            <!-- <button type="submit" class="btn btn-primary">Importar</button> -->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal para crear material -->
                                        <!-- Modal para crear material -->
                                        <div class="modal fade" id="crearMaterial" tabindex="-1"
                                             aria-labelledby="crearMaterialLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="crearMaterialLabel">Crear
                                                            Material</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" id="cliente"
                                                              action="{{ url('guardar_material') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="codigo"
                                                                               class="form-label">Código</label>
                                                                        <input type="text" class="form-control"
                                                                               id="codigo" name="codigo" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="descripcion" class="form-label">Descripción</label>
                                                                        <textarea class="form-control" id="descripcion"
                                                                                  name="descripcion" rows="3"
                                                                                  required></textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="marca"
                                                                               class="form-label">Marca</label>
                                                                        <input type="text" class="form-control"
                                                                               id="marca" name="marca" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="sub_familia" class="form-label">Sub
                                                                            Familia</label>
                                                                        <input type="text" class="form-control"
                                                                               id="sub_familia" name="sub_familia"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="nro_parte" class="form-label">N°
                                                                            Parte</label>
                                                                        <input type="text" class="form-control"
                                                                               id="nro_parte" name="nro_parte" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="desc_larga" class="form-label">Descripción
                                                                            Larga</label>
                                                                        <textarea class="form-control" id="desc_larga"
                                                                                  name="desc_larga" rows="3"
                                                                                  required></textarea>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <!-- Grupo ocupa 8 de 12 columnas -->
                                                                            <div class="mb-3">
                                                                                <label for="familia" class="form-label">Familia</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="familia" name="familia"
                                                                                       required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <!-- UM ocupa 4 de 12 columnas -->
                                                                            <div class="mb-3">
                                                                                <label for="um"
                                                                                       class="form-label">C.Uni</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="costo_unitario"
                                                                                       placeholder="Costo"
                                                                                       name="costo_unitario" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <!-- Grupo ocupa 8 de 12 columnas -->
                                                                            <div class="mb-3">
                                                                                <label for="grupo" class="form-label">Grupo</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="grupo" name="grupo" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <!-- UM ocupa 4 de 12 columnas -->
                                                                            <div class="mb-3">
                                                                                <label for="um"
                                                                                       class="form-label">UM</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="um" name="um" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="loader"></div>
                                                            <br>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Guardar
                                                                </button>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <br>
                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>

                                                <tr>
                                                    <th style="display: none;"></th>
                                                    <th>Codigo</th>
                                                    <th>N° Parte</th>
                                                    <th>Descripcion</th>
                                                    <th>UM</th>
                                                    <th>Familia</th>
                                                    <th>Sub Familia</th>
                                                    <th>Grupo</th>
                                                    <th>Costo</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($lista as $listado)
                                                    <tr>
                                                        <td style="display: none;">{{ $listado->id }}</td>
                                                        <td>{{ $listado->codigo }}</td>
                                                        <!-- <td>{{ $listado->nro_parte }}</td> -->
                                                        <td title="{{$listado->nro_parte}}">
                                                            @if(strlen($listado->nro_parte) > 15)
                                                                {{ substr($listado->nro_parte, 0, 15) . '...' }}
                                                            @else
                                                                {{ $listado->nro_parte }}
                                                            @endif
                                                        </td>
                                                        <td title="{{$listado->descripcion}}">
                                                            @if(strlen($listado->descripcion) > 27)
                                                                {{ substr($listado->descripcion, 0, 27) . '...' }}
                                                            @else
                                                                {{ $listado->descripcion }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $listado->um }}</td>
                                                        <td>{{ $listado->familia }}</td>
                                                        <td>{{ $listado->sub_familia }}</td>
                                                        <td>{{ $listado->grupo }}</td>
                                                        <td>{{ $listado->costo_unitario }}</td>
                                                        <td>
                                                            @if($listado->estado == 1)
                                                                <h6 style="color:green;">Activo</h6>
                                                            @else
                                                                <h6 style="color:red;">Inactivo</h6>
                                                            @endif</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-default dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-cog dropdown-toggle"></i>
                                                                </button>

                                                                <form id="formAnular"
                                                                      action="{{ route('anular_registro', $listado->id) }}"
                                                                      method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                                <!-- <form id="formActivar" action="{{ route('activar_registro', $listado->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                </form> -->

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    @if($listado->estado == 1)
                                                                        <li>
                                                                            <a class="dropdown-item" href="#"
                                                                               onclick="event.preventDefault(); document.getElementById('formAnular').submit();">
                                                                                Anular
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                               data-bs-toggle="modal"
                                                                               data-bs-target="#editarMaterial{{$listado->id}}">
                                                                                Editar
                                                                            </a>
                                                                        </li>
                                                                        <!--
                                                                    @else
                                                                        <li>
                                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('formActivar').submit();">
                                                                                Activar
                                                                            </a>
                                                                        </li> -->
                                                                    @endif
                                                                </ul>
                                                            </div>

                                                        </td>

                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                    <div class="modal fade" id="editarMaterial{{$listado->id}}"
                                                         tabindex="-1" aria-labelledby="editarMaterialLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editarMaterialLabel">
                                                                        Editar Material - {{$listado->codigo}}</h5>
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" id="cliente"
                                                                          action="{{ url('actualizar_material',$listado->id) }}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="codigo"
                                                                                           class="form-label">Código</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="codigo" name="codigo"
                                                                                           value="{{$listado->codigo}}"
                                                                                           disabled>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="descripcion"
                                                                                           class="form-label">Descripción</label>
                                                                                    <textarea class="form-control"
                                                                                              id="descripcion"
                                                                                              name="descripcion"
                                                                                              rows="3"
                                                                                              required>{{$listado->descripcion}}</textarea>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="marca"
                                                                                           class="form-label">Marca</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="marca" name="marca"
                                                                                           value="{{$listado->marca}}"
                                                                                           required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="sub_familia"
                                                                                           class="form-label">Sub
                                                                                        Familia</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="sub_familia"
                                                                                           name="sub_familia"
                                                                                           value="{{$listado->sub_familia}}"
                                                                                           required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="nro_parte"
                                                                                           class="form-label">N°
                                                                                        Parte</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="nro_parte"
                                                                                           name="nro_parte"
                                                                                           value="{{$listado->nro_parte}}"
                                                                                           required>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="desc_larga"
                                                                                           class="form-label">Descripción
                                                                                        Larga</label>
                                                                                    <textarea class="form-control"
                                                                                              id="desc_larga"
                                                                                              name="desc_larga" rows="3"
                                                                                              required>{{$listado->desc_larga}}</textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <!-- Grupo ocupa 8 de 12 columnas -->
                                                                                        <div class="mb-3">
                                                                                            <label for="familia"
                                                                                                   class="form-label">Familia</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   id="familia"
                                                                                                   name="familia"
                                                                                                   value="{{$listado->familia}}"
                                                                                                   required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <!-- UM ocupa 4 de 12 columnas -->
                                                                                        <div class="mb-3">
                                                                                            <label for="um"
                                                                                                   class="form-label">C.Uni</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   id="costo_unitario"
                                                                                                   placeholder="Costo"
                                                                                                   name="costo_unitario"
                                                                                                   value="{{$listado->costo_unitario}}"
                                                                                                   required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <!-- Grupo ocupa 8 de 12 columnas -->
                                                                                        <div class="mb-3">
                                                                                            <label for="grupo"
                                                                                                   class="form-label">Grupo</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   id="grupo"
                                                                                                   name="grupo"
                                                                                                   value="{{$listado->grupo}}"
                                                                                                   required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <!-- UM ocupa 4 de 12 columnas -->
                                                                                        <div class="mb-3">
                                                                                            <label for="um"
                                                                                                   class="form-label">UM</label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   value="{{$listado->um}}"
                                                                                                   id="um" name="um"
                                                                                                   required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="loader"></div>
                                                                        <br>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">Guardar
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cancelar
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
           var table =  $('#users-table').DataTable({
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
