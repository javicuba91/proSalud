@extends('adminlte::page')

@section('title', 'Detalle de Pago')

@section('content_header')
    <h1>Detalle de Pago</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Profesional: {{ $suscripcion->profesional->nombre_completo ?? 'N/A' }}</h5>
            <h5>Plan: {{ $suscripcion->plan->nombre ?? 'N/A' }}</h5>
            <h5>Estado de Pago: 
                @if($suscripcion->pagado)
                    <span class="badge badge-success">Pagado</span>
                @else
                    <span class="badge badge-warning">Pendiente</span>
                @endif
            </h5>
            <a href="{{ route('facturacion.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
