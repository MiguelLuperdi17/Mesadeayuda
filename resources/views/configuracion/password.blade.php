<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <section class="pt-5 pb-9">
            <nav class="ecommerce-navbar navbar-expand navbar-light bg-body-emphasis justify-content-between">
                <div class="" data-navbar="data-navbar">
                    <ul class="navbar-nav justify-content-end align-items-center">
                        <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link "
                                                                              href="{{url('perfil')}}">Perfil</a></li>
                        <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link ps-0  active"
                                                                              href="{{url('password')}}">Contraseña</a>
                        </li>
                        <!-- <li class="nav-item dropdown" data-nav-item="data-nav-item" data-more-item="data-more-item" style="display: none;"><a class="nav-link dropdown-toggle dropdown-caret-none fw-bold pe-0" href="javascript: void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-boundary="window" data-bs-reference="parent"> More<svg class="svg-inline--fa fa-angle-down ms-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"></path></svg></a> -->
                        <div class="dropdown-menu dropdown-menu-end category-list" aria-labelledby="navbarDropdown"
                             data-category-list="data-category-list"></div>
                        </li>
                    </ul>
                </div>
            </nav>
            <br>
            <div class="row align-items-center justify-content-between g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Mi Contraseña</h2>
                </div>
            </div>
            @include('layouts.alerta')

            <div class="alert alert-default alert-dismissible fade show" role="alert" style="background-color:#fff3cd">
                <strong>Hola {{$lista->name}}! </strong>
                <spam style="color: #664d03;">Protege tu cuenta modificando tu contraseña regularmente.
                    Te recomendamos que en tu contraseña uses una combinación de letras, mayúsculas y minúsculas y algún
                    número. Sugerimos que uses una extensión de al menos 12 caracteres.
                    Por favor, rellena todos los campos.
                </spam>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="row g-3 mb-6">
                <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form method="post" name="actualizar_informacion" id="actualizar_informacion"
                                  accept-charset="UTF-8" enctype="multipart/form-data">
                                @csrf
                                <div class="border-bottom border-dashed border-300">
                                    <h4 class="mb-3 lh-sm lh-xl-1">Actualizar Datos
                                        <button class="btn btn-link  p-0" type="submit" id="acciones"
                                                style="float: right;">
                                            <span class="fas fa-save fs-1 ms-3 text-900" title="Guardar Datos"></span>
                                        </button>
                                    </h4>
                                </div>
                                <div class="border-top border-dashed border-300 pt-4">
                                    <center>
                                        <img src="./recursos/gif.gif" class="gif_2" id="gif_2"
                                             style="position:absolute;display:none;width:9%; margin: auto;">
                                    </center>
                                    <div class="row flex-between-center  mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Contraseña Nueva</h5>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" name="password" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="row flex-between-center  mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Repetir Contraseña</h5>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" name="passwordConfirm" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('/js/configuracion/password.js') }}"></script>

</body>
</html>
