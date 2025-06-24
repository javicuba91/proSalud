@extends('adminlte::page')

@section('title', 'Crear Presentación de Medicamento')

@section('content_header')
    <h1>Crear Presentación de Medicamento</h1>
@stop

@section('content')
    <form action="{{ route('presentaciones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('presentaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
