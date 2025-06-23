@extends('adminlte::page')

@section('title', 'Editar Especialidad')

@section('content_header')
    <h1>Editar Especialidad</h1>
@stop

@section('content')
    <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Para indicar que la solicitud es de tipo PUT -->

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                value="{{ old('nombre', $especialidad->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $especialidad->descripcion) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

@stop
