<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">
@include('layouts.tableStyle')
<style>
    #users-table.dataTable tbody tr:nth-child(odd) {
        background-color: transparent !important; /* Establece el fondo transparente */
    }
</style>

<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <section class="pt-1 pb-9">
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <!-- <div class="col-auto">
                <h2 class="mb-0">Clientes y Proyectos</h2>
                </div> -->
            </div>
            @include('layouts.alerta')

            <div class="row g-3 mb-6">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="border-bottom border-dashed border-300 pb-4">
                                <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                    <div class="table-responsive">
                                        <div class="col-12 col-sm-auto flex-1">
                                            <!-- Botón para abrir el modal -->

                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <h2 class="mb-0">Clientes</h2>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- <button class="btn btn-primary" @can('crear_cliente')
                                                        href="{{ route('crear.cliente') }}"






                                                    @else
                                                        disabled






                                                    @endcan>Crear Cliente</button> -->
                                                    <button class="btn-xs btn btn-default"
                                                            style="background-color:#01aef0;color:#fff"
                                                            data-bs-toggle="modal" data-bs-target="#miModal">Crear
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="miModal" tabindex="-1"
                                                 aria-labelledby="miModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="miModalLabel">Crear Cliente</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" id="cliente"
                                                                  action="{{url('crear_cliente')}}"
                                                                  enctype="multipart/form-data"
                                                                  onsubmit="return validateForm()">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label>RUC</label>
                                                                            <input class="form-control ruc"
                                                                                   type="number" name="ruc" id="ruc"
                                                                                   placeholder="Ingrese su RUC"
                                                                                   required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label>Razón Social</label>
                                                                            <input class="form-control"
                                                                                   name="razon_social" id="razon_social"
                                                                                   placeholder="Ingrese su razón social"
                                                                                   required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label>Código</label>
                                                                            <input class="form-control codigo"
                                                                                   type="text" name="codigo" id="codigo"
                                                                                   placeholder="Ingrese su código"
                                                                                   required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion" id="accordionExample">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="headingOne">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#collapseOne"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapseOne">
                                                                                    Proyectos
                                                                                </button>
                                                                            </h2>
                                                                            <div class="accordion-collapse collapse"
                                                                                 id="collapseOne"
                                                                                 aria-labelledby="headingOne"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div class="row"
                                                                                     style="justify-content: center;">
                                                                                    <input style="width: 45%"
                                                                                           class="form-control"
                                                                                           type="text"
                                                                                           name="proyectos_nombre"
                                                                                           id="proyectos_nombre"
                                                                                           placeholder="Ingrese el Nombre">
                                                                                    &nbsp;&nbsp;&nbsp;
                                                                                    <input style="width: 45%"
                                                                                           type="number" min="0" max="999999999"
                                                                                           class="form-control"
                                                                                           name="proyectos"
                                                                                           id="proyectos"
                                                                                           placeholder="Contacto de proyectos"
                                                                                           title="Debe contener exactamente 9 dígitos">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="headingTwo">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#collapseTwo"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapseTwo">
                                                                                    Soporte
                                                                                </button>
                                                                            </h2>
                                                                            <div class="accordion-collapse collapse"
                                                                                 id="collapseTwo"
                                                                                 aria-labelledby="headingTwo"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div class="row"
                                                                                     style="justify-content: center;">
                                                                                    <input style="width: 45%"
                                                                                           class="form-control"
                                                                                           type="text"
                                                                                           name="soporte_nombre"
                                                                                           id="soporte_nombre"
                                                                                           placeholder="Ingrese el Nombre">
                                                                                    &nbsp;&nbsp;&nbsp;
                                                                                    <input style="width: 45%"
                                                                                           type="number" min="0" max="999999999"
                                                                                           class="form-control"
                                                                                           name="soporte" id="soporte"
                                                                                           placeholder="Contacto de soporte"
                                                                                           title="Debe contener exactamente 9 dígitos">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="headingThree">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#collapseThree"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapseThree">
                                                                                    Facturación
                                                                                </button>
                                                                            </h2>
                                                                            <div class="accordion-collapse collapse"
                                                                                 id="collapseThree"
                                                                                 aria-labelledby="headingThree"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div class="row"
                                                                                     style="justify-content: center;">
                                                                                    <input style="width: 45%"
                                                                                           class="form-control"
                                                                                           type="text"
                                                                                           name="facturacion_nombre"
                                                                                           id="facturacion_nombre"
                                                                                           placeholder="Ingrese el Nombre">
                                                                                    &nbsp;&nbsp;&nbsp;
                                                                                    <input style="width: 45%"
                                                                                           type="number" min="0" max="999999999"
                                                                                           class="form-control"
                                                                                           name="facturacion"
                                                                                           id="facturacion"
                                                                                           placeholder="Contacto de facturación"
                                                                                           title="Debe contener exactamente 9 dígitos">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="headingFour">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#collapseFour"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapseFour">
                                                                                    Despacho
                                                                                </button>
                                                                            </h2>
                                                                            <div class="accordion-collapse collapse"
                                                                                 id="collapseFour"
                                                                                 aria-labelledby="headingFour"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div class="row"
                                                                                     style="justify-content: center;">
                                                                                    <input style="width: 45%"
                                                                                           class="form-control codigo"
                                                                                           type="text"
                                                                                           name="despacho_nombre"
                                                                                           id="despacho_nombre"
                                                                                           placeholder="Ingrese el Nombre">
                                                                                    &nbsp;&nbsp;&nbsp;
                                                                                    <input style="width: 45%"
                                                                                           type="number" min="0" max="999999999"
                                                                                           class="form-control"
                                                                                           name="despacho"
                                                                                           id="despacho"
                                                                                           placeholder="Contacto de despacho"
                                                                                           title="Debe contener exactamente 9 dígitos">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label>Dirección</label>
                                                                            <textarea class="form-control"
                                                                                      name="direccion_1"
                                                                                      id="direccion_1"
                                                                                      placeholder="Ingrese la dirección"
                                                                                      required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="loader"></div>
                                                                    <br>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                                class="btn btn-primary">
                                                                            Enviar
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cerrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>RUC</th>
                                                    <th>Razón Social</th>
                                                    <th>Facturación</th>
                                                    <th>Despacho</th>
                                                    <th>Proyectos</th>
                                                    <th>Soporte</th>
                                                    <th>Dirección</th>
                                                    <th>Acción</th>
                                                    <!-- <th>Cliente</th> -->
                                                    <!-- <th>Programado</th>
                                                    <th>Avance</th>
                                                    <th>Usuario</th> -->
                                                    <!-- <th>Estado</th>
                                                    <th>Acción</th> -->
                                                    <!-- Agrega más columnas según tus necesidades -->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($lista as $listado)
                                                    <tr>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            {{ $listado->codigo_cliente }}</td>
                                                        <td>{{ $listado->ruc }}</td>
                                                        <td>{{ $listado->razon_social }}</td>
                                                        <td>{{ $listado->facturacion_nombre }}<br>{{ $listado->facturacion }}</td>
                                                        <td>{{ $listado->despacho_nombre }}<br>{{ $listado->despacho }}</td>
                                                        <td>{{ $listado->proyectos_nombre }}<br>{{ $listado->proyectos }}</td>
                                                        <td>{{ $listado->soporte_nombre }}<br>{{ $listado->soporte }}</td>
                                                        <td title="{{$listado->direccion_1}}">
                                                            {{ \Illuminate\Support\Str::limit($listado->direccion_1, 20, $end='...') }}
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
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                           data-bs-target="#editar{{$listado->id}}">Editar</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                           data-bs-target="#eliminarModal{{$listado->id}}">Eliminar</a>
                                                                    </li>
                                                                    <!-- <li><a class="dropdown-item" href="#">Eliminar</a></li> -->
                                                                </ul>
                                                            </div>
                                                            <div class="modal fade" id="editar{{$listado->id}}"
                                                                 tabindex="-1"
                                                                 aria-labelledby="editar{{$listado->id}}Label"
                                                                 aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editarModal{{$listado->id}}Label">
                                                                                Editar Cliente</h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí puedes colocar los campos de edición -->
                                                                            <!-- Por ejemplo, puedes reutilizar el formulario de creación y precargar los datos del cliente -->
                                                                            <form method="POST"
                                                                                  action="{{ url('editar_cliente/' . $listado->id) }}"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="mb-3">
                                                                                        <label>RUC</label>
                                                                                        <input class="form-control ruc"
                                                                                               type="number" name="ruc" id="ruc"
                                                                                               placeholder="Ingrese su RUC"
                                                                                               value="{{$listado->ruc}}"
                                                                                               required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="mb-3">
                                                                                        <label>Razón Social</label>
                                                                                        <input class="form-control"
                                                                                               name="razon_social" id="razon_social"
                                                                                               value="{{$listado->razon_social}}"
                                                                                               placeholder="Ingrese su razón social"
                                                                                               required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="mb-3">
                                                                                        <label>Código</label>
                                                                                        <input class="form-control codigo"
                                                                                               type="text" name="codigo" id="codigo"
                                                                                               value="{{$listado->codigo_cliente}}"
                                                                                               placeholder="Ingrese su código"
                                                                                               required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="accordion" id="accordionExample">
                                                                                    <div class="accordion-item">
                                                                                        <h2 class="accordion-header"
                                                                                            id="headingOne">
                                                                                            <button
                                                                                                class="accordion-button collapsed"
                                                                                                type="button"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#collapseOne"
                                                                                                aria-expanded="false"
                                                                                                aria-controls="collapseOne">
                                                                                                Proyectos
                                                                                            </button>
                                                                                        </h2>
                                                                                        <div class="accordion-collapse collapse"
                                                                                             id="collapseOne"
                                                                                             aria-labelledby="headingOne"
                                                                                             data-bs-parent="#accordionExample">
                                                                                            <div class="row"
                                                                                                 style="justify-content: center;">
                                                                                                <input style="width: 45%"
                                                                                                       class="form-control"
                                                                                                       type="text" value="{{$listado->proyectos_nombre}}"
                                                                                                       name="proyectos_nombre"
                                                                                                       id="proyectos_nombre"
                                                                                                       placeholder="Ingrese el Nombre">
                                                                                                &nbsp;&nbsp;&nbsp;
                                                                                                <input style="width: 45%"
                                                                                                       type="number" min="0" max="999999999"
                                                                                                       class="form-control"
                                                                                                       name="proyectos"
                                                                                                       id="proyectos" value="{{$listado->proyectos}}"
                                                                                                       placeholder="Contacto de proyectos"
                                                                                                       title="Debe contener exactamente 9 dígitos">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="accordion-item">
                                                                                        <h2 class="accordion-header"
                                                                                            id="headingTwo">
                                                                                            <button
                                                                                                class="accordion-button collapsed"
                                                                                                type="button"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#collapseTwo"
                                                                                                aria-expanded="false"
                                                                                                aria-controls="collapseTwo">
                                                                                                Soporte
                                                                                            </button>
                                                                                        </h2>
                                                                                        <div class="accordion-collapse collapse"
                                                                                             id="collapseTwo"
                                                                                             aria-labelledby="headingTwo"
                                                                                             data-bs-parent="#accordionExample">
                                                                                            <div class="row"
                                                                                                 style="justify-content: center;">
                                                                                                <input style="width: 45%"
                                                                                                       class="form-control"
                                                                                                       type="text" value="{{$listado->soporte_nombre}}"
                                                                                                       name="soporte_nombre"
                                                                                                       id="soporte_nombre"
                                                                                                       placeholder="Ingrese el Nombre">
                                                                                                &nbsp;&nbsp;&nbsp;
                                                                                                <input style="width: 45%"
                                                                                                       type="number" value="{{$listado->soporte}}"
                                                                                                       min="0" max="999999999"
                                                                                                       class="form-control"
                                                                                                       name="soporte" id="soporte"
                                                                                                       placeholder="Contacto de soporte"
                                                                                                       title="Debe contener exactamente 9 dígitos">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="accordion-item">
                                                                                        <h2 class="accordion-header"
                                                                                            id="headingThree">
                                                                                            <button
                                                                                                class="accordion-button collapsed"
                                                                                                type="button"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#collapseThree"
                                                                                                aria-expanded="false"
                                                                                                aria-controls="collapseThree">
                                                                                                Facturación
                                                                                            </button>
                                                                                        </h2>
                                                                                        <div class="accordion-collapse collapse"
                                                                                             id="collapseThree"
                                                                                             aria-labelledby="headingThree"
                                                                                             data-bs-parent="#accordionExample">
                                                                                            <div class="row"
                                                                                                 style="justify-content: center;">
                                                                                                <input style="width: 45%"
                                                                                                       class="form-control"
                                                                                                       type="text" value="{{$listado->facturacion_nombre}}"
                                                                                                       name="facturacion_nombre"
                                                                                                       id="facturacion_nombre"
                                                                                                       placeholder="Ingrese el Nombre">
                                                                                                &nbsp;&nbsp;&nbsp;
                                                                                                <input style="width: 45%"
                                                                                                       type="number" min="0" max="999999999"
                                                                                                       value="{{$listado->facturacion}}"
                                                                                                       class="form-control"
                                                                                                       name="facturacion"
                                                                                                       id="facturacion"
                                                                                                       placeholder="Contacto de facturación"
                                                                                                       title="Debe contener exactamente 9 dígitos">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="accordion-item">
                                                                                        <h2 class="accordion-header"
                                                                                            id="headingFour">
                                                                                            <button
                                                                                                class="accordion-button collapsed"
                                                                                                type="button"
                                                                                                data-bs-toggle="collapse"
                                                                                                data-bs-target="#collapseFour"
                                                                                                aria-expanded="false"
                                                                                                aria-controls="collapseFour">
                                                                                                Despacho
                                                                                            </button>
                                                                                        </h2>
                                                                                        <div class="accordion-collapse collapse"
                                                                                             id="collapseFour"
                                                                                             aria-labelledby="headingFour"
                                                                                             data-bs-parent="#accordionExample">
                                                                                            <div class="row"
                                                                                                 style="justify-content: center;">
                                                                                                <input style="width: 45%"
                                                                                                       class="form-control codigo"
                                                                                                       type="text" value="{{$listado->despacho_nombre}}"
                                                                                                       name="despacho_nombre"
                                                                                                       id="despacho_nombre"
                                                                                                       placeholder="Ingrese el Nombre">
                                                                                                &nbsp;&nbsp;&nbsp;
                                                                                                <input style="width: 45%"
                                                                                                       type="number" min="0" max="999999999"
                                                                                                       class="form-control"
                                                                                                       name="despacho"
                                                                                                       id="despacho" value="{{$listado->despacho}}"
                                                                                                       placeholder="Contacto de despacho"
                                                                                                       title="Debe contener exactamente 9 dígitos">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="mb-3">
                                                                                        <label>Dirección</label>
                                                                                        <textarea class="form-control"
                                                                                                  name="direccion_1"
                                                                                                  id="direccion_1"
                                                                                                  placeholder="Ingrese la dirección"
                                                                                                  required>{{$listado->direccion_1}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                            class="btn btn-primary">
                                                                                        Guardar Cambios
                                                                                    </button>
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">
                                                                                        Cerrar
                                                                                    </button>
                                                                                </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="eliminarModal{{$listado->id}}"
                                                                 tabindex="-1"
                                                                 aria-labelledby="eliminarModal{{$listado->id}}Label"
                                                                 aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="eliminarModal{{$listado->id}}Label">
                                                                                Eliminar Cliente</h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí puedes mostrar un mensaje de confirmación de eliminación -->
                                                                            <p>¿Al eliminar el cliente eliminaria sus
                                                                                proyecto asociados a este?.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form method="POST"
                                                                                  action="{{ url('eliminar_cliente/' . $listado->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                        class="btn btn-danger">Eliminar
                                                                                </button>
                                                                            </form>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Cancelar
                                                                            </button>
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
        // "scrollY": '100%', // Ajusta la altura al 100% del contenedor
        // "scrollCollapse": true, // Habilita el colapso del scroll cuando no es necesario
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
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

<script>
    $('#users-table-two').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
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
<script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>

<script>
    function validateForm() {
        var rucInput = document.getElementById('ruc');
        if (rucInput.value.length !== 11) {
            alert('El RUC debe tener exactamente 11 dígitos');
            return false; // Evita que el formulario se envíe si la validación falla
        }
        return true; // Permite que el formulario se envíe si la validación es exitosa
    }
</script>


</body>
</html>
