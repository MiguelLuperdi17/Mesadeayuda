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
                                        <div class="modal fade" id="editarMaterialModal" tabindex="-1"
                                             aria-labelledby="editarMaterialLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editarMaterialLabel">Editar
                                                            Material</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="modalContent">
                                                            <!-- Aquí se cargarán los datos del material -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <br>
                                            <table class="table table-bordered" id="materiales-table">
                                                <thead>
                                                <tr>
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
                                                </tr>
                                                </thead>
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
    $(document).ready(function () {
        $('#materiales-table').DataTable({
            "serverSide": true,
            "ajax": "{{ route('materiales.index') }}",
            "columns": [
                {"data": "codigo", "name": "codigo"},
                {
                    "data": "nro_parte",
                    "name": "nro_parte",
                    "render": function (data, type, row) {
                        if (type === 'display') {
                            return '<div title="' + data + '">' + (data.length > 27 ? data.substr(0, 27) + '...' : data) + '</div>';
                        }
                        return data;
                    }
                },
                {
                    "data": "descripcion",
                    "name": "descripcion",
                    "render": function (data, type, row) {
                        if (type === 'display') {
                            return '<div title="' + data + '">' + (data.length > 27 ? data.substr(0, 27) + '...' : data) + '</div>';
                        }
                        return data;
                    }
                },
                {"data": "um", "name": "um"},
                {
                    "data": "familia",
                    "name": "familia",
                    "render": function (data, type, row) {
                        if (type === 'display') {
                            return '<div title="' + data + '">' + (data.length > 12 ? data.substr(0, 12) + '...' : data) + '</div>';
                        }
                        return data;
                    }
                },
                {"data": "sub_familia", "name": "sub_familia"},
                {
                    "data": "grupo",
                    "name": "grupo",
                    "render": function (data, type, row) {
                        if (type === 'display') {
                            return '<div title="' + data + '">' + (data.length > 12 ? data.substr(0, 12) + '...' : data) + '</div>';
                        }
                        return data;
                    }
                },
                {"data": "costo_unitario", "name": "costo_unitario"},
                {
                    "data": "estado",
                    "name": "estado",
                    "render": function (data, type, row) {
                        if (type === 'display') {
                            if (data == 1) {
                                return '<h6 style="color:green;">Activo</h6>';
                            } else {
                                return '<h6 style="color:red;">Inactivo</h6>';
                            }
                        }
                        return data;
                    }
                },
                {"data": "action", "name": "action", "orderable": false, "searchable": false}
            ],
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
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"t>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "pagingType": "simple_numbers"
        });
    });
</script>
<script>
    function cargarDatos(id) {
        console.log(id);

        // Limpiar contenido anterior
        $('#modalContent').html('');

        // Realizar la solicitud AJAX
        $.ajax({
            url: '{{ url('material_editar') }}', // Ajusta la URL según tu configuración
            method: 'POST',
            data: {
                id_material: id,
                _token: '{{ csrf_token() }}' // Obtener el token CSRF de manera adecuada
            }
        }).done(function (res) {
            var datos = JSON.parse(res);
            console.log(datos);

            // Construir el contenido del modal
            var contenidoModal = '<h5>Editar Material - ' + datos[0].codigo + '</h5>';
            contenidoModal += '<form method="POST" action="{{ url('actualizar_material') }}/' + id + '">';
            contenidoModal += '@csrf';
            contenidoModal += '<div class="row"><div class="col-md-6"><div class="mb-3">';
            contenidoModal += '<label for="codigo" class= "form-label"> Código </label>';
            contenidoModal += '<input type="text" class="form-control" id="codigo" name="codigo" value="'+ datos[0].codigo +'" disabled> ';
            contenidoModal += '<div class="mb-3"> <label for="descripcion" class="form-label">Descripción</label>';
            contenidoModal += '<textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>'+ datos[0].descripcion +'</textarea></div>';
            contenidoModal += '<div class="mb-3"> <label for="marca" class="form-label">Marca</label>';
            contenidoModal += '<input type="text" class="form-control" id="marca" name="marca" value="'+ datos[0].marca +'" required> </div>';
            contenidoModal += '<div class="mb-3"> <label for="marca" class="form-label">Sub Familia</label>';
            contenidoModal += '<input type="text" class="form-control" id="sub_familia" name="sub_familia" value="'+ datos[0].sub_familia +'" required> </div>';
            contenidoModal += '</div></div>';

            contenidoModal += '<div class="col-md-6"><div class="mb-3">';
            contenidoModal += '<label for="codigo" class= "form-label"> N° Parte </label>';
            contenidoModal += '<input type="text" class="form-control" id="nro_parte" name="nro_parte" value="'+ datos[0].nro_parte +'" required>';
            contenidoModal += '<div class="mb-3"> <label for="desc_larga" class="form-label">Descripción Larga</label>';
            contenidoModal += '<textarea class="form-control" id="desc_larga" name="desc_larga" rows="3" required>'+ datos[0].desc_larga +'</textarea></div>';

            contenidoModal += '<div class="row"><div class="col-md-8"><div class="mb-3"> <label for="familia" class="form-label">Familia</label>';
            contenidoModal += '<input type="text" class="form-control" id="familia" name="familia" value="'+ datos[0].familia +'" required> </div></div>';
            contenidoModal += '<div class="col-md-4"><div class="mb-3"> <label for="costo_unitario" class="form-label">C.Uni</label>';
            contenidoModal += '<input type="text" class="form-control" id="costo_unitario" name="costo_unitario" placeholder="Costo" value="'+ datos[0].costo_unitario +'" required> </div></div></div>';

            contenidoModal += '<div class="row"><div class="col-md-8"><div class="mb-3"> <label for="grupo" class="form-label">Grupo</label>';
            contenidoModal += '<input type="text" class="form-control" id="grupo" name="grupo" value="'+ datos[0].grupo +'" required> </div></div>';
            contenidoModal += '<div class="col-md-4"><div class="mb-3"> <label for="um" class="form-label">UM</label>';
            contenidoModal += '<input type="text" class="form-control" id="um" name="um" value="'+ datos[0].um +'" required> </div></div></div>';
            contenidoModal += '</div></div></div>';
            // Agregar más campos según tus necesidades

            contenidoModal += '<div class="modal-footer"><button type="submit" class="btn btn-primary">Guardar</button>';
            contenidoModal += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
            contenidoModal += '</div></form>';

            // Agregar contenido al modal
            $('#modalContent').html(contenidoModal);

            // Abrir el modal
            $('#editarMaterialModal').modal('show');
        });
    }
</script>

</body>
</html>
