@extends('adminlte::page')

@section('title', 'Crear Especialidad')

@section('content_header')
    <h1>Crear Especialidad</h1>
@stop

@section('content')
    <form action="{{ route('especialidades.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop
