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
                        <h2 class="mb-0">Usuarios - Permiso</h2>
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
                                        <form action="{{url('permisos_guardar')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group row mb-4">
                                                <label for="usuario" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seleccionar el usuario:</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select class="form-control" id="usuario" name="usuario" data-choices="data-choices"
                                                            data-options='{"removeItemButton":true,"placeholder":true}' required>
                                                         <option value="" selected="" disabled="">-- SELECCIONE USUARIO --</option>
                                                        @foreach($roles as $rol)
                                                                <option value="{{ $rol->id }}">{{ $rol->rol_descripcion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="permiso" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seleccionar el permiso:</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10 form-check form-switch" id="permiso" style="align-content: center;">
                                                </div>
{{--                                                <div class="col-xl-10 col-lg-9 col-sm-10" style="align-content: center;">--}}
{{--                                                    <select id="permiso" name="permiso" class="required form-control" required>--}}
{{--                                                        <option value="">Selecciona un proyecto</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary" >Guardar</button>
                                            </div>
                                        </form>
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

        <script type="text/javascript" src="/js/sistema/rol_permiso.js"></script>
        <script>
            document.getElementById('usuario').addEventListener('change', function() {
                var usuarioId = this.value;
                console.log(usuarioId);
                var permisoSelect = document.getElementById('permiso');

                if (usuarioId) {
                    fetch('/permiso/' + usuarioId)
                        .then(response => response.json())
                        .then(data => {
                            permisoSelect.innerHTML = ''; // Limpia el contenido previo
                            console.log(data);
                            data.forEach(permiso => {
                                console.log(permiso.activado); // Verifica el valor de permiso.activado
                                var checked = permiso.activado === "activado" ? 'checked' : '';
                                permisoSelect.innerHTML += `
                            <div class="form-check">
                                <input class="form-check-input" id="permiso${permiso.id}" name="${permiso.id}" type="checkbox" ${checked} />
                                <label class="form-check-label" for="permiso${permiso.id}" name="${permiso.id}" >${permiso.nombre}</label>
                            </div>
                        `;
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            permisoSelect.innerHTML = '<option value="">Error al cargar permisos</option>';
                        });
                } else {
                    permisoSelect.innerHTML = '<option value="">No existe</option>';
                }
            });
        </script>
    </body>
</html>
