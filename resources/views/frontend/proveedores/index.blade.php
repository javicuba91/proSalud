@extends('frontend.proveedores.layout')

<title>@yield('title', 'ProSalud - Inicio')</title>

@section('content')

<section class="hero-section mt-5">
    <h2>Más clientes, más visibilidad,<br> más crecimiento</h2>
    <p>
        Nuestra plataforma conecta tu negocio con<br> pacientes y médicos en busca de servicios como<br> el tuyo.
    </p>
    <a href="/proveedores/registro" class="btn btn-dark">Unirme</a>
    <a style="border-radius: 0px" href="/proveedores/beneficios" class="btn btn-outline-secondary">Beneficios de unirme</a>
</section>


@endsection()