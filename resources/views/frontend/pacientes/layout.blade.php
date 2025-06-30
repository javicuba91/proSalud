<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Pacientes')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="container">

        {{-- Top Bar --}}
        <div class="top-bar d-flex justify-content-between align-items-center p-2 bg-light">
            <div>
                <button class="btn btn-outline-secondary btn-sm">Elegir idioma</button>
            </div>
            <div>
                @if (Auth::user())
                <a href="/paciente/pedir-cita" class="btn btn-dark btn-sm me-2">Hola,{{Auth::user()->name}}</a>
                @endif

                <a href="/profesionales/registro" class="btn btn-outline-secondary btn-sm me-2">Soy médico o profesional
                    de la salud</a>
                <a href="/proveedores/registro" class="btn btn-outline-secondary btn-sm">Soy farmacia o proveedor</a>
            </div>
        </div>

        {{-- Responsive Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">
                    <div class="navbar-brand-box d-inline-block me-2"></div> LOGOTIPO
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item"><a href="/pacientes" class="nav-link">Inicio</a></li>
                        <li class="nav-item"><a href="/pacientes/preguntas-expertos" class="nav-link">Preguntas y Respuestas</a></li>
                        <li class="nav-item"><a href="{{route('pacientes.blog')}}" class="nav-link">Blog</a></li>

                        @guest
                            <li class="nav-item"><a href="/pacientes/login" class="nav-link">Iniciar sesión</a></li>
                            <li class="nav-item"><a href="/pacientes/registro" class="nav-link">Registrarme</a></li>
                        @endguest

                        @auth
                            <li class="nav-item">
                                <a href="#" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth

                        <li class="nav-item"><a href="#" class="nav-link">Ayuda</a></li>
                        <li class="nav-item"><a href="/pacientes/contacto" class="nav-link">Contacto</a></li>
                        <li class="nav-item mt-2 mt-lg-0">
                            <a href="/pacientes/login" class="btn btn-dark btn-unirme ms-lg-2">Pedir Cita</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')


        <footer class="mt-5 border-top pt-4 pb-2">
            <div class="container">
                <div class="row align-items-start">
                    {{-- Logotipo --}}
                    <div class="col-md-10 mb-3">
                        <div class="d-flex align-items-center">
                            <div style="width: 20px; height: 20px; background-color: #999; margin-right: 10px;"></div>
                            <span class="text-muted fw-bold" style="font-size: 18px;">LOGOTIPO</span>
                        </div>
                    </div>

                    {{-- Enlaces de navegación --}}
                    <div class="col-md-2">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#" class="text-dark text-decoration-none">Inicio</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Beneficios de unirme</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Funcionalidades</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Planes y precios</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Contacto</a></li>
                            <li><a href="#" class="text-dark text-decoration-none">Login/registro</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Línea inferior --}}
                <div class="d-flex justify-content-between flex-wrap mt-4 pt-3 border-top small">
                    <div>
                        Proyecto desarrollado por <strong>CODIGOBETA</strong>
                    </div>
                    <div class="text-end">
                        <a href="#" class="text-dark text-decoration me-2">Política de cookies</a>
                        <a href="#" class="text-dark text-decoration me-2">Aviso legal</a>
                        <a href="#" class="text-dark text-decoration me-2">Política de privacidad</a>
                        <span class="text-muted">Copyright © {{ date('Y') }}</span>
                    </div>
                </div>
            </div>
        </footer>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    @yield('js')
</body>

</html>
