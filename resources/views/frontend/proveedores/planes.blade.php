@extends('frontend.proveedores.layout')

<title>@yield('title', 'ProSalud - Planes')</title>

@section('content')
    <div class="container py-5 text-center">
        <h2>Planes y Precios</h2>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur.
        </p>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach ($planes as $plan)
                <div class="col-md-4 mb-4">
                    <div class="plan-card h-100">
                        <div class="plan-header">
                            <div>{{ $plan->nombre }}</div>
                            <div class="plan-price">{{ $plan->precio }}€<small class="text-muted">/mes</small></div>
                        </div>
                        <p class="mt-3 text-muted">{{ $plan->descripcion }}</p>
                        <ul class="mt-3">
                            @foreach (json_decode($plan->caracteristicas) as $caracteristica)
                                <li class="text-decoration-none">{{ $caracteristica }}</li>
                            @endforeach
                        </ul>
                        <a href="#" class="btn btn-outline-dark btn-sm w-50">Seleccionar</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection()
