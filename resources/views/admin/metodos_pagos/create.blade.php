@extends('adminlte::page')

@section('title', 'Crear Metodo de Pago')

@section('content_header')
    <h1>Crear Metodo de Pago</h1>
@stop

@section('content')
    <form action="{{ route('metodos-pagos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop
