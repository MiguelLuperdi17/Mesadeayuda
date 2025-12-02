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
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between g-3 mb-4">
                    <div class="col-auto">
                        <h2 class="mb-0">Reportes Generales</h2>
                    </div>
                    <div class="col-auto">
                        <h2 class="mb-0">Fechas ({{ $startDate->format('Y-m-d') }} - {{ $endDate->format('Y-m-d') }})
                        </h2>
                    </div>
                </div>
                @if (session('access_denied'))
                    <script>
                        alert("No tienes permiso para acceder a esta página. Por favor, inicia sesión.");
                    </script>
                @endif
                <div class="px-3 mb-5">
                    <div class="row justify-content-between">
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                            <span class="uil fs-3 lh-1 uil-envelope fas fa-fast-forward" style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $Total }}</h1>
                            @php
                                use Carbon\Carbon;
                                $anio = Carbon::now()->year;
                            @endphp
                            <p class="fs--1 mb-0">Total de Tickets - {{$anio}}</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-upload far fa-edit" style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $pendientes->count() }}</h1>
                            <p class="fs--1 mb-0">Tickets Pendientes</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                            <span class="uil fs-3 lh-1 uil-envelopes fas fa-pencil-alt" style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $pendientes->wherenull('fecha_asignacion')->count() }}</h1>
                            <p class="fs--1 mb-0">Sin Asignar</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-open far fa-calendar-plus"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $creados->count() }}</h1>
                            <p class="fs--1 mb-0">Creados esta semana</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end border-end-xxl-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-open far fa-check-square"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $finalizados->count() }}</h1>
                            <p class="fs--1 mb-0">Cerrados esta semana</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-block fas fa-fast-backward"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">1757</h1>
                            <p class="fs--1 mb-0">Total Tickets 2024</p>
                        </div>
                    </div>
                </div>
                <form method="POST" class="row row-cols-lg-5 g-3 align-items-center"
                    action="{{ url('reportes_filtro') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12" style="text-align-last: center;">
                        <label class="form-label" for="timepicker2">Seleccione rango de fechas</label>
                    </div>
                    <div class="col-12">
                        <input class="form-control datetimepicker flatpickr-input" id="timepicker2" type="text"
                            placeholder="dd/mm/aaaa hasta dd/mm/aaaa"
                            data-options="{&quot;mode&quot;:&quot;range&quot;,&quot;dateFormat&quot;:&quot;d/m/y&quot;,&quot;disableMobile&quot;:true}"
                            readonly="readonly" name="rango">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                    </div>
                </form>
                <br>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body" style="min-height: 300px; width: 100%;">
                                <div class="echart-basic-bar-chart-example" id="barChart"
                                    style="min-height: 350px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                <h4 style="font-weight: 900">Ver detalle de tickets pendientes por Analista</h4>

                                <div class="table-responsive table-reponsive-sm scrollbar">
                                    <table class="table table-striped table-bordered"
                                        style="min-height: 310px; text-align: center; vertical-align: middle;">
                                        <thead>
                                            <tr style="background: #2ba708;">
                                                <th scope="col" style="font-weight: 700">ANALISTA</th>
                                                <th scope="col" style="font-weight: 700">CANTIDAD</th>
                                                <th scope="col" style="font-weight: 700">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user_pendiente as $username => $username_f)
                                                <tr>
                                                    <td>{{ $username }}</td>
                                                    <td>{{ $cantidada_pendiente[$username] }}</td>
                                                    <td style="text-align: center;">
                                                        <form method="POST" name="formComentario" target="_blank"
                                                            action="{{ url('pendientes') }}" id="formComentario"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="username"
                                                                value="{{ $username }}">
                                                            <button class="btn btn-success" style="width: 50%;"
                                                                type="submit">Ver
                                                            </button>
                                                        </form>
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
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="echart-basic-bar-chart-example" id="barChart2"
                                    style="min-height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                <h3>Pendientes según tipo de atención Incidencia / Requerimiento</h3>
                                <br>
                                <div class="accordion" id="accordionExample">
                                    @if ($primer_I)
                                        <div class="accordion-item border-top border-300">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    Ticket pendiente del tipo incidente con mayor tiempo
                                                    - {{ $primer_I->codigo }}
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapseOne"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body pt-0">
                                                    <strong>Fecha de Asignación /
                                                        Analista: </strong>{{ $primer_I->fecha_asignacion }}
                                                    / {{ $primer_I->user->username }}<br>
                                                    <strong>Usuario:
                                                    </strong>{{ $primer_I->usercreador->username }}<br>
                                                    <strong>Requerimiento:
                                                    </strong>{{ $primer_I->atencion->nombre }}<br>
                                                    <strong>Detalle: </strong>{{ $primer_I->detalle }}<br>
                                                    <strong>Tiempo de atención
                                                        esperado: </strong>{{ $primer_I->atencion->atencion }}D<br>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Ticket pendiente del tipo requerimiento con mayor tiempo
                                                - {{ $primer_R->codigo }}
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse" id="collapseTwo"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pt-0">
                                                <strong>Fecha de Asignación /
                                                    Analista: </strong>{{ $primer_R->fecha_asignacion }}
                                                / {{ $primer_R->user->username }}<br>
                                                <strong>Usuario: </strong>{{ $primer_R->usercreador->username }}<br>
                                                <strong>Requerimiento: </strong>{{ $primer_R->atencion->nombre }}<br>
                                                <strong>Detalle: </strong>{{ $primer_R->detalle }}<br>
                                                <strong>Tiempo de atención
                                                    esperado: </strong>{{ $primer_R->atencion->atencion }}D<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                {{--                                <h3>Tickets Pendientes por Analista</h3> --}}
                                <div class="echart-basic-bar-chart-example" id="barChart3"
                                    style="min-height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                <h4 style="font-weight: 900">Ver detalle de tickets finalizados por Analista (Incidentes)</h4>

                                <div class="table-responsive table-reponsive-sm scrollbar">
                                    <table class="table table-striped table-bordered"
                                        style="min-height: 310px; text-align: center; vertical-align: middle;">
                                        <thead>
                                            <tr style="background: #2ba708; vertical-align: middle;">
                                                <th scope="col" style="font-weight: 700; width: 17.5%">ANALISTA
                                                </th>
                                                <th scope="col" style="font-weight: 700; width: 17.5%">SOLUC.</th>
                                                <th scope="col" style="font-weight: 700; width: 20%">TICKET <br>
                                                    SUPERA <br> SLA</th>
                                                <th scope="col" style="font-weight: 700; width: 20%">DÍAS <br>
                                                    SUPERA <br> SLA</th>
                                                <th scope="col" style="font-weight: 700; width: 25%">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user_fin as $username => $username_fin)
                                                <tr>
                                                    <td>{{ $username }}</td>
                                                    <td>{{ $cantidad_fin[$username] }}</td>
                                                    <td>{{ $slacount_fin[$username] }}</td>
                                                    <td>{{ $sla_fin[$username] }}</td>
                                                    <td style="text-align: center;">
                                                        <form method="POST" name="formComentario"
                                                            action="{{ url('finalizados') }}" id="formComentario"
                                                            enctype="multipart/form-data" target="_blank">
                                                            @csrf
                                                            <input type="hidden" name="username"
                                                                value="{{ $username }}">
                                                            <input type="hidden" name="inicio"
                                                                value="{{ $startDate }}">
                                                            <input type="hidden" name="fin"
                                                                value="{{ $endDate }}">
                                                            <button class="btn btn-success" style="width: 50%;"
                                                                type="submit"
                                                                @if ($slacount_fin[$username] == 0) disabled @endif>Ver
                                                            </button>
                                                        </form>
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
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body" style="min-height: 500px; width: 100%;">
                                <div id="barChart5" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
        </div>
        @extends('layouts.chat')
    </main>
    @extends('layouts.setting')

    @extends('layouts.scripts')

    <script src="{{ asset('/template/vendors/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/flatpickr.js') }}"></script>
    <script>
        // Convertir los datos de PHP a JavaScript
        var nombres = @json($user_pendiente);   // Nombre de los analistas
        var valores = @json($cantidada_pendiente); // Cantidades pendientes

        // Extraer los nombres y los valores
        var categoriasPendientes = Object.values(nombres);
        var datos = Object.values(valores);

        // Verifica que los datos de los analistas y cantidades no estén vacíos
        console.log('Categorias Pendientes:', categoriasPendientes);
        console.log('Datos de Cantidades Pendientes:', datos);

        var semanas = @json($semanas);
        var ticketsPorAnalista = @json($ticketsPorAnalista);
        var analistas = Object.keys(ticketsPorAnalista);

        // Inicializamos los arreglos para las semanas
        var categoriasSemana = [];
        var valoresSemana1 = [];
        var valoresSemana2 = [];
        var valoresSemana3 = [];

        analistas.forEach(function(analista) {
            categoriasSemana.push(analista);
            valoresSemana1.push(ticketsPorAnalista[analista]['Semana 1'] ? ticketsPorAnalista[analista]['Semana 1'].length : 0);
            valoresSemana2.push(ticketsPorAnalista[analista]['Semana 2'] ? ticketsPorAnalista[analista]['Semana 2'].length : 0);
            valoresSemana3.push(ticketsPorAnalista[analista]['Semana 3'] ? ticketsPorAnalista[analista]['Semana 3'].length : 0);
        });

        // Verifica los datos de las semanas
        console.log('Categorias Semana:', categoriasSemana);
        console.log('Valores Semana 1:', valoresSemana1);
        console.log('Valores Semana 2:', valoresSemana2);
        console.log('Valores Semana 3:', valoresSemana3);

        // Gráfico horizontal (barChart5)
        var myChart5 = echarts.init(document.getElementById('barChart5'));
        var option5 = {
            title: {
                text: 'Tickets finalizados por Analista (3 últimas semanas)'
            },
            tooltip: {},
            xAxis: {
                type: 'value',
            },
            yAxis: {
                type: 'category',
                data: categoriasSemana,
                axisLabel: {
                    rotate: 45  // Rota las etiquetas 45 grados
                }
            },
            series: [
                {
                    name: 'Semana 1',
                    type: 'bar',
                    data: valoresSemana1,
                    itemStyle: {
                        color: '#4CAF50'
                    }
                },
                {
                    name: 'Semana 2',
                    type: 'bar',
                    data: valoresSemana2,
                    itemStyle: {
                        color: '#FF9800'
                    }
                },
                {
                    name: 'Semana 3',
                    type: 'bar',
                    data: valoresSemana3,
                    itemStyle: {
                        color: '#2196F3'
                    }
                }
            ]
        };
        myChart5.setOption(option5);

        // Verifica que el gráfico horizontal se ha creado
        console.log('Gráfico Horizontal Creado');

        // Gráfico vertical (barChart)
        var myChart = echarts.init(document.getElementById('barChart'));

        var option = {
            title: {
                text: 'Tickets Pendientes por Analista'
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: categoriasPendientes
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                name: 'Cantidad',
                type: 'bar',
                data: datos,
                itemStyle: {
                    color: '#4CAF50'
                }
            }]
        };
        myChart.setOption(option);

        // Verifica que el gráfico vertical se ha creado
        console.log('Gráfico Vertical Creado');

        // Redimensionar gráficos cuando la ventana cambie de tamaño
        myChart.resize();
        myChart5.resize();

        // Redimensionar inmediatamente cuando cambie el tamaño de la ventana
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                myChart.resize();
                myChart5.resize();
            }, 100);
        });

        // Verifica que los gráficos se redimensionan correctamente
        console.log('Redimensionamiento de gráficos habilitado');
    </script>
    <script>
        // Convertir los datos de PHP a JavaScript
        var nombres = @json($tipo);
        var valores = @json($cantidad_tipo);

        // Extraer los nombres y los valores
        var categorias = Object.values(nombres);
        var datos = Object.values(valores);

        // Inicializar el gráfico
        var myChart = echarts.init(document.getElementById('barChart2'));

        // Configuración del gráfico
        var option = {
            title: {
                text: 'Tickets Pendientes de atención Incidencia / Requerimiento'
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: categorias
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                name: 'Cantidad',
                type: 'bar',
                data: datos,
                itemStyle: {
                    color: '#4CAF50' // Color de las barras
                }
            }]
        };
        window.addEventListener('resize', function() {
            myChart.resize();
        });
        // Usar la configuración especificada para mostrar el gráfico
        myChart.setOption(option);
    </script>
    <script>
        // Convertir los datos de PHP a JavaScript
        var nombres = @json($user_fin);
        var valores = @json($cantidad_fin);

        // Extraer los nombres y los valores
        var categorias = Object.values(nombres);
        var datos = Object.values(valores);

        // Inicializar el gráfico
        var myChart = echarts.init(document.getElementById('barChart3'));

        // Configuración del gráfico
        var option = {
            title: {
                text: 'Tickets Finalizados en la última semana'
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: categorias
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                name: 'Cantidad',
                type: 'bar',
                data: datos,
                itemStyle: {
                    color: '#4CAF50' // Color de las barras
                }
            }]
        };
        window.addEventListener('resize', function() {
            myChart.resize();
        });
        // Usar la configuración especificada para mostrar el gráfico
        myChart.setOption(option);
    </script>
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
</body>

</html>
