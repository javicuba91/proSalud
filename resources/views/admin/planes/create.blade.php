@extends('adminlte::page')

@section('title', 'Crear Plan')

@section('content_header')
    <h1>Crear Plan</h1>
@stop

@section('content')
    <form action="{{ route('planes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea rows="6" name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="caracteristicas">Caracteristicas</label>
            <textarea rows="6" required name="caracteristicas" id="caracteristicas" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop
