@extends('adminlte::page')

@section('title', 'Crear Medicamento')

@section('content_header')
    <h1>Crear Medicamento</h1>
@stop

@section('content')
    <form action="{{ route('medicamentos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
