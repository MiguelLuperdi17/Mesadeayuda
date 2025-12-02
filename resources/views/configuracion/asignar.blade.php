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
                                        <form id="form_asignar" name="form_asignar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group row mb-4">
                                                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seleccionar el usuario:</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select class="form-control" id="cbo_rol" name="cbo_rol" onChange="ver_lista_asignados(),ver_lista_no_asignados()">
                                                        {{-- <option value="0">-SELECCIONE USUARIO-</option> --}}
                                                        @foreach($usuarios as $rol)
                                                            {{-- Comprueba si el user es igual a 2 --}}
                                                            @if($rol->id == 1)
                                                                {{-- Agrega la opción deshabilitada --}}
                                                                <option  disabled>{{ $rol->username }}</option>
                                                            @else
                                                                {{-- Agrega la opción normal --}}
                                                                <option value="{{ $rol->id }}">{{ $rol->username }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-2">Permisos asignados</div>
                                                <div class="col-sm-10">
                                                    <div id="div_permisos_asignados">
                                                    </div>
                                                </div>
                                            </div>

                                            <fieldset class="form-group mb-4">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" onclick="asignar_permiso();" name="cmd_asignar" id="cmd_asignar" class="btn btn-success">
                                                            Asignar
                                                        </button>
                                                        <button type="button" onclick="quitar_permiso();" name="cmd_quitar" id="cmd_quitar" class="btn btn-primary">
                                                            Quitar
                                                        </button>
                                                    </div>

                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-2">Permisos no asignados</div>
                                                <div class="col-sm-10">
                                                    <div id="div_permisos_no_asignados">
                                                    </div>
                                                </div>
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


    </body>
</html>
