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
                            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link ps-0 active" href="{{url('perfil')}}">Perfil</a></li>
                            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="{{url('password')}}">Contraseña</a></li>
                            <!-- <li class="nav-item dropdown" data-nav-item="data-nav-item" data-more-item="data-more-item" style="display: none;"><a class="nav-link dropdown-toggle dropdown-caret-none fw-bold pe-0" href="javascript: void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-boundary="window" data-bs-reference="parent"> More<svg class="svg-inline--fa fa-angle-down ms-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"></path></svg></a> -->
                            <div class="dropdown-menu dropdown-menu-end category-list" aria-labelledby="navbarDropdown" data-category-list="data-category-list"></div>
                            </li>
                        </ul>
                        </div>
                    </nav>
                    <br>
                    <div class="row align-items-center justify-content-between g-3 mb-4">
                        <div class="col-auto">
                        <h2 class="mb-0">Mi Perfil</h2>
                        </div>
                    </div>
                    @include('layouts.alerta')

                    <div class="row g-3 mb-6">
                        <div class="col-12 col-lg-7">
                            <div class="card h-100">
                                <div class="card-body">
                                <div class="border-bottom border-dashed border-300 pb-4">
                                    <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                                        <div class="col-12 col-sm-auto">
                                            <form   method="post" name="fileinfo" id="fileinfo" enctype="multipart/form-data">
                                            @csrf
                                                <input class="d-none archivo avatarFile" id="avatarFile" accept="image/png,image/jpeg" name="avatarFile" type="file" required/>
                                                <label class="cursor-pointer avatar avatar-5xl" for="avatarFile">
                                                    <img src="./recursos/gif.gif" class="gif" id="gif" style="position:absolute;display:none;" >
 
                                                    @if (Auth::user()->photo == NULL)
                                                        <img class="rounded-circle card-img-top"  src="{{ asset('default.jpg') }}" title="Agregar foto" alt="" />
                                                    @else
                                                        <img class="rounded-circle card-img-top" src="{{ asset('fotos_perfil/'.Auth::user()->photo) }}" title="Editar foto" alt="" />
                                                    @endif
                                                    <br><br>
                                                </label>
                                            </form>
                                        </div>

                                        <div class="col-12 col-sm-auto flex-1">
                                            <h3><div id="a_name">{{$lista->name}} {{$lista->surnames}}</div></h3>
                                            <p class="text-800 mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                            <spam id="a_user">{{$lista->username}}</spam></p>
                                            <p class="text-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"> <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/> </svg>
                                            <spam id="a_email">{{$lista->email}}</spam></p>
                                            <p class="text-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16"> <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/> </svg>
                                            <spam id="a_movil">{{$lista->movil}}</spam></p>
                                        </div>
                                    </div><br>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="card h-100">
                                <div class="card-body">
                                <form   method="post" name="actualizar_informacion" id="actualizar_informacion" accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="border-bottom border-dashed border-300">
                                        <h4 class="mb-3 lh-sm lh-xl-1">Actualizar Datos
                                            <button class="btn btn-link  p-0"  type="submit" id="acciones" style="float: right;"> 
                                                <span class="fas fa-save fs-1 ms-3 text-900" title="Guardar Datos"></span>
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="border-top border-dashed border-300 pt-4">
                                    <center>
                                        <img src="./recursos/gif.gif" class="gif_2" id="gif_2" style="position:absolute;display:none;width:40%; margin: auto;" >
                                    </center>

                                    <div class="row flex-between-center  mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Nombres</h5>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="nombres" value="{{$lista->name}}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row flex-between-center  mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Apellidos</h5>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="apellidos" value="{{$lista->surnames}}" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="row flex-between-center mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Email</h5>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="email" value="{{$lista->email}}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row flex-between-center  mb-2">
                                        <div class="col-auto">
                                            <h5 class="text-1000 mb-0">Phone</h5>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="celular" value="{{$lista->movil}}" class="form-control" />
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
        <script src="{{ asset('/js/configuracion/perfil.js') }}"></script>

    </body>
</html>
