@extends('frontend.profesionales.layout')

<title>@yield('title', 'ProSalud - Beneficios')</title>

@section('content')
    <div class="container py-5 text-center">
        <h2>Beneficios de unirme</h2>
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
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Potenciar tu consultorio</h5>
                        <p class="card-text">Deja atrás tu gestión tradicional e impulsa tu productividad hasta un 25% con
                            la digitalización de tu clínica.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 2 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reducir absentismo</h5>
                        <p class="card-text">Aumenta las reservas y mejora la asistencia, reduciendo hasta un 35% el
                            absentismo de pacientes.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 3 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ahorrar tiempo</h5>
                        <p class="card-text">Reduzca el tiempo que se espera en tu centro con la automatización de tareas
                            manuales y simplifique su trabajo diario.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 4 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Impulsar la reputación online</h5>
                        <p class="card-text">Aumenta tu visibilidad con un 42% con nuestro portal médico. Asegura que los
                            pacientes potenciales te encuentren con reseñas positivas.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 5 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Incrementar fidelización</h5>
                        <p class="card-text">Incrementa la fidelización de pacientes en un 30%. Potencia su contacto
                            mediante notificaciones de valor y recordatorios.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 6 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Consultar estadísticas</h5>
                        <p class="card-text">Consulta estadísticas de forma centralizada para mejorar tu indicador de éxito
                            con datos integrados.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta 7 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{asset('assets/img/placeholder.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mayor visibilidad</h5>
                        <p class="card-text">Aumenta tu visibilidad, permitiendo que los usuarios encuentren fácilmente tus
                            servicios de salud en sus plataformas favoritas.</p>
                        <a href="#" class="btn btn-outline-dark">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
