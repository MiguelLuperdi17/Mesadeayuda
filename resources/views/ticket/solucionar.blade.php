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
                        <h2 class="mb-0">Añadir Solución</h2>
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
                                        <div class="table-responsive">
                                            @if (session('success'))
                                                <div class="alert alert-soft-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Modal -->
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
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                        <td style="border: 1px solid #9fa6bc;">Hola</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <table id="users-table" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                            Ticket
                                                        </th>
                                                        <th
                                                            style="width: 5%;vertical-align: middle;text-align: -webkit-center;">
                                                            Fecha
                                                        </th>
                                                        <th style="width: 35%">Detalle</th>
                                                        <th style="width: 15%">Estado</th>
                                                        <th style="width: 20%">Comentarios</th>
                                                        {{--                                                <th style="width: 10%">Acciones</th> --}}
                                                        <!-- Agrega más columnas según tus necesidades -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tickets as $ticket)
                                                        <tr>
                                                            <td
                                                                style="vertical-align: middle;text-align: -webkit-center;">
                                                                {{ $ticket->codigo }}</td>
                                                            <td
                                                                style="vertical-align: middle;text-align: -webkit-center;">
                                                                @php
                                                                    $fecha = date(
                                                                        'Y-m-d',
                                                                        strtotime($ticket->fecha_creacion),
                                                                    );
                                                                    $hora = date(
                                                                        'H:i:s',
                                                                        strtotime($ticket->fecha_creacion),
                                                                    );
                                                                @endphp
                                                                {{ $fecha }}<br>{{ $hora }}</td>
                                                            <td style="vertical-align: middle;">
                                                                <br>
                                                                {{--                                                        <font style="font-weight: 900">Usuario: </font> --}}
                                                                {{--                                                        <br> --}}
                                                                <font style="font-weight: 900">Usuario: </font>
                                                                {{ $ticket->usercreador->username }}
                                                                <br>
                                                                <font style="font-weight: 900">Categoría: </font>
                                                                {{ $ticket->atencion->servicio->categoria->nombre }}
                                                                <br>
                                                                <font style="font-weight: 900">Servicio: </font>
                                                                {{ $ticket->atencion->servicio->nombre }}
                                                                <br>
                                                                <font style="font-weight: 900">Requerimiento/Incidente:
                                                                </font>
                                                                <br>
                                                                {!! wordwrap($ticket->atencion->nombre, 80, "<br>\n", false) !!}
                                                                <br>
                                                                <font style="font-weight: 900">Creado: </font>
                                                                {{ $ticket->fecha_creacion }}
                                                                @if ($ticket->aprobadores->count())
                                                                    <br>
                                                                    <font style="font-weight: 900">Aprobaciones: </font>
                                                                    @foreach ($ticket->aprobadores as $aprobador)
                                                                        @if ($aprobador->estado == 'A')
                                                                            <span
                                                                                class="badge badge-phoenix badge-phoenix-success">{{ $aprobador->user->username }}</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-phoenix badge-phoenix-danger">{{ $aprobador->user->username }}</span>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <br><br>
                                                                <font style="font-weight: 900">Detalle: </font>
                                                                <br>
                                                                {!! wordwrap($ticket->detalle, 80, "<br>\n", false) !!}
                                                                @if ($ticket->adjuntos->count() > 0)
                                                                    <br><br>
                                                                    <font style="font-weight: 900">Adjuntos: </font>
                                                                    <br>
                                                                    @foreach ($ticket->adjuntos as $adjunto)
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
                                                                <br><br>

                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                {{--                                                        <font style="font-weight: 900">Usuario: </font> --}}
                                                                {{--                                                        <br> --}}
                                                                <font style="font-weight: 900">Estado: </font>
                                                                @if ($ticket->estado == 'P')
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-warning">Sin
                                                                        Asignar</span>
                                                                @elseif($ticket->estado == 'A')
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-info">En
                                                                        Proceso</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-success">Finalizado</span>
                                                                @endif
                                                                <br>
                                                                <font style="font-weight: 900">Tiempo de atención:
                                                                </font>{{ $ticket->atencion->atencion }}D
                                                                <br>
                                                                <font style="font-weight: 900">Analista
                                                                    asignado: </font>
                                                                {{ $ticket->user ? $ticket->user->username : '' }}
                                                                <br>
                                                                <font style="font-weight: 900">Fecha de asignación: <br>
                                                                </font>{{ $ticket->fecha_asignacion }}
                                                                <br>
                                                                <form method="POST" name="formComentario"
                                                                    class="row-cols-lg-5 g-3"
                                                                    action="{{ url('crear_comentario') }}"
                                                                    id="formComentario" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="ticket_id"
                                                                        value="{{ $ticket->id }}">
                                                                    <div class="form-floating" style="width: 100%">
                                                                        <textarea class="form-control" id="floatingTextarea2" name="comentario" placeholder="Registrar Comentario"
                                                                            style="height: 75px" maxlength="200" required></textarea>
                                                                        <label for="floatingTextarea2">Registrar
                                                                            Comentario</label>
                                                                    </div>
                                                                    <div class="col-12" style="width: 100%">
                                                                        <button class="btn btn-primary"
                                                                            style="width: 100%" type="submit">Guardar
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td
                                                                style="vertical-align: middle; text-align: -webkit-center;">
                                                                <table>
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
                                                                        @foreach ($ticket->comentarios->take(3) as $comentarios)
                                                                            <tr>
                                                                                <td style="border: 1px solid #9fa6bc;">
                                                                                    {{ $comentarios->fecha }}</td>
                                                                                <td style="border: 1px solid #9fa6bc;">
                                                                                    {{ $comentarios->user->username }}
                                                                                </td>
                                                                                <td style="border: 1px solid #9fa6bc;"
                                                                                    title="{{ $comentarios->comentario }}">
                                                                                    {{ str_limit_custom($comentarios->comentario, 30) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                @if ($ticket->comentarios->count() > 3)
                                                                    <br>
                                                                    {{--                                                            <button class="btn-xs btn btn-success" --}}
                                                                    {{--                                                                    data-bs-toggle="modal" --}}
                                                                    {{--                                                                    onclick="cargarDatos({{$ticket->id}})" --}}
                                                                    {{--                                                                    >Ver todos los --}}
                                                                    {{--                                                                comentarios --}}
                                                                    {{--                                                            </button> --}}
                                                                    <form method="POST">
                                                                        <input type="hidden"
                                                                            value="{{ csrf_token() }}"
                                                                            name="_token" id="token">
                                                                        <a data-toggle="modal" title="MisComentarios"
                                                                            data-target="#MisComentarios">
                                                                            <input
                                                                                onclick="cargarDatos({{ $ticket->id }})"
                                                                                type="button"
                                                                                class="btn btn-success btn-sm"
                                                                                id="Editar"
                                                                                value="Ver todos los comentarios">
                                                                        </a>
                                                                    </form>
                                                                @endif
                                                                <br>
                                                                @if ($ticket->atencion->tipo == 'I')
                                                                <div class="col-md-7">
                                                                    <select class="form-select" id="inputState"
                                                                        disabled>
                                                                        <option selected="selected">-- Lista de
                                                                            Incidentes --</option>
                                                                        <option>Verificar Lista</option>
                                                                        <option>Bloquear según opción</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                    <button class="btn btn-primary btn-cerrar-ticket"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#miModal"
                                                                        data-user="{{ $ticket->usercreador->username }}"
                                                                        data-ticket-id="{{ $ticket->id }}"
                                                                        data-atencion-id="{{ $ticket->atencion_id }}">
                                                                        Cerrar ticket
                                                                    </button>
                                                                @else
                                                                <form method="POST" name="formComentario"
                                                                    class="row g-3"
                                                                    action="{{ url('cerrar_ticket') }}"
                                                                    id="formComentario" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="ticket_id"
                                                                        value="{{ $ticket->id }}">
                                                                    <div class="col-md-5" style="align-self: center;">
                                                                        <label class="form-label" for="inputCity">Tipo
                                                                            incidente:
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <select class="form-select" id="inputState"
                                                                            disabled>
                                                                            <option selected="selected">-- Lista de
                                                                                Incidentes --</option>
                                                                            <option>Verificar Lista</option>
                                                                            <option>Bloquear según opción</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <button class="btn btn-primary"
                                                                            type="submit">Cerrar ticket
                                                                        </button>
                                                                    </div>
                                                                </form>
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
                <!-- Modal global reutilizable -->
                <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="formSolucion" method="POST" action="/cerrar_incidentes">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">Registrar Solución</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="ticket_id" name="ticket_id">

                                    <!-- Seleccionar Equipo -->
                                    <div class="mb-3">
                                        <label for="sub_select" class="form-label">Equipo</label>
                                        <select id="sub_select" name="equipo_id" class="form-select" required>
                                            <option value="">Seleccione un equipo</option>
                                        </select>
                                    </div>

                                    <!-- Seleccionar Solución Existente -->
                                    <div class="mb-3">
                                        <label for="solucion_select" class="form-label">Solución Existente</label>
                                        <select id="solucion_select" name="solucion_existente" class="form-select">
                                            <option value="">Seleccione una solución existente</option>
                                        </select>
                                    </div>

                                    <!-- Nueva Solución -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="nueva_solucion">
                                        <label class="form-check-label" for="nueva_solucion">
                                            Registrar una nueva solución
                                        </label>
                                    </div>

                                    <!-- Título -->
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título de la Solución</label>
                                        <input type="text" id="titulo" name="titulo" class="form-control"
                                            placeholder="Ingrese título" disabled>
                                    </div>

                                    <!-- Detalle con CKEditor -->
                                    <div class="mb-3">
                                        <label for="editor1" class="form-label">Detalle de la Solución</label>
                                        <textarea id="editor1" name="editor1"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
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
        let editorDetalle; // Instancia global de CKEditor

        document.addEventListener('DOMContentLoaded', function() {
            const miModal = document.getElementById('miModal');
            const selectEquipos = document.getElementById('sub_select');
            const selectSoluciones = document.getElementById('solucion_select');
            const tituloInput = document.getElementById('titulo');
            const checkNueva = document.getElementById('nueva_solucion');
            const ticketInput = document.getElementById('ticket_id');

            // Inicializar CKEditor
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .then(editor => {
                    editorDetalle = editor;
                    editor.enableReadOnlyMode('bloqueoInicial'); // Bloquear al iniciar
                })
                .catch(error => console.error(error));

            // --- Cuando se abre el modal
            miModal.addEventListener('show.bs.modal', async function(event) {
                const button = event.relatedTarget;
                const usuario = button.getAttribute('data-user');
                const atencionId = button.getAttribute('data-atencion-id');
                const ticketId = button.getAttribute('data-ticket-id');
                ticketInput.value = ticketId;

                // Reset de campos
                selectEquipos.innerHTML = '<option value="">Seleccione un equipo</option>';
                selectSoluciones.innerHTML =
                    '<option value="">Seleccione una solución existente</option>';
                tituloInput.value = '';
                editorDetalle.setData('');
                tituloInput.disabled = true;
                editorDetalle.enableReadOnlyMode('bloqueoModal');
                checkNueva.checked = false;

                // --- Cargar equipos
                try {
                    const resEquipos = await fetch(`/equipos-usuario/${usuario}`);
                    const equipos = await resEquipos.json();

                    if (equipos.length === 0) {
                        const opt = document.createElement('option');
                        opt.text = 'No se encontraron equipos';
                        opt.disabled = true;
                        selectEquipos.appendChild(opt);
                    } else {
                        equipos.forEach(eq => {
                            const opt = document.createElement('option');
                            opt.value = eq.id;
                            opt.text = eq.nombre_equipo;
                            selectEquipos.appendChild(opt);
                        });
                    }
                } catch (error) {
                    console.error('Error cargando equipos:', error);
                }

                // --- Cargar soluciones
                try {
                    const resSol = await fetch(`/soluciones-atencion/${atencionId}`);
                    const soluciones = await resSol.json();

                    if (soluciones.length === 0) {
                        const opt = document.createElement('option');
                        opt.text = 'No hay soluciones registradas';
                        opt.disabled = true;
                        selectSoluciones.appendChild(opt);
                    } else {
                        soluciones.forEach(sol => {
                            const opt = document.createElement('option');
                            opt.value = sol.id;
                            opt.text = sol.titulo;
                            selectSoluciones.appendChild(opt);
                        });
                    }
                } catch (error) {
                    console.error('Error cargando soluciones:', error);
                }
            });

            // --- Al seleccionar una solución existente
            selectSoluciones.addEventListener('change', async function() {
                const solucionId = this.value;
                if (!solucionId) return;

                try {
                    const res = await fetch(`/soluciones-atencion/detalle/${solucionId}`);
                    const sol = await res.json();

                    tituloInput.value = sol.titulo;
                    editorDetalle.setData(sol.descripcion || '');
                    tituloInput.disabled = true;
                    editorDetalle.enableReadOnlyMode('bloqueoSeleccion');
                    checkNueva.checked = false;
                } catch (error) {
                    console.error('Error obteniendo detalle:', error);
                }
            });

            // --- Al marcar "Nueva solución"
            checkNueva.addEventListener('change', function() {
                if (this.checked) {
                    // Habilitar campos
                    tituloInput.disabled = false;

                    // Eliminar todos los bloqueos previos de solo lectura
                    editorDetalle.disableReadOnlyMode('bloqueoSeleccion');
                    editorDetalle.disableReadOnlyMode('bloqueoModal');
                    editorDetalle.disableReadOnlyMode('bloqueoInicial');

                    // Limpiar campos
                    tituloInput.value = '';
                    editorDetalle.setData('');
                    selectSoluciones.value = '';
                } else {
                    // Desactivar edición nuevamente
                    tituloInput.disabled = true;
                    editorDetalle.enableReadOnlyMode('bloqueoSeleccion');
                }
            });

            // --- Antes de enviar el formulario
            const form = document.getElementById('formSolucion');
            if (form) {
                form.addEventListener('submit', function() {
                    const detalleHidden = document.createElement('input');
                    detalleHidden.type = 'hidden';
                    detalleHidden.name = 'detalle';
                    detalleHidden.value = editorDetalle.getData();
                    form.appendChild(detalleHidden);
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
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
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' + // Ajuste aquí para la parte superior izquierda
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12"p>>',
                "pagingType": "simple_numbers",
                "order": [
                    [2, 'desc']
                ], // Ordenar por la tercera columna (0-indexado)
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ] // Menú de selección de registros por página
            });
        });
    </script>
    <script>
        function limitarNumeroArchivos(event) {
            var input = event.target;
            // Obtener la cantidad de archivos seleccionados
            var files = input.files;
            if (files.length > 3) {
                alert("Solo se pueden seleccionar hasta 3 archivos");
                // Limpiar la selección de archivos
                input.value = '';
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
                    contenidoModal += '<tr><td style="border: 1px solid #9fa6bc;">' + datos[0][x].fecha + '</td>';
                    contenidoModal += '<td style="border: 1px solid #9fa6bc;">' + datos[0][x].username + '</td>';
                    contenidoModal += '<td style="border: 1px solid #9fa6bc;">' + datos[0][x].comentario +
                        '</td></tr>';
                }
                contenidoModal += '</tbody></table>';

                // Agregar contenido al modal
                $('#comentarios').html(contenidoModal);

                // Abrir el modal
                $('#MisComentarios').modal('show');
            });
        }
    </script>

</body>

</html>
