@extends('adminlte::page')

@section('title', 'Detalles del Método de Pago')

@section('content_header')
    <h1>Detalles del Método de Pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información del Método de Pago</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> {{ $metodo->nombre }}</p>
                    <p><strong>Fecha de Creación:</strong> {{ $metodo->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Última Actualización:</strong> {{ $metodo->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('metodos-pagos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('metodos-pagos.edit', $metodo) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Detalles de Método de Pago!');
    </script>
@stop
