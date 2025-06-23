@extends('adminlte::page')

@section('title', 'Mis Planes')

@section('content_header')
    <h1>Mis Planes</h1>
@stop

@section('content')
    <style>
        .plan-card {
            border: 1px solid #dee2e6;
            padding: 2rem;
            background-color: #f8f9fa;
            height: 100%;
        }

        .plan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .plan-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .plan-current {
            background-color: #dee2e6;
            color: black;
        }

        .btn-plan {
            margin-top: 1.5rem;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($profesional->suscripcion)
        <div class="mt-3 text-center">
            <strong>Inicio:</strong> {{ date("d-m-y",strtotime($profesional->suscripcion->fecha_inicio)) }}<br>
            <strong>Vence:</strong> {{ date("d-m-y",strtotime($profesional->suscripcion->fecha_fin)) }}
        </div>
    @endif


    <div class="row mb-2">
        <!-- Planes -->
        @foreach ($planes as $plan)
            <div class="col-md-4 mb-2">
                <form method="POST" action="{{ route('profesional.elegir.plan') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <div class="plan-card {{ $profesional->plan_id === $plan->id ? 'plan-current' : '' }}">
                        <div class="plan-header">
                            <div>{{ $plan->nombre }}</div>
                            <div class="plan-price">{{ $plan->precio }}$</div>
                        </div>
                        <p class="mt-3">{{ $plan->descripcion }}</p>
                        <ul class="mt-3">
                            @foreach (json_decode($plan->caracteristicas) as $caracteristica)
                                <li>{{ $caracteristica }}</li>
                            @endforeach
                        </ul>

                        @if ($profesional->plan_id === $plan->id)
                            <button class="btn btn-dark w-100 mt-3" disabled>Plan actual</button>
                        @else
                            <button type="submit" class="btn btn-outline-dark w-100 mt-3">Cambiar a este plan</button>
                        @endif
                    </div>
                </form>
            </div>
        @endforeach


    </div>
@stop
