@extends('adminlte::page')

@section('title', 'Editar Provincia')

@section('content_header')
    <h1>Editar Provincia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('provincias.update', $provincia->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $provincia->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="region_id">Región</label>
                    <select name="region_id" id="region_id" class="form-control @error('region_id') is-invalid @enderror" required>
                        <option value="">Seleccione una región</option>
                        @foreach ($regiones as $region)
                            <option value="{{ $region->id }}" {{ old('region_id', $provincia->region_id) == $region->id ? 'selected' : '' }}>
                                {{ $region->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('provincias.index') }}" class="btn btn-secondary">Cancelar</a>
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
        console.log('Editar Provincia!');
    </script>
@stop
