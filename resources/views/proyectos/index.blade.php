<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">

<style>
    .contenido-archivo {
        font-size: 16px;
        /* Tamaño de fuente más grande */
        overflow: auto;
        /* Permitir que el contenido se ajuste sin barras de desplazamiento */
        white-space: pre-wrap;
        /* Mantener el formato del texto */
    }

    .tabla-container {
        max-height: 400px;
        /* Altura máxima del contenedor */
        overflow-y: auto;
        /* Scroll vertical automático */
    }

    .my-table th,
    .my-table td {
        font-size: 12px;
        /* Ajusta el tamaño de la letra según tus preferencias */
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
                        <h2 class="mb-0">Proyectos</h2>
                    </div>
                </div>
                @if (session('access_denied'))
                    <script>
                        alert("No tienes permiso para acceder a esta página. Por favor, inicia sesión.");
                    </script>
                @endif
                @include('layouts.alerta')
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div class="row g-3 mb-6">
                    <div class="col-12 col-lg-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="border-bottom border-dashed border-300 pb-4">
                                    <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                        <div class="table-responsive">
                                            <!-- Botón para abrir el modal -->
                                            <div class="col-12 col-sm-auto">
                                                <button class="btn-xs btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#miModal">Crear Proyecto
                                                </button>
                                            </div>
                                            @if (session('success'))
                                                <div class="alert alert-soft-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Modal -->
                                            <div class="modal fade" id="miModal" tabindex="-1"
                                                aria-labelledby="miModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="miModalLabel">Crear proyecto
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" name="formArchivo" class="cliente"
                                                                action="{{ url('crear_proyecto') }}" id="formArchivo"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- Primer campo de selección -->
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Título de
                                                                                    Proyecto</label>
                                                                                <input type="text"
                                                                                    class="form-control me-2"
                                                                                    name="título"
                                                                                    placeholder="Ingrese título">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Tipo de
                                                                                    seguimiento</label>
                                                                                <select class="form-select select33"
                                                                                    name="id_categoria"
                                                                                    id="id_categoria"
                                                                                    data-choices="data-choices"
                                                                                    data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                    required>
                                                                                    <option value="" selected
                                                                                        disabled>
                                                                                        Seleccionar Tipo...
                                                                                    </option>
                                                                                    <option value="1"> Desarrollo
                                                                                    </option>
                                                                                    <option value="2">
                                                                                        Mantenimiento</option>
                                                                                    <option value="3">
                                                                                        Infraestructura</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="exampleTextarea">Seleccionar
                                                                                    responsable</label>
                                                                                <select class="form-select select33"
                                                                                    name="id_responsable"
                                                                                    id="id_responsable"
                                                                                    data-choices="data-choices"
                                                                                    data-options='{"removeItemButton":true,"placeholder":true}'
                                                                                    required>
                                                                                    @if ($user->rol_id == 1)
                                                                                        <option value="" selected
                                                                                            disabled>
                                                                                            Seleccionar responsable...
                                                                                        </option>
                                                                                        @foreach ($analistas as $analista)
                                                                                            <option
                                                                                                value="{{ $analista->id }}">
                                                                                                {{ $analista->username }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <option
                                                                                            value="{{ $user->id }}">
                                                                                            {{ $user->username }}
                                                                                        </option>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Campo de descripción -->
                                                                        <div class="mb-0">
                                                                            <label class="form-label"
                                                                                for="exampleTextarea">Ingrese una
                                                                                descripción.</label>
                                                                            <textarea class="form-control" id="requerimiento" name="requerimiento" placeholder="Ingrese detalle" rows="3"
                                                                                maxlength="200" required></textarea>
                                                                        </div>

                                                                        <!-- Nuevos campos para el "hito" y fechas -->
                                                                        <div class="mb-3" id="hitosContainer">
                                                                            <label class="form-label"
                                                                                for="hitos">Hitos</label>
                                                                            <div id="hitosList">
                                                                                <div class="d-flex mb-2">
                                                                                    <input type="text"
                                                                                        class="form-control me-2"
                                                                                        name="hitos[]"
                                                                                        placeholder="Ingrese hito">
                                                                                    <input type="date"
                                                                                        class="form-control me-2"
                                                                                        name="fecha_inicio[]" required>
                                                                                    <input type="date"
                                                                                        class="form-control me-2"
                                                                                        name="fecha_fin[]" required>
                                                                                    <button type="button"
                                                                                        class="btn btn-danger btn-sm ms-2 removeHitoBtn">
                                                                                        -
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                id="addHitoBtn">+
                                                                            </button>
                                                                        </div>

                                                                        <!-- Campo de archivos adjuntos -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="formFileMultiple">
                                                                                Seleccione sus archivos adjuntos
                                                                                <font color="red">(Máximo 3
                                                                                    archivos)</font>
                                                                            </label>
                                                                            <input class="form-control archivo"
                                                                                id="archivo" name="archivos[]"
                                                                                accept=".pdf, .docx, .xlsx, .xls"
                                                                                type="file" multiple="multiple"
                                                                                onchange="validarArchivos(event)" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Botones de acción -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Cancelar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="MisComentarios" tabindex="-1"
                                                aria-labelledby="miModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <!-- Cambiado de modal-dialog a modal-xl -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="miModalLabel">Comentarios</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: -webkit-center;"
                                                            id="comentarios">
                                                            <table class="table table-striped table-bordered"
                                                                style="width: 90%">
                                                                <tbody>
                                                                    <tr>
                                                                        <th
                                                                            style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">
                                                                            Fecha
                                                                        </th>
                                                                        <th
                                                                            style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">
                                                                            Usuario
                                                                        </th>
                                                                        <th
                                                                            style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">
                                                                            Comentario
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <table id="users-table" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            style="width: 10%;vertical-align: middle;text-align: -webkit-center;">
                                                            Correlativo/Título
                                                        </th>
                                                        <th
                                                            style="width: 10%;vertical-align: middle;text-align: -webkit-center;">
                                                            Categoría
                                                        </th>
                                                        <th style="width: 10%">Responsable</th>
                                                        <th style="width: 40%">Detalle</th>
                                                        <th style="width: 10%">Estado</th>
                                                        <th style="width: 10%">Fecha de Creación</th>
                                                        <th style="width: 5%">Hitos</th>
                                                        <th style="width: 5%">Acciones</th>
                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($proyectos as $proyecto)
                                                        <tr>
                                                            <td
                                                                style="vertical-align: middle;text-align: -webkit-center;">
                                                                Proyecto-{{ $proyecto->correlativo }}
                                                                <br>
                                                                {!! wordwrap($proyecto->titulo, 20, "<br>\n", false) !!}
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle;text-align: -webkit-center;">
                                                                {{ $proyecto->id_categoria }}
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                {{ $proyecto->user->username }}
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                {!! wordwrap($proyecto->descripcion, 80, "<br>\n", false) !!}
                                                                @if ($proyecto->adjuntos->count() > 0)
                                                                    <br><br>
                                                                    <font style="font-weight: 900">Adjuntos: </font>
                                                                    <br>
                                                                    @foreach ($proyecto->adjuntos as $adjunto)
                                                                        <a href="{{ asset('archivos/' . $adjunto->detalle) }}"
                                                                            target="_blank">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16px" height="16px"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="feather feather-link fs-3">
                                                                                <path
                                                                                    d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71">
                                                                                </path>
                                                                                <path
                                                                                    d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71">
                                                                                </path>
                                                                            </svg>
                                                                            {{ $adjunto->detalle }}</a>&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle; text-align: -webkit-center;">
                                                                Estado:
                                                                @if ($proyecto->estado == 3)
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-warning">Atrasado</span>
                                                                @elseif($proyecto->estado == 0)
                                                                    <span class="badge badge-phoenix badge-phoenix-info">En Proceso</span>
                                                                @elseif($proyecto->estado == 2)
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-danger">Rechazado</span>
                                                                    <br>
                                                                    <a class="nav-link label-1"
                                                                        data-bs-target="#Comentario_rechazado{{ $proyecto->id }}"
                                                                        role="button" data-bs-toggle="modal"
                                                                        aria-expanded="false">
                                                                        <button class="btn btn-success">Ver
                                                                            Comentario</button>
                                                                    </a>
                                                                    <div class="modal fade"
                                                                        id="Comentario_rechazado{{ $proyecto->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="Comentario_rechazado"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl">
                                                                            <!-- Cambiado de modal-dialog a modal-xl -->
                                                                            <div class="modal-content"
                                                                                style="width: 50%;">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="Comentario_rechazado">
                                                                                        Proyecto-{{ $proyecto->correlativo }}
                                                                                        Rechazado
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body"
                                                                                    style="width: 70%;align-self: center;">
                                                                                    <h3>Motivo de rechazo:</h3>
                                                                                    {{ $proyecto->comentario }}
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($proyecto->estado == 4)
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-danger">Vencido</span>
                                                                @elseif($proyecto->estado == 5)
                                                                        <span class="badge badge-phoenix badge-phoenix-danger">Extendido</span>
                                                                @elseif($proyecto->estado == 6)
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                                @endif
                                                                @if($proyecto->ext->count())
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editado{{$proyecto->id}}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar text-900 fs-3">
                                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                                      </svg>
                                                                </a>
                                                                <div class="modal fade" id="editado{{$proyecto->id}}" tabindex="-1"
                                                                    aria-labelledby="miModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="miModalLabel">Proyecto: {{$proyecto->titulo}}
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="table-responsive table-reponsive-sm scrollbar">
                                                                                    <table class="table table-striped table-bordered"
                                                                                        style="min-height: 310px; text-align: center; vertical-align: middle;">
                                                                                        <thead>
                                                                                            <tr style="background: #2ba708; vertical-align: middle;">
                                                                                                <th scope="col" style="font-weight: 700; width: 10%">Hito</th>
                                                                                                <th scope="col" style="font-weight: 700; width: 20%">Fecha inicio</th>
                                                                                                <th scope="col" style="font-weight: 700; width: 20%">Fecha final</th>
                                                                                                <th scope="col" style="font-weight: 700; width: 20%">fecha de modificación</th>
                                                                                                <th scope="col" style="font-weight: 700; width: 30%">Comentario</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($proyecto->ext as $estendido )
                                                                                            <tr>
                                                                                                <td>{{ $estendido->hito->nombre }}</td>
                                                                                                <td>{{ $estendido->fecha_inicio }}</td>
                                                                                                <td>{{ $estendido->fecha_fin }}</td>
                                                                                                <td>{{ $estendido->cambio }}</td>

                                                                                                <td>{!! wordwrap($estendido->comentario, 65, "<br>\n", false) !!}</td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if ($user->rol_id == 5 || $user->rol_id == 1)
                                                                    <br>
                                                                    <div class="d-flex gap-2">
                                                                        @if ($proyecto->aprobacion == 0)
                                                                            <a
                                                                                href="{{ url('aprobar_proyecto/' . $proyecto->id) }}">
                                                                                <button class="btn btn-primary"
                                                                                    type="submit">✓</button>
                                                                            </a>
                                                                            <a class="nav-link label-1"
                                                                                data-bs-target="#RechazarTicket{{ $proyecto->id }}"
                                                                                role="button" data-bs-toggle="modal"
                                                                                aria-expanded="false">
                                                                                <button
                                                                                    class="btn btn-danger">X</button>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                                <div class="modal fade"
                                                                    id="RechazarTicket{{ $proyecto->id }}"
                                                                    tabindex="-1" aria-labelledby="RechazarTicket"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl">
                                                                        <!-- Cambiado de modal-dialog a modal-xl -->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="RechazarTicket">Rechazar
                                                                                    Proyecto-{{ $proyecto->correlativo }}
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form method="POST"
                                                                                    action="{{ url('rechazar_proyecto') }}"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                        value="{{ $proyecto->id }}"
                                                                                        name="id">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <label class="form-label"
                                                                                                for="comentario">Ingrese
                                                                                                el comentario para
                                                                                                rechazar el
                                                                                                proyecto</label>
                                                                                            <textarea class="form-control" id="comentario" name="comentario" placeholder="Comentario para rechazar el proyecto"
                                                                                                rows="3" maxlength="200" required></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer mt-3">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Guardar</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-danger"
                                                                                            data-bs-dismiss="modal">Cancelar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle; text-align: -webkit-center;">
                                                                {{ $proyecto->fecha_creacion }}
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle; text-align: -webkit-center;">
                                                                {{ $proyecto->hitos->count() }}
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle; text-align: -webkit-center;">
                                                                @if ($proyecto->aprobacion == 1)
                                                                    <a
                                                                        href="{{ url('programa_hitos/' . $proyecto->id) }}">
                                                                        <button class="btn btn-primary"
                                                                            type="submit">Ver</button>
                                                                    </a>
                                                                @else
                                                                    @if ($user->rol_id == 5)
                                                                        <a
                                                                            href="{{ url('programa_hitos/' . $proyecto->id) }}">
                                                                            <button class="btn btn-primary"
                                                                                type="submit">Ver</button>
                                                                        </a>
                                                                    @else
                                                                        <button class="btn btn-primary" type="submit"
                                                                            disabled>Ver</button>
                                                                    @endif
                                                                @endif
                                                            </td>
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

    <script src="{{ asset('/template/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                "responsive": true,
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
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' + // Ajuste aquí para la parte superior izquierda
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12"p>>',
                "pagingType": "simple_numbers",
                "order": [
                    [0, 'desc']
                ], // Ordenar por la tercera columna (0-indexado)
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ] // Menú de selección de registros por página
            });
        });
    </script>
    <script>
        function validarArchivos(event) {
            var input = event.target;
            var files = input.files;
            var allowedExtensions = ['pdf', 'docx', 'xlsx', 'xls']; // Extensiones permitidas
            var maxFiles = 3; // Número máximo de archivos permitido

            // Validar número de archivos
            if (files.length > maxFiles) {
                alert("Solo se pueden seleccionar hasta " + maxFiles + " archivos.");
                input.value = ''; // Limpiar la selección de archivos
                return; // Salir de la función si se excede el número máximo de archivos
            }

            // Validar tipos de archivos
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileExtension = file.name.split('.').pop().toLowerCase(); // Obtener la extensión del archivo

                if (allowedExtensions.indexOf(fileExtension) === -1) {
                    alert("Archivo '" + file.name +
                        "' no es válido. Solo se permiten archivos con las siguientes extensiones: .pdf, .docx, .xlsx, .xls"
                    );
                    input.value = ''; // Limpiar la selección de archivos
                    return; // Salir de la función si se encuentra un archivo no válido
                }
            }
        }
    </script>
    <script>
        function cargarDatos(id) {
            console.log(id);

            // Limpiar contenido anterior
            $('#comentarios').html('');

            // Realizar la solicitud AJAX
            $.ajax({
                url: '{{ url('MisComentarios') }}', // Ajusta la URL según tu configuración
                method: 'POST',
                data: {
                    ticket_id: id,
                    _token: '{{ csrf_token() }}' // Obtener el token CSRF de manera adecuada
                }
            }).done(function(res) {
                var datos = JSON.parse(res);
                console.log(datos);

                // Construir el contenido del modal
                var contenidoModal =
                    '<table class="table table-striped table-bordered" ><tbody><tr><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Fecha</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Usuario</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">Comentario</th></tr>';
                // var contenidoModal = '<h5>Editar Material - ' + datos[0].codigo + '</h5>';
                for (var x = 0; x < datos[0].length; x++) {
                    contenidoModal += '<tr><td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[
                        0][x].fecha + '</td>';
                    contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x]
                        .username + '</td>';
                    contenidoModal +=
                        '<td style="border: 1px solid #9fa6bc; align-content: center; white-space: pre-line;">' +
                        datos[0][x].comentario + '</td></tr>';
                }
                contenidoModal += '</tbody></table>';

                // Agregar contenido al modal
                $('#comentarios').html(contenidoModal);

                // Abrir el modal
                $('#MisComentarios').modal('show');
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Suponiendo que tienes una forma de verificar si el usuario está autenticado
            var isAuthenticated = {{ $variable }} /* lógica para verificar autenticación */ ;

            if (!isAuthenticated) {
                alert("Tu sesión ha expirado o no tienes acceso a esta página.");
                window.location.href = "/login"; // Redirige a la página de inicio de sesión
            }
        });
    </script>
    <script>
        // Función para agregar nuevos campos de hito
        document.getElementById('addHitoBtn').addEventListener('click', function() {
            var hitosList = document.getElementById('hitosList');

            // Crear nuevo campo de "hito" y fechas
            var newHito = document.createElement('div');
            newHito.classList.add('d-flex', 'mb-2');

            newHito.innerHTML = `
            <input type="text" class="form-control me-2" name="hitos[]" placeholder="Ingrese hito" maxlength="250">
            <input type="date" class="form-control me-2" name="fecha_inicio[]" required>
            <input type="date" class="form-control me-2" name="fecha_fin[]" required>
            <button type="button" class="btn btn-danger btn-sm ms-2 removeHitoBtn">-</button>
        `;

            hitosList.appendChild(newHito);
        });

        // Función para eliminar un campo de hito
        document.getElementById('hitosList').addEventListener('click', function(event) {
            if (event.target.classList.contains('removeHitoBtn')) {
                var hitosList = document.getElementById('hitosList');
                var hitos = hitosList.getElementsByClassName('d-flex');

                // Asegurarse de que siempre quede al menos un campo
                if (hitos.length > 1) {
                    event.target.parentElement.remove();
                } else {
                    alert("Debe quedar al menos un hito.");
                }
            }
        });
    </script>
</body>

</html>
