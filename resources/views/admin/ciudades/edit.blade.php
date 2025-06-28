@extends('adminlte::page')

@section('title', 'Editar Ciudad')

@section('content_header')
    <h1>Editar Ciudad</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ciudades.update', $ciudad->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $ciudad->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="provincia_id">Provincia</label>
                    <select name="provincia_id" id="provincia_id" class="form-control @error('provincia_id') is-invalid @enderror" required>
                        <option value="">Seleccione una provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}" {{ old('provincia_id', $ciudad->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                {{ $provincia->nombre }} ({{ $provincia->region->nombre }})
                            </option>
                        @endforeach
                    </select>
                    @error('provincia_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('ciudades.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Editar Ciudad!');
    </script>
@stop
