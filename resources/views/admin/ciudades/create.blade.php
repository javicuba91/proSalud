@extends('adminlte::page')

@section('title', 'Crear Ciudad')

@section('content_header')
    <h1>Crear Ciudad</h1>
@stop

@section('content')
    <form action="{{ route('ciudades.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="provincia_id">Provincia</label>
            <select name="provincia_id" id="provincia_id" class="form-control" required>
                <option value="">Seleccionar provincia asociada a la ciudad </option>
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('ciudades.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
