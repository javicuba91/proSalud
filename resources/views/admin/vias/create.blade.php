@extends('adminlte::page')

@section('title', 'Crear Vía de Administración')

@section('content_header')
    <h1>Crear Vía de Administración</h1>
@stop

@section('content')
    <form action="{{ route('vias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('vias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
