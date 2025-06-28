@extends('adminlte::page')

@section('title', 'Crear Especialidad')

@section('content_header')
    <h1>Crear Especialidad y subespecialidad</h1>
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
        <div class="form-group">
            <label for="padre_id">Especialidad Padre (Opcional)</label>
            <select name="padre_id" id="padre_id" class="form-control">
                <option value="">Seleccione una especialidad padre para crear una subespecialidad asociada (dejar vacío para una especialidad principal)
                </option>
                @foreach ($especialidadesPadre as $especialidad)
                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">
                Si selecciona una especialidad padre, se creará una subespecialidad.
                Si deja vacío, será una especialidad principal.
            </small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
