@extends('adminlte::page')

@section('title', 'Detalles del Plan')

@section('content_header')
    <h1>Detalles del Plan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información del Plan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> {{ $plan->nombre }}</p>
                    <p><strong>Descripción:</strong></p>
                    <p class="text-justify">{{ $plan->descripcion }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($plan->precio, 2) }}</p>
                    <p><strong>Características:</strong></p>
                    <p class="text-justify">{{ $plan->caracteristicas }}</p>
                    <p><strong>Fecha de Creación:</strong> {{ $plan->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Última Actualización:</strong> {{ $plan->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('planes.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('planes.edit', $plan) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Detalles de Plan!');
    </script>
@stop
