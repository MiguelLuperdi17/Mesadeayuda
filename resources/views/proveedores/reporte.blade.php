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
                        <h2 class="mb-0">Fecha: 05-03-2025
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
                            <h1 class="fs-3 pt-3">{{ $pendientes->where('estado',3)->count()}}</h1>
                            <p class="fs--1 mb-0">Superan el SLA</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-open far fa-calendar-plus"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $creados }}</h1>
                            <p class="fs--1 mb-0">Creados esta semana</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end border-end-xxl-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-open far fa-check-square"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">{{ $cerrados }}</h1>
                            <p class="fs--1 mb-0">Cerrados esta semana</p>
                        </div>
                        <div
                            class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                            <span class="uil fs-3 lh-1 uil-envelope-block fas fa-fast-backward"
                                style="color: green"></span>
                            <h1 class="fs-3 pt-3">342</h1>
                            <p class="fs--1 mb-0">Total Tickets 2024</p>
                        </div>
                    </div>
                </div>

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
                                                            action="{{ url('pendientes_proveedores') }}" id="formComentario"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="tipo"
                                                                value="analista">
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
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="exampleTextarea">Proveerdor</label>
                                    <select class="form-select select33"
                                        name="proveedor" id="proveedor"
                                        data-choices="data-choices"
                                        data-options='{"removeItemButton":true,"placeholder":true}'
                                        required>
                                        <option value="1" selected>
                                            Rivercon</option>
                                    </select>
                                    <!-- <select class="form-select" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'> -->
                                </div>
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
                                <h3>Los 4 Tickets más antiguos</h3>
                                <br>
                                <div class="accordion" id="accordionExample">
                                    @php
                                        $sum = 1;
                                    @endphp
                                    @foreach ($pendientes->take(4) as $pendien)
                                    @if ($sum == 1)
                                    <div class="accordion-item border-top border-300">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{$sum}}"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Ticket de Requerimiento de Soporte LAREDO2025-00{{ $pendien->correlativo }}</td>
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse show" id="collapse{{$sum}}"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pt-0">
                                                <strong>Fecha de Creación: </strong>{{$pendien->fecha_creacion}}<br>
                                                <strong>Usuario: </strong>{{$pendien->user->username}}<br>
                                                <strong>Detalle: </strong>{{$pendien->descripcion}}
                                                <br>
                                                <strong>Tiempo de atención esperado: </strong>
                                                {{ $pendien->sla_id * 8 }} Horas.<br>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{$sum}}"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Ticket de Requerimiento de Soporte LAREDO2025-00{{ $pendien->correlativo }}</td>
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse" id="collapse{{$sum}}"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pt-0">
                                                <strong>Fecha de Creación: </strong>{{$pendien->fecha_creacion}}<br>
                                                <strong>Usuario: </strong>{{$pendien->user->username}}<br>
                                                <strong>Detalle: </strong>{{$pendien->descripcion}}
                                                <br>
                                                <strong>Tiempo de atención esperado: </strong>
                                                {{ $pendien->sla_id * 8 }} Horas.<br>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @php
                                        $sum = $sum+1;
                                    @endphp
                                    @endforeach
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
                                <h4 style="font-weight: 900">Pendientes y superados el SLA</h4>

                                <div class="table-responsive table-reponsive-sm scrollbar">
                                    <table class="table table-striped table-bordered"
                                        style="min-height: 310px; text-align: center; vertical-align: middle;">
                                        <thead style="width: 100%">
                                            <tr style="background: #2ba708">
                                                <th scope="col" style="font-weight: 700">PROV.</th>
                                                <th scope="col" style="font-weight: 700">PEND.</th>
                                                <th scope="col" style="font-weight: 700">SUPERA <BR> SLA</th>
                                                <th scope="col" style="font-weight: 700">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                    <td>Rivercon</td>
                                                    <td>{{ $pendientes->count() }}</td>
                                                    <td>{{ $pendientes->where('estado',3)->count() }}</td>
                                                    <td style="text-align: center;">
                                                        <form method="POST" name="formComentario" target="_blank"
                                                            action="{{ url('pendientes_proveedores') }}" id="formComentario"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="tipo"
                                                                value="sla">
                                                            <input type="hidden" name="username"
                                                                value="Rivercon">
                                                            <button class="btn btn-success" style="width: 50%;"
                                                                type="submit">Ver
                                                            </button>
                                                        </form>
                                                    </td>
                                            </tr>
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
                            <div class="card-body">
                                <h4 style="font-weight: 900">Tickets resueltos por Proveedor y tiempo promedio</h4>

                                <div class="table-responsive table-reponsive-sm scrollbar">
                                    <table class="table table-striped table-bordered"
                                        style="min-height: 310px; text-align: center; vertical-align: middle;">
                                        <thead style="width: 100%">
                                            <tr style="background: #2ba708">
                                                <th scope="col" style="font-weight: 700; width: 25%">PROVEEDOR</th>
                                                <th scope="col" style="font-weight: 700; width: 25%">RESUELTO</th>
                                                <th scope="col" style="font-weight: 700; width: 25%">T. PROM,</th>
                                                <th scope="col" style="font-weight: 700; width: 25%">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                    <td>Rivercon</td>
                                                    <td>{{ $Total - $pendientes->count() }}</td>
                                                    <td>{{ number_format($promedio, 2)}} horas</td>
                                                    <td style="text-align: center;">
                                                        <form method="POST" name="formComentario" target="_blank"
                                                            action="{{ url('pendientes_proveedores') }}" id="formComentario"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="tipo"
                                                                value="resuelto">
                                                            <input type="hidden" name="username"
                                                                value="Rivercon">
                                                            <button class="btn btn-success" style="width: 50%;"
                                                                type="submit">Ver
                                                            </button>
                                                        </form>
                                                    </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
        var nombres = @json($user_pendiente);
        var valores = @json($cantidada_pendiente);

        // Extraer los nombres y los valores
        var categorias = Object.values(nombres);
        var datos = Object.values(valores);

        // Inicializar el gráfico
        var myChart = echarts.init(document.getElementById('barChart'));

        // Configuración del gráfico
        var option = {
            title: {
                text: 'Tickets Pendientes por Analista'
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
        myChart.setOption(option);

        // Ajustar el tamaño inmediatamente al cargar
        myChart.resize();

        // Redimensionar inmediatamente cuando cambie el tamaño de la ventana
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                myChart.resize();
            }, 100); // Esperar 100 ms antes de ajustar
        });
    </script>
    <script>
        var nombres = @json($categoria_pendiente);
        var valores = @json($cant_cat_pendiente );
        var categorias = Object.values(nombres); // Obtener los valores de las categorías
        var datos = Object.values(valores);  // Obtener los valores de los datos
        var myChart = echarts.init(document.getElementById('barChart2'));
        var option = {
            title: {
                text: 'Reporte por Categoría',  // Título del gráfico
                subtext: '',  // Subtítulo
                left: 'center'  // Centrar el título
            },
            tooltip: {
                trigger: 'item',  // Mostrar tooltip cuando se pasa sobre una porción del gráfico
                formatter: '{a} <br/>{b}: {c} ({d}%)'  // Formato del tooltip
            },
            legend: {
                orient: 'vertical',  // Leyenda en formato vertical
                left: 'left',  // Colocar la leyenda a la izquierda
                data: categorias  // Los nombres de las categorías para la leyenda
            },
            series: [{
                name: 'Cantidad',  // Nombre de la serie (aparece en el tooltip y la leyenda)
                type: 'pie',  // Tipo de gráfico: torta (pie)
                radius: '55%',  // Radio del gráfico de torta
                center: ['50%', '60%'],  // Centrar el gráfico de torta en la página
                data: categorias.map((categoria, index) => ({
                    value: datos[index],  // El valor asociado a la categoría
                    name: categoria  // El nombre de la categoría (año o similar)
                })),
                itemStyle: {
                    borderRadius: 10,  // Bordes redondeados
                    borderColor: '#fff',  // Color del borde (blanco)
                    borderWidth: 2  // Ancho del borde
                }
            }]
        };

        // Evento para redimensionar el gráfico cuando la ventana cambie de tamaño
        window.addEventListener('resize', function () {
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
