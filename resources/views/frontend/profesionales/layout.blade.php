<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Profesionales')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <div class="top-bar d-flex justify-content-between align-items-center btnTopBar">
            <div>
                <button class="btn btn-outline-secondary btn-sm">Elegir idioma</button>
            </div>
            <div>
                <a href="/pacientes/registro" class="btn btn-outline-secondary btn-sm me-2">Soy paciente</a>
                <a href="/proveedores/registro" class="btn btn-outline-secondary btn-sm">Soy farmacia o proveedor de
                    servicios de salud</a>
            </div>
        </div>

        {{-- Navbar --}}
        <nav class="custom-navbar d-flex align-items-center">
            <a href="#" class="d-flex align-items-center text-decoration-none text-dark fw-bold">
                <div class="navbar-brand-box"></div> LOGOTIPO
            </a>
            <div class="ms-auto d-flex align-items-center">
                <a href="/profesionales" class="nav-link text-dark p-0">Inicio</a>
                <a href="/profesionales/beneficios" class="nav-link text-dark p-0">Beneficios de unirme</a>
                <a href="/profesionales/funcionalidades" class="nav-link text-dark p-0">Funcionalidades</a>
                <a href="/profesionales/planes" class="nav-link text-dark p-0">Planes y precios</a>
                <a href="/profesionales/contacto" class="nav-link text-dark p-0">Contacto</a>
                <a href="#" class="nav-link text-dark p-0">Ayuda</a>
                <a href="/profesionales/login" class="nav-link text-dark p-0">Iniciar sesión</a>
                <a href="/profesionales/registro" class="btn btn-dark btn-unirme">Unirme</a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ciudad-select').select2({               
                placeholder: 'Escribe o selecciona una ciudad',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return 'No se encontraron resultados';
                    }
                }
            });
        });
    </script>
    @yield('js')
</body>

</html>
