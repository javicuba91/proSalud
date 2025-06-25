@extends('adminlte::page')

@section('title', 'Realizar Pago')

@section('content_header')
    <h1>Simulación de Pasarela de Pago</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Profesional: {{ $suscripcion->profesional->nombre_completo ?? 'N/A' }}</h5>
            <h5>Plan: {{ $suscripcion->plan->nombre ?? 'N/A' }}</h5>
            <h5>Monto: ${{ $suscripcion->plan->precio ?? '0.00' }}</h5>
            <form action="{{ route('facturacion.pagar.post', $suscripcion->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tarjeta">Número de Tarjeta</label>
                    <input type="text" name="tarjeta" class="form-control" required placeholder="1234 5678 9012 3456">
                </div>
                <div class="form-group">
                    <label for="vencimiento">Fecha de Vencimiento</label>
                    <input type="text" name="vencimiento" class="form-control" required placeholder="MM/AA">
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" class="form-control" required placeholder="123">
                </div>
                <button type="submit" class="btn btn-success">Pagar</button>
                <a href="{{ route('facturacion.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
