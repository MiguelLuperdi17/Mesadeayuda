<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Login - Mesa de Ayuda</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/template/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/template/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/template/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/template/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/template/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/template/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('/template/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/config.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('/template/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/template/unicons/release/v4.0.8/css/line.css') }}">
    <link href="{{ asset('/template/assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('/template/assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('/template/assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('/template/assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid bg-300 dark__bg-1200">
            <div class="bg-holder" style="background-image:url(./recursos/fondo.png);"></div>
{{--            <div class="bg-holder bg-auth-card-overlay" style="background-image:url(./recursos/fondo.png);"></div>--}}
            <!--/.bg-holder-->
            <div class="row flex-center position-relative min-vh-100 g-0 py-5">
                <div class="col-11 col-sm-10 col-xl-4">
                    <div class="card border border-200 auth-card">
                        <div class="card-body">
                            <div class="row align-items-center gx-0 gy-7">

                                <div class="col mx-auto">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="auth-form-box">
                                        <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="#">
                                            <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block"><img src="{{ asset('/recursos/logo.png') }}" alt="logo" width="100%" /></div>
                                            </a>
                                            <h3 class="text-1000">Iniciar sesión</h3>
                                            <p class="text-700">Plataforma Mesa de Ayuda</p>
                                        </div>
                                        <!-- <button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs--1"></span>Inicia sesión con google</button> -->
                                        <!-- <button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs--1"></span>Inicia sesión con facebook</button> -->
                                       <!-- <div class="position-relative">
                                            <hr class="bg-200 mt-5 mb-4" />
                                            <div class="divider-content-center bg-white">o usar el correo electrónico</div>
                                        </div> -->
                                            <div class="mb-3 text-start"><label class="form-label" for="email">USUARIO</label>
                                                <div class="form-icon-container">
                                                    <!-- <input class="form-control form-icon-input" id="email" type="email" placeholder="name@example.com" /><span class="fas fa-user text-900 fs--1 form-icon"></span> -->
                                                    <input id="username" type="text" class="form-control form-icon-input @error('username') is-invalid @enderror" placeholder="Usuario"  name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                    <span class="fas fa-user text-900 fs--1 form-icon"></span>
                                                    @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="mb-3 text-start"><label class="form-label" for="password">CONTRASEÑA</label>
                                                <div class="form-icon-container">
                                                    <!-- <input class="form-control form-icon-input" id="password" type="password" placeholder="Password" /> -->
                                                    <input id="password" type="password" class="form-control form-icon-input @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">
                                                    <span class="fas fa-key text-900 fs--1 form-icon"></span>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        <!-- <div class="row flex-between-center mb-7">
                                            <div class="col-auto">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="basic-checkbox" checked="checked" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label mb-0" for="basic-checkbox">Acuérdate de mí</label>
                                                </div>
                                            </div>

                                        </div> -->
                                        <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar sesión</button>
                                        <!-- <div class="text-center"><a class="fs--1 fw-bold" href="sign-up.html">Crear una cuenta</a></div> -->
                                        </div>
{{--                                        <div style="text-align: -webkit-center;"><a href="/politicas_de_privacidad">Política de privacidad</a></div>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->

    @extends('layouts.setting')

    <script src="{{ asset('/template/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/template/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/phoenix.js') }}"></script>
</body>

</html>
