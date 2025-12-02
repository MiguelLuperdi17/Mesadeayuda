<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<link href="{{ asset('/template/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('/template/vendors/choices/choices.min.css') }}" rel="stylesheet">

<style>
    .contenido-archivo {
        font-size: 16px; /* Tamaño de fuente más grande */
        overflow: auto; /* Permitir que el contenido se ajuste sin barras de desplazamiento */
        white-space: pre-wrap; /* Mantener el formato del texto */
    }

    .tabla-container {
        max-height: 400px; /* Altura máxima del contenedor */
        overflow-y: auto; /* Scroll vertical automático */
    }

    .my-table th,
    .my-table td {
        font-size: 12px; /* Ajusta el tamaño de la letra según tus preferencias */
    }
</style>
@include('layouts.tableStyle')
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <div class="container-fluid">
            @include('layouts.alerta')
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Distribución Claro</h2>
                </div>
                <div class="col-12 col-sm-auto">
                    <button class="btn-xs btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#miModal">Importar excel
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="miModal" tabindex="-1"
                     aria-labelledby="miModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <!-- Cambiado de modal-dialog a modal-xl -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="miModalLabel">Importar excel de Costos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="formArchivo" class="cliente"
                                      action="{{url('import_costos')}}"
                                      id="formArchivo" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Primer campo de selección -->
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="exampleTextarea">MES</label>
                                                    <select class="form-select select33"
                                                            name="mes"
                                                            id="mes"
                                                            data-choices="data-choices"
                                                            data-options='{"removeItemButton":true,"placeholder":true}'
                                                            required>
                                                        <option value="" selected disabled> seleccione un mes</option>
                                                        @foreach($meses as $mes)
                                                            <option value="{{$mes}}">{{$mes}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="formFileMultiple">
                                                        Seleccione su archivo
                                                    </label>
                                                    <input class="form-control" id="archivo"
                                                           name="archivo"
                                                           accept=".xlsx, .xls" type="file"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row col-md-6">
                                        </div> -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                Guardar
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (session('access_denied'))
                <script>
                    alert("No tienes permiso para acceder a esta página. Por favor, inicia sesión.");
                </script>
            @endif
            <br>
            <div class="px-3 mb-5">
                <div class="row justify-content-between">
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                        <span class="uil fs-3 lh-1 uil-envelope fas fa-fast-forward" style="color: green"></span>
                        <h1 class="fs-3 pt-3">23</h1>
                        <p class="fs--1 mb-0">Total de Impresoras</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
                        <span class="uil fs-3 lh-1 uil-envelope-upload far fa-edit" style="color: green"></span>
                        <h1 class="fs-3 pt-3">$2,105.00</h1>
                        <p class="fs--1 mb-0">B/N</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                        <span class="uil fs-3 lh-1 uil-envelopes fas fa-pencil-alt" style="color: green"></span>
                        <h1 class="fs-3 pt-3">$414.00</h1>
                        <p class="fs--1 mb-0">Color</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                        <span class="uil fs-3 lh-1 uil-envelope-open far fa-calendar-plus" style="color: green"></span>
                        <h1 class="fs-3 pt-3">$0.00</h1>
                        <p class="fs--1 mb-0">Excedente</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end border-end-xxl-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                        <span class="uil fs-3 lh-1 uil-envelope-open far fa-check-square" style="color: green"></span>
                        <h1 class="fs-3 pt-3">$2,519.00</h1>
                        <p class="fs--1 mb-0">Pago Total</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-start-xxl border-end-xxl pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                        <span class="uil fs-3 lh-1 uil-envelope-block fas fa-fast-backward" style="color: green"></span>
                        <h1 class="fs-3 pt-3">$0.00</h1>
                        <p class="fs--1 mb-0">Total Nov-2024</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body" style="min-height: 300px; width: 100%;">
                                <div class="echart-basic-bar-chart-example" id="barChart" style="min-height: 350px;
                                    width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body" style="min-height: 300px; width: 100%;">
                                <div class="echart-basic-bar-chart-example" id="barChart2" style="min-height: 350px;
                                    width: 100%;"></div>
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
                            <div class="card-body" style="min-height: 300px; width: 100%;">
                                <div class="echart-basic-bar-chart-example" id="barChart1" style="min-height: 350px;
                                    width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        @include('layouts.footer')
    </div>
    @extends('layouts.chat')
</main>
@extends('layouts.setting')

@extends('layouts.scripts')

<script src="{{ asset('/template/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('/template/vendors/choices/choices.min.js') }}"></script>
<script>
    function aprobar(ID) {
        // Aquí puedes hacer una solicitud AJAX para cambiar el estado en el servidor.
        fetch('{{url('aprobar_costo')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => {
                if (response.ok) {
                    // Si la aprobación es exitosa, eliminar la fila de la tabla.
                    document.getElementById('row-' + id).remove();
                } else {
                    alert('Error al aprobar el registro.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
<script>
    // Convertir los datos de PHP a JavaScript
    var nombres = @json($desc_meses);
    var valores = @json($monto_meses);

    // Extraer los nombres y los valores
    var categorias = Object.values(nombres);
    var datos = Object.values(valores);

    // Inicializar el gráfico
    var myChart = echarts.init(document.getElementById('barChart'));

    // Configuración del gráfico
    var option = {
        title: {
            text: 'Reporte mensual, últimos 6 meses'
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
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            myChart.resize();
        }, 100); // Esperar 100 ms antes de ajustar
    });
</script>
<script>
    // Convertir los datos de PHP a JavaScript
    var nombres = @json($ceco_d);
    var valores = @json($ceco_c);

    // Extraer los nombres y los valores
    var categorias = Object.values(nombres);
    var datos = Object.values(valores);

    // Inicializar el gráfico
    var myChart = echarts.init(document.getElementById('barChart1'));

    // Configuración del gráfico
    var option = {
        title: {
            text: 'Ceco con mayor gasto (8 Ceco)'
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
    window.addEventListener('resize', function () {
        myChart.resize();
    });
    // Usar la configuración especificada para mostrar el gráfico
    myChart.setOption(option);
</script>
<script>
    // Convertir los datos de PHP a JavaScript
    var nombres = @json($año_d);
    var valores = @json($año_c);

    // Extraer los nombres y los valores
    var categorias = Object.values(nombres);
    var datos = Object.values(valores);

    // Inicializar el gráfico
    var myChart = echarts.init(document.getElementById('barChart2'));

    // Configuración del gráfico
    var option = {
        title: {
            text: 'Reporte por Año'
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
    window.addEventListener('resize', function () {
        myChart.resize();
    });
    // Usar la configuración especificada para mostrar el gráfico
    myChart.setOption(option);
</script>
<script>
    // Convertir los datos de PHP a JavaScript
    var nombres = @json($desc_meses);
    var valores = @json($monto_meses);

    // Extraer los nombres y los valores
    var categorias = Object.values(nombres);
    var datos = Object.values(valores);

    // Inicializar el gráfico
    var myChart = echarts.init(document.getElementById('barChart3'));

    // Configuración del gráfico
    var option = {
        title: {
            text: 'Reporte por Año'
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
    window.addEventListener('resize', function () {
        myChart.resize();
    });
    // Usar la configuración especificada para mostrar el gráfico
    myChart.setOption(option);
</script>

<script>
    $(document).ready(function () {
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
            "order": [[2, 'desc']], // Ordenar por la tercera columna (0-indexado)
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]] // Menú de selección de registros por página
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
                alert("Archivo '" + file.name + "' no es válido. Solo se permiten archivos con las siguientes extensiones: .pdf, .docx, .xlsx, .xls");
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
        }).done(function (res) {
            var datos = JSON.parse(res);
            console.log(datos);

            // Construir el contenido del modal
            var contenidoModal = '<table class="table table-striped table-bordered" ><tbody><tr><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Fecha</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 20%">Usuario</th><th style="background: #2ba7081c; border: 1px solid #9fa6bc; width: 60%">Comentario</th></tr>';
            // var contenidoModal = '<h5>Editar Material - ' + datos[0].codigo + '</h5>';
            for (var x = 0; x < datos[0].length; x++) {
                contenidoModal += '<tr><td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x].fecha + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center;">' + datos[0][x].username + '</td>';
                contenidoModal += '<td style="border: 1px solid #9fa6bc; align-content: center; white-space: pre-line;">' + datos[0][x].comentario + '</td></tr>';
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
    document.addEventListener("DOMContentLoaded", function () {
        // Suponiendo que tienes una forma de verificar si el usuario está autenticado
        var isAuthenticated = {{$variable}}/* lógica para verificar autenticación */;

        if (!isAuthenticated) {
            alert("Tu sesión ha expirado o no tienes acceso a esta página.");
            window.location.href = "/login"; // Redirige a la página de inicio de sesión
        }
    });
</script>
</body>
</html>
