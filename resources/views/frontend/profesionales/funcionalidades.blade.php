@extends('frontend.profesionales.layout')

<title>@yield('title', 'ProSalud - Funcionalidades')</title>

@section('content')
    <div class="container py-5 text-center">
        <h2>Funcionalidades</h2>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur.
        </p>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">

            <!-- Tarjeta 1 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Visibilidad online</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Perfil profesional</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Acceso a la plataforma web y app</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 4 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Agenda de citas</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 5 (opcionalmente difuminada si es "Reservas online desactivado") -->
            <div class="col">
                <div class="card h-100 text-center opacity-50">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reserva online</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 6 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Videoconsulta</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 7 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Elaboración de pedidos de pruebas para laboratorio</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 8 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mensajes automatizados</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 9 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Historia clínica digital</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 10 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Elaboración de recetas digitales</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 11 -->
            <div class="col">
                <div class="card h-100 text-center">
                    <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Recepción de resultados de laboratorio e imágenes de forma digital</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection()
