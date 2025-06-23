@extends('frontend.profesionales.layout')

<title>@yield('title', 'ProSalud - Inicio')</title>

@section('content')

<section class="hero-section mt-5">
    <h2>Llega a más pacientes y haz crecer tu consulta</h2>
    <p>
        Únete a nuestra plataforma y ofrece tus servicios<br>
        médicos de forma presencial o por videollamada.<br>
        ¡Más visibilidad, más pacientes, más oportunidades!
    </p>
    <a href="/profesionales/registro" class="btn btn-dark">Unirme</a>
    <a style="border-radius: 0px" href="/profesionales/beneficios" class="btn btn-outline-secondary">Beneficios de unirme</a>
</section>


@endsection()