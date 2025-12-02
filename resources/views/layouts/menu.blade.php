<style>
    .fondo-degradado {
        background: rgb(255, 255, 255);
        background: linear-gradient(90deg, rgba(255, 255, 255, 1) 17%, #25b003, #2ba708);
    }
</style>
<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- parent pages-->
                    <br>
                    <div class="nav-item-wrapper">
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="/" role="button" data-bs-toggle=""
                                aria-expanded="true" style="background-color:#2ba708; padding-left: 0%;">

                                <div class="d-flex align-items-center" style="justify-content: center;">
                                    {{--                                <span class="nav-link-icon active" style="color:#fff;"> --}}
                                    {{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"> --}}
                                    {{--                                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path> --}}
                                    {{--                                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path> --}}
                                    {{--                                    </svg> --}}
                                    {{--                                </span> --}}
                                    <span class="nav-link-text-wrapper text-truncate"
                                        style="color:#fff;font-size:16px;">
                                        Mesa de Ayuda
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <br><br>
                    @if (valida_privilegio('1') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('MisTickets') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-circle text-900 fs-3">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg></span><span class="nav-link-text-wrapper"><span class="nav-link-text"
                                            style="color:#014a8f;font-size:16px;">Crear ticket</span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    {{--                    @if (valida_privilegio('9') == 1) --}}
                    {{--                        <!-- <div class="nav-item-wrapper"> --}}
                    {{--                            <a class="nav-link label-1" href="{{url('guias')}}" role="button" data-bs-toggle="" aria-expanded="false"> --}}
                    {{--                                <div class="d-flex align-items-center"> --}}
                    {{--                                    <span class="nav-link-icon"> --}}
                    {{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;">Guias</span> --}}
                    {{--                                    </span> --}}
                    {{--                                </div> --}}
                    {{--                            </a> --}}
                    {{--                        </div> --> --}}
                    {{--                        <div class="nav-item-wrapper"> --}}
                    {{--                            <a class="nav-link dropdown-indicator label-1 collapsed" href="#nv-customization" --}}
                    {{--                               role="button" data-bs-toggle="collapse" aria-expanded="false" --}}
                    {{--                               aria-controls="nv-customization"> --}}
                    {{--                                <div class="d-flex align-items-center"> --}}
                    {{--                                    <div class="dropdown-indicator-icon"> --}}
                    {{--                                    </div> --}}
                    {{--                                    <span class="nav-link-icon" style="color:#014a8f"> --}}
                    {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" --}}
                    {{--                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                    {{--                                             stroke-linecap="round" stroke-linejoin="round" --}}
                    {{--                                             class="feather feather-file-text"><path --}}
                    {{--                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline --}}
                    {{--                                                points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" --}}
                    {{--                                                                                         y2="13"></line><line x1="16" --}}
                    {{--                                                                                                              y1="17" --}}
                    {{--                                                                                                              x2="8" --}}
                    {{--                                                                                                              y2="17"></line><polyline --}}
                    {{--                                                points="10 9 9 9 8 9"></polyline></svg></span><span --}}
                    {{--                                        class="nav-link-text-wrapper"> --}}
                    {{--                                    </svg> --}}
                    {{--                                </span> --}}
                    {{--                                    <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Guias</span> --}}
                    {{--                                </div> --}}
                    {{--                            </a> --}}
                    {{--                            <div class="parent-wrapper label-1"> --}}
                    {{--                                <ul class="nav parent collapse" data-bs-parent="#navbarVerticalCollapse" --}}
                    {{--                                    id="nv-customization" style=""> --}}
                    {{--                                    <li class="collapsed-nav-item-title d-none">Guias</li> --}}

                    {{--                                    <li class="nav-item"><a class="nav-link" href="{{url('guias')}}" data-bs-toggle="" --}}
                    {{--                                                            aria-expanded="false"> --}}
                    {{--                                            <div class="d-flex align-items-center"><span --}}
                    {{--                                                    class="nav-link-text">T001</span></div> --}}
                    {{--                                        </a> --}}
                    {{--                                    </li> --}}
                    {{--                                    <li class="nav-item"><a class="nav-link" href="{{url('guiastwo')}}" --}}
                    {{--                                                            data-bs-toggle="" aria-expanded="false"> --}}
                    {{--                                            <div class="d-flex align-items-center"><span --}}
                    {{--                                                    class="nav-link-text">002</span></div> --}}
                    {{--                                        </a> --}}
                    {{--                                    </li> --}}
                    {{--                                    <!-- <li class="nav-item"><a class="nav-link" href="{{url('roles')}}" data-bs-toggle="" aria-expanded="false"> --}}
                    {{--                                    <div class="d-flex align-items-center"><span class="nav-link-text">Roles</span></div> --}}
                    {{--                                    </a> --}}
                    {{--                                </li> --> --}}
                    {{--                                </ul> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    @endif --}}
                    @if (valida_privilegio('2') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Asignar') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-file-plus text-900 fs-3">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="12" y1="18" x2="12" y2="12"></line>
                                            <line x1="9" y1="15" x2="15" y2="15"></line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Asignar Ticket
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('3') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Solucionar') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit text-900 fs-3">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Registrar
                                            Solución
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('4') == 1)
                        <div class="nav-item-wrapper">
                            {{--                            <button class="btn-xs btn btn-primary" data-bs-toggle="modal" --}}
                            {{--                                    data-bs-target="#TicketUsuario">Crear Ticket --}}
                            {{--                            </button> --}}
                            <a class="nav-link label-1" data-bs-target="#TicketUsuario" role="button"
                                data-bs-toggle="modal" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-folder-plus text-900 fs-3">
                                            <path
                                                d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z">
                                            </path>
                                            <line x1="12" y1="11" x2="12" y2="17">
                                            </line>
                                            <line x1="9" y1="14" x2="15" y2="14">
                                            </line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Nuevo Ticket
                                            Usuario
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('5') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Seguimiento') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-calendar text-900 fs-3">
                                            <rect x="3" y="4" width="18" height="18" rx="2"
                                                ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6">
                                            </line>
                                            <line x1="8" y1="2" x2="8" y2="6">
                                            </line>
                                            <line x1="3" y1="10" x2="21" y2="10">
                                            </line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Seguimiento
                                            Tickets
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('7') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Consultar') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-archive text-900 fs-3">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12">
                                            </line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Consulta
                                            Tickets
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('8') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Materiale') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-package">
                                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21">
                                            </line>
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12">
                                            </line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Material de
                                            Ayuda
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('9') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('Aprobar') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-check-square text-900 fs-3">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text"
                                            style="color:#014a8f;font-size:16px;">Autorizaciones
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('10') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('permisos-por-rol') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Permisos
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('11') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('reportes') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-pie-chart">
                                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Reportes
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (valida_privilegio('12') == 1)
                        <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1"
                            href="#nv-proyectos" role="button" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="nv-proyectos">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <svg class="svg-inline--fa fa-caret-right" aria-hidden="true"
                                        focusable="false" data-prefix="fas" data-icon="caret-right"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                                        data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M118.6 105.4l128 127.1C252.9 239.6 256 247.8 256 255.1s-3.125 16.38-9.375 22.63l-128 127.1c-9.156 9.156-22.91 11.9-34.88 6.943S64 396.9 64 383.1V128c0-12.94 7.781-24.62 19.75-29.58S109.5 96.23 118.6 105.4z">
                                        </path>
                                    </svg>
                                    <!-- <span class="fas fa-caret-right"></span> Font Awesome fontawesome.com -->
                                </div>
                                <span class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-clipboard">
                                    <path
                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1"
                                        ry="1"></rect>
                                </svg></span>
                                <span class="nav-link-text"
                                    style="color:#014a8f;font-size:16px;">Proyectos</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav parent collapse" data-bs-parent="#navbarVerticalCollapse"
                                id="nv-proyectos" style="">
                                <li class="nav-item"><a class="nav-link" href="{{ url('proyectos') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text"
                                                style="color:#014a8f;font-size:16px;">Ver Proyectos</span>
                                        </div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('reportes_proyectos') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text"
                                                style="color:#014a8f;font-size:16px;">Reportes</span>
                                        </div>
                                    </a><!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>

                    @endif
                    @if (valida_privilegio('13') == 1)
                        <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1"
                                href="#nv-pricing" role="button" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="nv-pricing">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <svg class="svg-inline--fa fa-caret-right" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="caret-right"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                                            data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M118.6 105.4l128 127.1C252.9 239.6 256 247.8 256 255.1s-3.125 16.38-9.375 22.63l-128 127.1c-9.156 9.156-22.91 11.9-34.88 6.943S64 396.9 64 383.1V128c0-12.94 7.781-24.62 19.75-29.58S109.5 96.23 118.6 105.4z">
                                            </path>
                                        </svg>
                                        <!-- <span class="fas fa-caret-right"></span> Font Awesome fontawesome.com -->
                                    </div>
                                    <span class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-tag">
                                            <path
                                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                            </path>
                                            <line x1="7" y1="7" x2="7.01" y2="7">
                                            </line>
                                        </svg></span>
                                    <span class="nav-link-text"
                                        style="color:#014a8f;font-size:16px;">Distribuciones</span>
                                </div>
                            </a>
                            <div class="parent-wrapper label-1">
                                <ul class="nav parent collapse" data-bs-parent="#navbarVerticalCollapse"
                                    id="nv-pricing" style="">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('Costos_telefonos') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text"
                                                    style="color:#014a8f;font-size:16px;">Claro</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('Costos_palermo') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text"
                                                    style="color:#014a8f;font-size:16px;">Palermo</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (valida_privilegio('14') == 1)
                        <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1"
                                href="#nv-proveedor" role="button" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="nv-proveedor">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon">
                                        <svg class="svg-inline--fa fa-caret-right" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="caret-right"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                                            data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M118.6 105.4l128 127.1C252.9 239.6 256 247.8 256 255.1s-3.125 16.38-9.375 22.63l-128 127.1c-9.156 9.156-22.91 11.9-34.88 6.943S64 396.9 64 383.1V128c0-12.94 7.781-24.62 19.75-29.58S109.5 96.23 118.6 105.4z">
                                            </path>
                                        </svg>
                                        <!-- <span class="fas fa-caret-right"></span> Font Awesome fontawesome.com -->
                                    </div>
                                    <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-monitor text-900 fs-3">
                                        <rect x="2" y="3" width="20" height="14" rx="2"
                                            ry="2"></rect>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                        <line x1="12" y1="17" x2="12" y2="21"></line>
                                    </svg>
                                </span>

                                    <span class="nav-link-text"
                                        style="color:#014a8f;font-size:16px;">Proveedores</span>
                                </div>
                            </a>
                            <div class="parent-wrapper label-1">
                                <ul class="nav parent collapse" data-bs-parent="#navbarVerticalCollapse"
                                    id="nv-proveedor" style="">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('Ticket_Proveedores') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text"
                                                    style="color:#014a8f;font-size:16px;">Tickets</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    @if (valida_privilegio('12') == 1)
                                    <li class="nav-item"><a class="nav-link" href="{{ url('Proveedores') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text"
                                                    style="color:#014a8f;font-size:16px;">Proveedores</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('Proveedores_reporte') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text"
                                                    style="color:#014a8f;font-size:16px;">Reportes</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (valida_privilegio('33') == 1)
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="{{ url('usuarios') }}" role="button"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg><span class="nav-link-text-wrapper"><span class="nav-link-text" style="color:#014a8f;font-size:16px;"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-users text-900 fs-3">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text-wrapper">
                                        <span class="nav-link-text" style="color:#014a8f;font-size:16px;">Usuarios y
                                            Roles
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-0"></span>
            <span class="uil uil-arrow-from-right fs-0"></span>
            <span class="navbar-vertical-footer-text ms-2">Vista contraída </span>
        </button>
    </div>
</nav>

<nav class="navbar navbar-top fixed-top navbar-expand fondo-degradado" id="navbarDefault" style="display:none;">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="index.html">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center"><img src="{{ asset('/recursos/logo2.png') }}"
                            alt="phoenix" width="100%" />
                        <!-- <p class="logo-text ms-2 d-none d-sm-block">phoenix</p> -->
                    </div>
                </div>
            </a>
        </div>

        <ul class="navbar-nav navbar-nav-icons flex-row">
            <!-- <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2"><input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon" data-feather="moon"></span></label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon" data-feather="sun"></span></label></div>
            </li> -->
            <!-- <li class="nav-item dropdown">
            <a class="nav-link" style="color:#fff" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell" style="height:20px;width:20px;"></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
            <div class="card position-relative border-0">
                <div class="card-header p-2">
                <div class="d-flex justify-content-between">
                    <h5 class="text-black mb-0">Notificatones</h5><button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as read</button>
                </div>
                </div>
                <div class="card-body p-0">
                <div class="scrollbar-overlay" style="height: 27rem;">
                    <div class="border-300">
                    <div class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                        <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                            <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="{{ asset('/template/assets/img/team/40x40/30.webp') }}" alt="" /></div>
                            <div class="flex-1 me-sm-3">
                            <h4 class="fs--1 text-black">Jessie Samson</h4>
                            <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span class='me-1 fs--2'>💬</span>Mentioned you in a comment.<span class="ms-2 text-400 fw-bold fs--2">10m</span></p>
                            <p class="text-800 fs--1 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:41 AM </span>August 7,2021</p>
                            </div>
                        </div>
                        <div class="font-sans-serif d-none d-sm-block"><button class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                        </div>
                    </div>
                    </div>

                </div>
                </div>
                <div class="card-footer p-0 border-top border-0">
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="pages/notifications.html">Notification history</a></div>
                </div>
            </div>
            </div>
        </li> -->

            <li class="nav-item dropdown">
                <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-l ">
                        <img class="rounded-circle " src="{{ asset('fotos_perfil/' . Auth::user()->photo) }}"
                            alt="" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <img class="rounded-circle "
                                        src="{{ asset('fotos_perfil/' . Auth::user()->photo) }}" alt="" />
                                </div>
                                <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                            </div>
                        </div>
                        <div class="overflow-auto scrollbar" style="height: 6rem;">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top">
                            <!-- <ul class="nav d-flex flex-column my-3">
                                <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="user-plus"></span>Add another account</a></li>
                            </ul> -->
                            <hr />
                            <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <span class="me-2" data-feather="log-out"> </span>
                                Cerrar sesión
                            </a>
                            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                    href="#!">Política
                                    de privacidad</a>&bull;<a class="text-600 mx-1"
                                    href="#!">Términos</a>&bull;<a class="text-600 ms-1"
                                    href="#!">Cookies</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-top navbar-slim fixed-top navbar-expand" id="topNavSlim" style="display:none;">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand navbar-brand" href="index.html">phoenix <span
                    class="text-1000 d-none d-sm-inline">slim</span></a>
        </div>
        <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
                <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
                        class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                        type="checkbox" data-theme-control="phoenixTheme" value="dark" /><label
                        class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                            class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
                            class="fs--1 fw-bold">Dark</span></label><label
                        class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                            class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
                            class="fs--1 fw-bold">Light</span></label>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdownNotification" href="#" role="button"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                    aria-expanded="false"><span data-feather="bell" style="height:12px;width:12px;"></span></a>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                    id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                    <div class="card position-relative border-0">
                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-black mb-0">Notificatons</h5>
                                <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as
                                    read</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar-overlay" style="height: 27rem;">
                                <div class="border-300">
                                    <div
                                        class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                        <div
                                            class="d-flex align-items-center justify-content-between position-relative">
                                            <div class="d-flex">
                                                <div class="avatar avatar-m status-online me-3"><img
                                                        class="rounded-circle"
                                                        src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                        alt="" /></div>
                                                <div class="flex-1 me-sm-3">
                                                    <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                    <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                            class='me-1 fs--2'>💬</span>Mentioned you in a
                                                        comment.<span class="ms-2 text-400 fw-bold fs--2">10m</span>
                                                    </p>
                                                    <p class="text-800 fs--1 mb-0"><span
                                                            class="me-1 fas fa-clock"></span><span
                                                            class="fw-bold">10:41 AM </span>August
                                                        7,2021</p>
                                                </div>
                                            </div>
                                            <div class="font-sans-serif d-none d-sm-block">
                                                <button
                                                    class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    data-bs-reference="parent"><span
                                                        class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                        class="dropdown-item" href="#!">Mark as unread</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                        <div
                                            class="d-flex align-items-center justify-content-between position-relative">
                                            <div class="d-flex">
                                                <div class="avatar avatar-m status-online me-3">
                                                    <div class="avatar-name rounded-circle"><span>J</span></div>
                                                </div>
                                                <div class="flex-1 me-sm-3">
                                                    <h4 class="fs--1 text-black">Jane Foster</h4>
                                                    <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                            class='me-1 fs--2'>📅</span>Created an event.<span
                                                            class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                    <p class="text-800 fs--1 mb-0"><span
                                                            class="me-1 fas fa-clock"></span><span
                                                            class="fw-bold">10:20 AM </span>August
                                                        7,2021</p>
                                                </div>
                                            </div>
                                            <div class="font-sans-serif d-none d-sm-block">
                                                <button
                                                    class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    data-bs-reference="parent"><span
                                                        class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                        class="dropdown-item" href="#!">Mark as unread</a></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-footer p-0 border-top border-0">
                            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                    href="pages/notifications.html">Notification
                                    history</a></div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser"
                    href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    data-bs-auto-close="outside" aria-expanded="false">Olivia <span
                        class="fa-solid fa-chevron-down fs--2"></span></a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <img class="rounded-circle "
                                        src="{{ asset('/template/assets/img/team/72x72/57.webp') }}"
                                        alt="" />
                                </div>
                                <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                            </div>
                        </div>
                        <div class="overflow-auto scrollbar" style="height: 4rem;">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                                <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}"> <span
                                            class="me-2 text-900" data-feather="user"></span><span>Perfil</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top">
                            <hr />
                            <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <span class="me-2" data-feather="log-out"> </span>
                                Cerrar sesión
                            </a>
                            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                    href="#!">Política
                                    de privacidad</a>&bull;<a class="text-600 mx-1"
                                    href="#!">Términos</a>&bull;<a class="text-600 ms-1"
                                    href="#!">Cookies</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-top fixed-top navbar-expand-lg fondo-degradado" id="dualNav" style="display:none;">
    <div class="w-100">
        <div class="d-flex flex-between-center dual-nav-first-layer">
            <div class="navbar-logo">
                <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
                    aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                            class="toggle-line"></span></span></button>
                <a class="navbar-brand me-1 me-sm-3" href="index.html">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center"><img src="{{ asset('/recursos/logo.png') }}"
                                alt="phoenix" width="100" />
                            <!-- <p class="logo-text ms-2 d-none d-sm-block">phoenix</p> -->
                        </div>
                    </div>
                </a>
            </div>

            <ul class="navbar-nav navbar-nav-icons flex-row">
                <li class="nav-item">
                    <div class="theme-control-toggle fa-icon-wait px-2"><input
                            class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                            data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label
                            class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                            for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Switch theme"><span class="icon" data-feather="moon"></span></label><label
                            class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                            for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Switch theme"><span class="icon" data-feather="sun"></span></label>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" style="min-width: 2.5rem" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-bs-auto-close="outside"><span data-feather="bell"
                            style="height:20px;width:20px;"></span></a>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                        <div class="card position-relative border-0">
                            <div class="card-header p-2">
                                <div class="d-flex justify-content-between">
                                    <h5 class="text-black mb-0">Notificatons</h5>
                                    <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as read
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="scrollbar-overlay" style="height: 27rem;">
                                    <div class="border-300">
                                        <div
                                            class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                            <div
                                                class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img
                                                            class="rounded-circle"
                                                            src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                            alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                        <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                                class='me-1 fs--2'>💬</span>Mentioned you in a
                                                            comment.<span
                                                                class="ms-2 text-400 fw-bold fs--2">10m</span>
                                                        </p>
                                                        <p class="text-800 fs--1 mb-0"><span
                                                                class="me-1 fas fa-clock"></span><span
                                                                class="fw-bold">10:41 AM </span>August
                                                            7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="font-sans-serif d-none d-sm-block">
                                                    <button
                                                        class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown"
                                                        data-boundary="window" aria-haspopup="true"
                                                        aria-expanded="false" data-bs-reference="parent"><span
                                                            class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                            class="dropdown-item" href="#!">Mark as unread</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                            <div
                                                class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3">
                                                        <div class="avatar-name rounded-circle"><span>J</span></div>
                                                    </div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs--1 text-black">Jane Foster</h4>
                                                        <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                                class='me-1 fs--2'>📅</span>Created an event.<span
                                                                class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                        <p class="text-800 fs--1 mb-0"><span
                                                                class="me-1 fas fa-clock"></span><span
                                                                class="fw-bold">10:20 AM </span>August
                                                            7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="font-sans-serif d-none d-sm-block">
                                                    <button
                                                        class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown"
                                                        data-boundary="window" aria-haspopup="true"
                                                        aria-expanded="false" data-bs-reference="parent"><span
                                                            class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                            class="dropdown-item" href="#!">Mark as unread</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card-footer p-0 border-top border-0">
                                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                        href="pages/notifications.html">Notification
                                        history</a></div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser"
                        href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-l ">
                            <img class="rounded-circle "
                                src="{{ asset('/template/assets/img/team/40x40/57.webp') }}" alt="" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                        aria-labelledby="navbarDropdownUser">
                        <div class="card position-relative border-0">
                            <div class="card-body p-0">
                                <div class="text-center pt-4 pb-3">
                                    <div class="avatar avatar-xl ">
                                        <img class="rounded-circle "
                                            src="{{ asset('/template/assets/img/team/72x72/57.webp') }}"
                                            alt="" />
                                    </div>
                                    <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                                </div>
                            </div>
                            <div class="overflow-auto scrollbar" style="height: 4rem;">
                                <ul class="nav d-flex flex-column mb-2 pb-1">
                                    <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}">
                                            <span class="me-2 text-900"
                                                data-feather="user"></span><span>Perfil</span></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-footer p-0 border-top">
                                <hr />
                                <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                    <span class="me-2" data-feather="log-out"> </span>
                                    Cerrar sesión
                                </a>
                                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                        href="#!">Política
                                        de privacidad</a>&bull;<a class="text-600 mx-1"
                                        href="#!">Términos</a>&bull;<a class="text-600 ms-1"
                                        href="#!">Cookies</a></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse navbar-top-collapse justify-content-center" id="navbarTopCollapse">
            <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lh-1" href="#!" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        &nbsp;Configuración
                    </a>

                    <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="dashboard/project-management.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="clipboard"></span>Permisos
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item active" href="index.html">
                                <div class="dropdown-item-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    &nbsp;&nbsp;Usuarios
                                </div>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!"
                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false"><span
                            class="uil fs-0 me-2 uil-cube"></span>Apps</a>
                    <ul class="dropdown-menu navbar-dropdown-caret">
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="e-commerce"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="shopping-cart"></span>Usuarios</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="admin"
                                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <div class="dropdown-item-wrapper"><span
                                                class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                                    class="me-2 uil"></span>Admin</span></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="apps/e-commerce/admin/add-product.html">
                                                <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add
                                                    product
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/admin/products.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Products
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/admin/customers.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Customers
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/admin/customer-details.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Customer
                                                    details
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/admin/orders.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Orders
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/admin/order-details.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Order
                                                    details
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/admin/refund.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Refund
                                                </div>
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="customer"
                                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <div class="dropdown-item-wrapper"><span
                                                class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                                    class="me-2 uil"></span>Customer</span></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/homepage.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Homepage
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/landing/product-details.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Product
                                                    details
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/landing/products-filter.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Products
                                                    filter
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/cart.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Cart
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/checkout.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Checkout
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/landing/shipping-info.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Shipping
                                                    info
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/profile.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Perfil
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/landing/favourite-stores.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Favourite
                                                    stores
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/wishlist.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Wishlist
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="apps/e-commerce/landing/order-tracking.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Order
                                                    tracking
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="apps/e-commerce/landing/invoice.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Invoice
                                                </div>
                                            </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="CRM"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="phone"></span>CRM</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/crm/analytics.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Analytics
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/deals.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Deals</div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/deal-details.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Deal
                                            details
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/leads.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Leads</div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/lead-details.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Lead
                                            details
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/reports.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reports
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/reports-details.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reports
                                            details
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/crm/add-contact.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add contact
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="project-management"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="clipboard"></span>Permisos</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/project-management/create-new.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create new
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/project-management/project-list-view.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project
                                            list
                                            view
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/project-management/project-card-view.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project
                                            card
                                            view
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/project-management/project-board-view.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project
                                            board
                                            view
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/project-management/todo-list.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Todo list
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/project-management/project-details.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project
                                            details
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="apps/chat.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="message-square"></span>Chat
                                </div>
                            </a></li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="email"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="mail"></span>Email</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/email/inbox.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Inbox</div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/email/email-detail.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Email
                                            detail
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/email/compose.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Compose
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="events"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="bookmark"></span>Events</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/events/create-an-event.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create an
                                            event
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/events/event-detail.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Event
                                            detail
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="kanban"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="trello"></span>Kanban</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/kanban/kanban.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Kanban
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/kanban/boards.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Boards
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/kanban/create-kanban-board.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create
                                            board
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="social"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="share-2"></span>Social</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="apps/social/profile.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Perfil
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="apps/social/settings.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Settings
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="apps/calendar.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="calendar"></span>Calendar
                                </div>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!"
                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false"><span
                            class="uil fs-0 me-2 uil-files-landscapes-alt"></span>Pages</a>
                    <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="pages/starter.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="compass"></span>Starter
                                </div>
                            </a></li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="faq"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="help-circle"></span>Faq</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/faq/faq-accordion.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Faq
                                            accordion
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="pages/faq/faq-tab.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Faq tab
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="landing"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="globe"></span>Landing</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/landing/default.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Default
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="pages/landing/alternate.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Alternate
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="pricing"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="tag"></span>Pricing</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/pricing/pricing-column.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Pricing
                                            column
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="pages/pricing/pricing-grid.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Pricing
                                            grid
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="pages/notifications.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="bell"></span>Notifications
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="pages/members.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="users"></span>Members
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="pages/timeline.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="clock"></span>Timeline
                                </div>
                            </a></li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="errors"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="alert-triangle"></span>Errors</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/errors/404.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>404</div>
                                    </a></li>
                                <li><a class="dropdown-item" href="pages/errors/403.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>403</div>
                                    </a></li>
                                <li><a class="dropdown-item" href="pages/errors/500.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>500</div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="authentication"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="lock"></span>Authentication</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="simple"
                                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <div class="dropdown-item-wrapper"><span
                                                class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                                    class="me-2 uil"></span>Simple</span></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/sign-in.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/sign-up.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign up
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/sign-out.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Cerrar
                                                    sesión
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/forgot-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Forgot
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/reset-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Reset
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/simple/lock-screen.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Lock
                                                    screen
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/simple/2FA.html">
                                                <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA
                                                </div>
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="split"
                                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <div class="dropdown-item-wrapper"><span
                                                class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                                    class="me-2 uil"></span>Split</span></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="pages/authentication/split/sign-in.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign in
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/split/sign-up.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign up
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/split/sign-out.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Cerrar
                                                    sesión
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/split/forgot-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Forgot
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/split/reset-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Reset
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/split/lock-screen.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Lock
                                                    screen
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/split/2FA.html">
                                                <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA
                                                </div>
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="Card"
                                        href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <div class="dropdown-item-wrapper"><span
                                                class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                                    class="me-2 uil"></span>Card</span></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="pages/authentication/card/sign-in.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign in
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/card/sign-up.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Sign up
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/card/sign-out.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Cerrar
                                                    sesión
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/card/forgot-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Forgot
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/card/reset-password.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Reset
                                                    password
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item"
                                                href="pages/authentication/card/lock-screen.html">
                                                <div class="dropdown-item-wrapper"><span
                                                        class="me-2 uil"></span>Lock
                                                    screen
                                                </div>
                                            </a></li>
                                        <li><a class="dropdown-item" href="pages/authentication/card/2FA.html">
                                                <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA
                                                </div>
                                            </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="layouts"
                                href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="layout"></span>Layouts</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="demo/vertical-sidenav.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Vertical
                                            sidenav
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/dark-mode.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dark mode
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/sidenav-collapse.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sidenav
                                            collapse
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/darknav.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Darknav
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/topnav-slim.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Topnav slim
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/navbar-top-slim.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Navbar top
                                            slim
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/navbar-top.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Navbar top
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/horizontal-slim.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Horizontal
                                            slim
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/combo-nav.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo nav
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/combo-nav-slim.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo nav
                                            slim
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="demo/dual-nav.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dual nav
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!"
                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false"><span
                            class="uil fs-0 me-2 uil-puzzle-piece"></span>Modules</a>
                    <ul class="dropdown-menu navbar-dropdown-caret dropdown-menu-card py-0">
                        <div class="border-0 scrollbar" style="max-height: 60vh;">
                            <div class="px-3 pt-4 pb-3 img-dropdown">
                                <div class="row gx-4 gy-5">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="dropdown-item-group"><span class="me-2"
                                                data-feather="file-text" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">Forms</h6>
                                        </div>
                                        <a class="dropdown-link" href="modules/forms/basic/form-control.html">Form
                                            control</a><a class="dropdown-link"
                                            href="modules/forms/basic/input-group.html">Input group</a><a
                                            class="dropdown-link"
                                            href="modules/forms/basic/select.html">Select</a><a
                                            class="dropdown-link"
                                            href="modules/forms/basic/checks.html">Checks</a><a
                                            class="dropdown-link" href="modules/forms/basic/range.html">Range</a><a
                                            class="dropdown-link"
                                            href="modules/forms/basic/floating-labels.html">Floating
                                            labels</a><a class="dropdown-link"
                                            href="modules/forms/basic/layout.html">Layout</a><a
                                            class="dropdown-link"
                                            href="modules/forms/advance/advance-select.html">Advance
                                            select</a><a class="dropdown-link"
                                            href="modules/forms/advance/date-picker.html">Date picker</a><a
                                            class="dropdown-link"
                                            href="modules/forms/advance/editor.html">Editor</a><a
                                            class="dropdown-link"
                                            href="modules/forms/advance/file-uploader.html">File
                                            uploader</a><a class="dropdown-link"
                                            href="modules/forms/advance/rating.html">Rating</a><a
                                            class="dropdown-link"
                                            href="modules/forms/advance/emoji-button.html">Emoji
                                            button</a><a class="dropdown-link"
                                            href="modules/forms/validation.html">Validation</a><a
                                            class="dropdown-link" href="modules/forms/wizard.html">Wizard</a>
                                        <div class="dropdown-item-group mt-5"><span class="me-2"
                                                data-feather="grid" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">Icons</h6>
                                        </div>
                                        <a class="dropdown-link" href="modules/icons/feather.html">Feather</a><a
                                            class="dropdown-link" href="modules/icons/font-awesome.html">Font
                                            awesome</a><a class="dropdown-link"
                                            href="modules/icons/unicons.html">Unicons</a>
                                        <div class="dropdown-item-group mt-5"><span class="me-2"
                                                data-feather="bar-chart-2" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">ECharts</h6>
                                        </div>
                                        <a class="dropdown-link" href="modules/echarts/line-charts.html">Line
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/bar-charts.html">Bar
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/candlestick-charts.html">Candlestick
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/geo-map.html">Geo
                                            map</a><a class="dropdown-link"
                                            href="modules/echarts/scatter-charts.html">Scatter
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/pie-charts.html">Pie
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/gauge-chart.html">Gauge
                                            chart</a><a class="dropdown-link"
                                            href="modules/echarts/radar-charts.html">Radar
                                            charts</a><a class="dropdown-link"
                                            href="modules/echarts/heatmap-charts.html">Heatmap charts</a><a
                                            class="dropdown-link" href="modules/echarts/how-to-use.html">How to
                                            use</a>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="dropdown-item-group"><span class="me-2"
                                                data-feather="package" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">Components</h6>
                                        </div>
                                        <a class="dropdown-link"
                                            href="modules/components/accordion.html">Accordion</a><a
                                            class="dropdown-link" href="modules/components/avatar.html">Avatar</a><a
                                            class="dropdown-link" href="modules/components/alerts.html">Alerts</a><a
                                            class="dropdown-link" href="modules/components/badge.html">Badge</a><a
                                            class="dropdown-link"
                                            href="modules/components/breadcrumb.html">Breadcrumb</a><a
                                            class="dropdown-link"
                                            href="modules/components/button.html">Buttons</a><a
                                            class="dropdown-link"
                                            href="modules/components/calendar.html">Calendar</a><a
                                            class="dropdown-link" href="modules/components/card.html">Card</a><a
                                            class="dropdown-link"
                                            href="modules/components/carousel/bootstrap.html">Bootstrap</a><a
                                            class="dropdown-link"
                                            href="modules/components/carousel/swiper.html">Swiper</a><a
                                            class="dropdown-link"
                                            href="modules/components/collapse.html">Collapse</a><a
                                            class="dropdown-link"
                                            href="modules/components/dropdown.html">Dropdown</a><a
                                            class="dropdown-link" href="modules/components/list-group.html">List
                                            group</a><a class="dropdown-link"
                                            href="modules/components/modal.html">Modals</a><a class="dropdown-link"
                                            href="modules/components/navs-and-tabs/navs.html">Navs</a><a
                                            class="dropdown-link"
                                            href="modules/components/navs-and-tabs/navbar.html">Navbar</a><a
                                            class="dropdown-link"
                                            href="modules/components/navs-and-tabs/tabs.html">Tabs</a><a
                                            class="dropdown-link"
                                            href="modules/components/offcanvas.html">Offcanvas</a><a
                                            class="dropdown-link"
                                            href="modules/components/progress-bar.html">Progress
                                            bar</a><a class="dropdown-link"
                                            href="modules/components/placeholder.html">Placeholder</a><a
                                            class="dropdown-link"
                                            href="modules/components/pagination.html">Pagination</a><a
                                            class="dropdown-link"
                                            href="modules/components/popovers.html">Popovers</a><a
                                            class="dropdown-link"
                                            href="modules/components/scrollspy.html">Scrollspy</a><a
                                            class="dropdown-link"
                                            href="modules/components/sortable.html">Sortable</a><a
                                            class="dropdown-link"
                                            href="modules/components/spinners.html">Spinners</a><a
                                            class="dropdown-link" href="modules/components/toast.html">Toast</a><a
                                            class="dropdown-link"
                                            href="modules/components/tooltips.html">Tooltips</a><a
                                            class="dropdown-link" href="modules/components/chat-widget.html">Chat
                                            widget</a>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="dropdown-item-group"><span class="me-2"
                                                data-feather="columns" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">Tables</h6>
                                        </div>
                                        <a class="dropdown-link" href="modules/tables/basic-tables.html">Basic
                                            tables</a><a class="dropdown-link"
                                            href="modules/tables/advance-tables.html">Advance tables</a><a
                                            class="dropdown-link" href="modules/tables/bulk-select.html">Bulk
                                            Select</a>
                                        <div class="dropdown-item-group mt-5"><span class="me-2"
                                                data-feather="tool" style="stroke-width:2;"></span>
                                            <h6 class="dropdown-item-title">Utilities</h6>
                                        </div>
                                        <a class="dropdown-link"
                                            href="modules/utilities/background.html">Background</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/borders.html">Borders</a><a
                                            class="dropdown-link" href="modules/utilities/colors.html">Colors</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/display.html">Display</a><a
                                            class="dropdown-link" href="modules/utilities/flex.html">Flex</a><a
                                            class="dropdown-link" href="modules/utilities/stacks.html">Stacks</a><a
                                            class="dropdown-link" href="modules/utilities/float.html">Float</a><a
                                            class="dropdown-link" href="modules/utilities/grid.html">Grid</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/interactions.html">Interactions</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/opacity.html">Opacity</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/overflow.html">Overflow</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/position.html">Position</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/shadows.html">Shadows</a><a
                                            class="dropdown-link" href="modules/utilities/sizing.html">Sizing</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/spacing.html">Spacing</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/typography.html">Typography</a><a
                                            class="dropdown-link"
                                            href="modules/utilities/vertical-align.html">Vertical
                                            align</a><a class="dropdown-link"
                                            href="modules/utilities/visibility.html">Visibility</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!"
                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false"><span
                            class="uil fs-0 me-2 uil-document-layout-right"></span>Documentation</a>
                    <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="documentation/getting-started.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="life-buoy"></span>Getting started
                                </div>
                            </a></li>
                        <li class="dropdown dropdown-inside"><a class="dropdown-item dropdown-toggle"
                                id="customization" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="settings"></span>Customization</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="documentation/customization/configuration.html">
                                        <div class="dropdown-item-wrapper"><span
                                                class="me-2 uil"></span>Configuration
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/customization/styling.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Styling
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/customization/dark-mode.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dark mode
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/customization/plugin.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Plugin
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-inside"><a class="dropdown-item dropdown-toggle"
                                id="layouts-doc" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                <div class="dropdown-item-wrapper"><span
                                        class="uil fs-0 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span
                                            class="me-2 uil" data-feather="table"></span>Layouts doc</span></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="documentation/layouts/vertical-navbar.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Vertical
                                            navbar
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/layouts/horizontal-navbar.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Horizontal
                                            navbar
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/layouts/combo-navbar.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo
                                            navbar
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item" href="documentation/layouts/dual-nav.html">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dual nav
                                        </div>
                                    </a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="documentation/gulp.html">
                                <div class="dropdown-item-wrapper"><span
                                        class="me-2 fa-brands fa-gulp ms-1 me-1 fa-lg"></span>Gulp
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="documentation/design-file.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="figma"></span>Design
                                    file
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="changelog.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="git-merge"></span>Changelog
                                </div>
                            </a></li>
                        <li><a class="dropdown-item" href="showcase.html">
                                <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                        data-feather="monitor"></span>Showcase
                                </div>
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-top fixed-top navbar-expand-lg fondo-degradado" id="navbarTop" style="display:none;">
    <div class="navbar-logo">
        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
            aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="index.html">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center"><img src="{{ asset('/recursos/logo.png') }}"
                        alt="phoenix" width="100" />
                    <!-- <p class="logo-text ms-2 d-none d-sm-block">phoenix</p> -->
                </div>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
        id="navbarTopCollapse">
        <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    &nbsp;Configuración
                </a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                    <li>
                        <a class="dropdown-item active" href="index.html">
                            <div class="dropdown-item-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                &nbsp;&nbsp;Usuarios
                            </div>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="dashboard/project-management.html">
                            <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                    data-feather="clipboard"></span>Permisos
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2"><input
                    class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                    data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                        data-feather="moon"></span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                        data-feather="sun"></span></label>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" style="min-width: 2.5rem" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                data-bs-auto-close="outside"><span data-feather="bell" style="height:20px;width:20px;"></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                <div class="card position-relative border-0">
                    <div class="card-header p-2">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-black mb-0">Notificatons</h5>
                            <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as
                                read</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="scrollbar-overlay" style="height: 27rem;">
                            <div class="border-300">
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle"
                                                    src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-400 fw-bold fs--2">10m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:41
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3">
                                                <div class="avatar-name rounded-circle"><span>J</span></div>
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jane Foster</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>📅</span>Created an event.<span
                                                        class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:20
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-0 border-top border-0">
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                href="pages/notifications.html">Notification
                                history</a></div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!"
                role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-l ">
                    <img class="rounded-circle " src="{{ asset('/template/assets/img/team/72x72/57.webp') }}"
                        alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                    <div class="card-body p-0">
                        <div class="text-center pt-4 pb-3">
                            <div class="avatar avatar-xl ">
                                <img class="rounded-circle "
                                    src="{{ asset('/template/assets/img/team/72x72/57.webp') }}" alt="" />
                            </div>
                            <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="overflow-auto scrollbar" style="height: 4rem;">
                        <ul class="nav d-flex flex-column mb-2 pb-1">
                            <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}"> <span
                                        class="me-2 text-900" data-feather="user"></span><span>Perfil</span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-footer p-0 border-top">

                        <hr />
                        <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <span class="me-2" data-feather="log-out"> </span>
                            Cerrar sesión
                        </a>
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                href="#!">Política
                                de privacidad</a>&bull;<a class="text-600 mx-1" href="#!">Términos</a>&bull;<a
                                class="text-600 ms-1" href="#!">Cookies</a></div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

<nav class="navbar navbar-top navbar-slim justify-content-between fixed-top navbar-expand-lg" id="navbarTopSlim"
    style="display:none;">
    <div class="navbar-logo">
        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
            aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button>
        <a class="navbar-brand navbar-brand" href="index.html">phoenix <span
                class="text-1000 d-none d-sm-inline">slim</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
        id="navbarTopCollapse">
        <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    Configuración
                </a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                    <li>
                        <a class="dropdown-item active" href="index.html">
                            <div class="dropdown-item-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                &nbsp;&nbsp;Usuarios
                            </div>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="dashboard/project-management.html">
                            <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                    data-feather="clipboard"></span>Permisos
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
            <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                    type="checkbox" data-theme-control="phoenixTheme" value="dark" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                        class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
                        class="fs--1 fw-bold">Dark</span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                        class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
                        class="fs--1 fw-bold">Light</span></label></div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" id="navbarDropdownNotification" href="#" role="button"
                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                aria-expanded="false"><span data-feather="bell" style="height:12px;width:12px;"></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                <div class="card position-relative border-0">
                    <div class="card-header p-2">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-black mb-0">Notificatons</h5>
                            <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as
                                read</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="scrollbar-overlay" style="height: 27rem;">
                            <div class="border-300">
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle"
                                                    src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-400 fw-bold fs--2">10m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:41
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3">
                                                <div class="avatar-name rounded-circle"><span>J</span></div>
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jane Foster</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>📅</span>Created an event.<span
                                                        class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:20
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-0 border-top border-0">
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                href="pages/notifications.html">Notification
                                history</a></div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser"
                href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                data-bs-auto-close="outside" aria-expanded="false">Olivia <span
                    class="fa-solid fa-chevron-down fs--2"></span></a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                    <div class="card-body p-0">
                        <div class="text-center pt-4 pb-3">
                            <div class="avatar avatar-xl ">
                                <img class="rounded-circle "
                                    src="{{ asset('/template/assets/img/team/72x72/57.webp') }}" alt="" />
                            </div>
                            <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="overflow-auto scrollbar" style="height: 4rem;">
                        <ul class="nav d-flex flex-column mb-2 pb-1">
                            <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}"> <span
                                        class="me-2 text-900" data-feather="user"></span><span>Perfil</span></a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="lock"></span>Posts &amp; Activity</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="settings"></span>Settings &amp; Privacy </a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="globe"></span>Language</a></li> -->
                        </ul>
                    </div>
                    <div class="card-footer p-0 border-top">
                        <!-- <ul class="nav d-flex flex-column my-3">
                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="user-plus"></span>Add another account</a></li>
                        </ul> -->
                        <hr />
                        <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <span class="me-2" data-feather="log-out"> </span>
                            Cerrar sesión
                        </a>
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                href="#!">Política
                                de privacidad</a>&bull;<a class="text-600 mx-1" href="#!">Términos</a>&bull;<a
                                class="text-600 ms-1" href="#!">Cookies</a></div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>


<nav class="navbar navbar-top fixed-top navbar-expand-lg fondo-degradado" id="navbarCombo" data-navbar-top="combo"
    data-move-target="#navbarVerticalNav" style="display:none;">
    <div class="navbar-logo">
        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="index.html">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center"><img src="{{ asset('/recursos/logo.png') }}"
                        alt="phoenix" width="100" />
                    <!-- <p class="logo-text ms-2 d-none d-sm-block">phoenix</p> -->
                </div>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
        id="navbarTopCollapse">
        <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    &nbsp;Configuración
                </a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                    <li>
                        <a class="dropdown-item active" href="index.html">
                            <div class="dropdown-item-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                &nbsp;&nbsp;Usuarios
                            </div>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="dashboard/project-management.html">
                            <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                    data-feather="clipboard"></span>Permisos
                            </div>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2"><input
                    class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                    data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                        data-feather="moon"></span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                        data-feather="sun"></span></label>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" style="min-width: 2.5rem" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                data-bs-auto-close="outside"><span data-feather="bell" style="height:20px;width:20px;"></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                <div class="card position-relative border-0">
                    <div class="card-header p-2">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-black mb-0">Notificatons</h5>
                            <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as
                                read</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="scrollbar-overlay" style="height: 27rem;">
                            <div class="border-300">
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle"
                                                    src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-400 fw-bold fs--2">10m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:41
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3">
                                                <div class="avatar-name rounded-circle"><span>J</span></div>
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jane Foster</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>📅</span>Created an event.<span
                                                        class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:20
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-0 border-top border-0">
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                href="pages/notifications.html">Notification
                                history</a></div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!"
                role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-l ">
                    <img class="rounded-circle " src="{{ asset('/template/assets/img/team/72x72/57.webp') }}"
                        alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                    <div class="card-body p-0">
                        <div class="text-center pt-4 pb-3">
                            <div class="avatar avatar-xl ">
                                <img class="rounded-circle "
                                    src="{{ asset('/template/assets/img/team/72x72/57.webp') }}" alt="" />
                            </div>
                            <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="overflow-auto scrollbar" style="height: 4rem;">
                        <ul class="nav d-flex flex-column mb-2 pb-1">
                            <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}"> <span
                                        class="me-2 text-900" data-feather="user"></span><span>Perfil</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer p-0 border-top">
                        <hr />
                        <div class="px-3">
                            <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <span class="me-2" data-feather="log-out"> </span>
                                Cerrar sesión
                            </a>
                        </div>

                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                href="#!">Política
                                de privacidad</a>&bull;<a class="text-600 mx-1" href="#!">Términos</a>&bull;<a
                                class="text-600 ms-1" href="#!">Cookies</a></div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

<nav class="navbar navbar-top fixed-top navbar-slim justify-content-between navbar-expand-lg" id="navbarComboSlim"
    data-navbar-top="combo" data-move-target="#navbarVerticalNav" style="display:none;">
    <div class="navbar-logo">
        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        <a class="navbar-brand navbar-brand" href="index.html">phoenix <span
                class="text-1000 d-none d-sm-inline">slim</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
        id="navbarTopCollapse">
        <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    Configuración
                </a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                    <li>
                        <a class="dropdown-item active" href="index.html">
                            <div class="dropdown-item-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                &nbsp;&nbsp;Usuarios
                            </div>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="dashboard/project-management.html">
                            <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                    data-feather="clipboard"></span>Permisos
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
            <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                    type="checkbox" data-theme-control="phoenixTheme" value="dark" /><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                        class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
                        class="fs--1 fw-bold">Dark</span></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                        class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
                        class="fs--1 fw-bold">Light</span></label></div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" id="navbarDropdownNotification" href="#" role="button"
                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                aria-expanded="false"><span data-feather="bell" style="height:12px;width:12px;"></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
                id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                <div class="card position-relative border-0">
                    <div class="card-header p-2">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-black mb-0">Notificatons</h5>
                            <button class="btn btn-link p-0 fs--1 fw-normal" type="button">Mark all as
                                read</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="scrollbar-overlay" style="height: 27rem;">
                            <div class="border-300">
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative read border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle"
                                                    src="{{ asset('/template/assets/img/team/40x40/30.webp') }}"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jessie Samson</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-400 fw-bold fs--2">10m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:41
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 border-300 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3">
                                                <div class="avatar-name rounded-circle"><span>J</span></div>
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs--1 text-black">Jane Foster</h4>
                                                <p class="fs--1 text-1000 mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs--2'>📅</span>Created an event.<span
                                                        class="ms-2 text-400 fw-bold fs--2">20m</span></p>
                                                <p class="text-800 fs--1 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:20
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="font-sans-serif d-none d-sm-block">
                                            <button
                                                class="btn fs--2 btn-sm dropdown-toggle dropdown-caret-none transition-none notification-dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs--2 text-900"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                    class="dropdown-item" href="#!">Mark as
                                                    unread</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-0 border-top border-0">
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                                href="pages/notifications.html">Notification
                                history</a></div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser"
                href="#!" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                data-bs-auto-close="outside" aria-expanded="false">Olivia <span
                    class="fa-solid fa-chevron-down fs--2"></span></a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
                aria-labelledby="navbarDropdownUser">
                <div class="card position-relative border-0">
                    <div class="card-body p-0">
                        <div class="text-center pt-4 pb-3">
                            <div class="avatar avatar-xl ">
                                <img class="rounded-circle "
                                    src="{{ asset('/template/assets/img/team/72x72/57.webp') }}" alt="" />
                            </div>
                            <h6 class="mt-2 text-black">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="overflow-auto scrollbar" style="height: 4rem;">
                        <ul class="nav d-flex flex-column mb-2 pb-1">
                            <li class="nav-item"><a class="nav-link px-3" href="{{ url('perfil') }}"> <span
                                        class="me-2 text-900" data-feather="user"></span><span>Perfil</span></a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="lock"></span>Posts &amp; Activity</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="settings"></span>Settings &amp; Privacy </a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
                            <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="globe"></span>Language</a></li> -->
                        </ul>
                    </div>
                    <div class="card-footer p-0 border-top">
                        <!-- <ul class="nav d-flex flex-column my-3">
                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-900" data-feather="user-plus"></span>Add another account</a></li>
                        </ul> -->
                        <hr />
                        <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <span class="me-2" data-feather="log-out"> </span>
                            Cerrar sesión
                        </a>
                        <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                                href="#!">Política
                                de privacidad</a>&bull;<a class="text-600 mx-1" href="#!">Términos</a>&bull;<a
                                class="text-600 ms-1" href="#!">Cookies</a></div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
<div class="modal fade" id="TicketUsuario" tabindex="-1" aria-labelledby="TicketUsuarioLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Cambiado de modal-dialog a modal-xl -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TicketUsuarioLabel">Crear nuevo
                    ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" name="formArchivo" class="cliente" action="{{ url('crear_ticket') }}"
                    id="formArchivo" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleTextarea">Usuario:</label>
                                    <select class="form-select select3" name="user" id="user"
                                        data-choices="data-choices"
                                        data-options='{"removeItemButton":true,"placeholder":true}' required>
                                        <option value="" selected="" disabled=""> -- Seleccione
                                            Usuario --</option>
                                        @foreach ($all_user as $user)
                                            <option value="{{ $user->id }}"> {{ $user->username }} </option>
                                        @endforeach
                                    </select>
                                    <!-- <select class="form-select" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'> -->
                                </div>

                                <div>
                                    <label for="subcategoria_select">Seleccionar equipo:</label>
                                    <select class="form-select select3" id="subcategoria_select"
                                        name="subcategoria_select">
                                        <option value="">Seleccionar un equipo</option>
                                        <!-- Las opciones se cargarán dinámicamente -->
                                    </select>
                                </div>
                                <br>
                                <!-- Primer campo de selección -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleTextarea">Categoría</label>
                                    <select class="form-select select33" name="id_categoria" id="id_categoria"
                                        data-choices="data-choices"
                                        data-options='{"removeItemButton":true,"placeholder":true}' required>
                                        <option value="" selected="" disabled=""> -- Seleccione una
                                            Categoría --
                                        </option>
                                        @foreach ($atenciones as $atencion)
                                            <option value="{{ $atencion->id }}"> {{ $atencion->nombre }} </option>
                                        @endforeach
                                    </select>
                                    <!-- <select class="form-select" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'> -->
                                </div>
                                <div class="mb-0">
                                    <label class="form-label" for="exampleTextarea">Ingrese el
                                        detalle del
                                        requerimiento/incidencia</label>
                                    <textarea class="form-control" id="requerimiento" name="requerimiento" placeholder="Detalle de ticket"
                                        rows="3" maxlength="200" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="formFileMultiple">
                                        Seleccione sus archivos adjuntos
                                        <font color="red">(Máximo 3
                                            archivos)</font>
                                    </label>
                                    <input class="form-control archivo" id="archivo" name="archivos[]"
                                        accept=".pdf, .docx, .xlsx, .xls, .png" type="file" multiple="multiple"
                                        onchange="validarArchivos(event)" />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row col-md-6">
                        </div> -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Evento cuando cambia la selección en el primer select
    $('#user').on('change', function() {
        var user = $(this).val(); // Obtenemos el valor seleccionado en el primer select
        if (user) {
            // Realizamos la solicitud AJAX para obtener las subcategorías
            console.log('Seleccionado:', user);
            $.ajax({
                url: '{{ route('get.dato') }}', // Ruta definida en Laravel
                type: 'GET',
                data: {
                    user: user
                },
                success: function(response) {
                    // Limpiar el segundo select antes de agregar nuevas opciones
                    $('#subcategoria_select').empty();

                    // Si la respuesta es exitosa, agregar las opciones al segundo select
                    if (response.success) {
                        $('#subcategoria_select').append(
                            '<option value="">Selecciona un equipo</option>');
                        $.each(response.subcategorias, function(key, subcategoria) {
                            $('#subcategoria_select').append(
                                '<option value="' + subcategoria.id + '">' +
                                subcategoria.tipo + ' ' + subcategoria.modelo + ' - ' +
                                subcategoria.serial + '</option>'
                            );
                        });
                    } else {
                        $('#subcategoria_select').append(
                            '<option value="">No se encontraron subcategorías</option>');
                    }
                },
                error: function() {
                    // Manejo de errores
                    $('#subcategoria_select').empty().append(
                        '<option value="">Hubo un error al cargar las subcategorías</option>');
                }
            });
        } else {
            // Si no hay categoría seleccionada, limpiar el segundo select
            $('#subcategoria_select').empty().append('<option value="">Selecciona una subcategoría</option>');
        }
    });
</script>
<script>
    var navbarTopShape = window.config.config.phoenixNavbarTopShape;
    var navbarPosition = window.config.config.phoenixNavbarPosition;
    var body = document.querySelector('body');
    var navbarDefault = document.querySelector('#navbarDefault');
    var navbarTop = document.querySelector('#navbarTop');
    var topNavSlim = document.querySelector('#topNavSlim');
    var navbarTopSlim = document.querySelector('#navbarTopSlim');
    var navbarCombo = document.querySelector('#navbarCombo');
    var navbarComboSlim = document.querySelector('#navbarComboSlim');
    var dualNav = document.querySelector('#dualNav');

    var documentElement = document.documentElement;
    var navbarVertical = document.querySelector('.navbar-vertical');

    if (navbarPosition === 'dual-nav') {
        topNavSlim.remove();
        navbarTop.remove();
        navbarVertical.remove();
        navbarTopSlim.remove();
        navbarCombo.remove();
        navbarComboSlim.remove();
        navbarDefault.remove();
        dualNav.removeAttribute('style');
        documentElement.classList.add('dual-nav');
    } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
        navbarDefault.remove();
        navbarTop.remove();
        navbarTopSlim.remove();
        navbarCombo.remove();
        navbarComboSlim.remove();
        topNavSlim.style.display = 'block';
        navbarVertical.style.display = 'inline-block';
        body.classList.add('nav-slim');
    } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
        navbarDefault.remove();
        navbarVertical.remove();
        navbarTop.remove();
        topNavSlim.remove();
        navbarCombo.remove();
        navbarComboSlim.remove();
        navbarTopSlim.removeAttribute('style');
        body.classList.add('nav-slim');
    } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
        navbarDefault.remove();
        //- navbarVertical.remove();
        navbarTop.remove();
        topNavSlim.remove();
        navbarCombo.remove();
        navbarTopSlim.remove();
        navbarComboSlim.removeAttribute('style');
        navbarVertical.removeAttribute('style');
        body.classList.add('nav-slim');
    } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
        navbarDefault.remove();
        topNavSlim.remove();
        navbarVertical.remove();
        navbarTopSlim.remove();
        navbarCombo.remove();
        navbarComboSlim.remove();
        navbarTop.removeAttribute('style');
        documentElement.classList.add('navbar-horizontal');
    } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
        topNavSlim.remove();
        navbarTop.remove();
        navbarTopSlim.remove();
        navbarDefault.remove();
        navbarComboSlim.remove();
        navbarCombo.removeAttribute('style');
        navbarVertical.removeAttribute('style');
        documentElement.classList.add('navbar-combo')

    } else {
        topNavSlim.remove();
        navbarTop.remove();
        navbarTopSlim.remove();
        navbarCombo.remove();
        navbarComboSlim.remove();
        navbarDefault.removeAttribute('style');
        navbarVertical.removeAttribute('style');
    }

    var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
    var navbarTop = document.querySelector('.navbar-top');
    if (navbarTopStyle === 'darker') {
        navbarTop.classList.add('navbar-darker');
    }

    var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
    var navbarVertical = document.querySelector('.navbar-vertical');
    if (navbarVerticalStyle === 'darker') {
        navbarVertical.classList.add('navbar-darker');
    }
</script>
