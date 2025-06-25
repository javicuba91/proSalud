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

        <div class="form-group">
            <label for="padre_id">Especialidad Padre (Opcional)</label>
            <select name="padre_id" id="padre_id" class="form-control">
                <option value="">-- Sin especialidad padre (Especialidad principal) --</option>
                @foreach ($especialidadesPadre as $especialidadPadre)
                    <option value="{{ $especialidadPadre->id }}"
                        {{ old('padre_id', $especialidad->padre_id) == $especialidadPadre->id ? 'selected' : '' }}>
                        {{ $especialidadPadre->nombre }}
                        @if($especialidad->padre_id == $especialidadPadre->id)
                            (Actual)
                        @endif
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">
                @if($especialidad->padre_id)
                    <strong>Estado actual:</strong> Esta es una subespecialidad.
                    Puede cambiar la especialidad padre o convertirla en especialidad principal seleccionando "Sin especialidad padre".
                @else
                    <strong>Estado actual:</strong> Esta es una especialidad principal.
                    Puede convertirla en subespecialidad seleccionando una especialidad padre.
                @endif
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@stop
