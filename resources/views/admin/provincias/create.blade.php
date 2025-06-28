@extends('adminlte::page')

@section('title', 'Crear Provincia')

@section('content_header')
    <h1>Crear Provincia</h1>
@stop

@section('content')
    <form action="{{ route('provincias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="region_id">Región</label>
            <select name="region_id" id="region_id" class="form-control" required>
                <option value="">Seleccionar region asociada a la provincia</option>
                @foreach ($regiones as $region)
                    <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('provincias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
