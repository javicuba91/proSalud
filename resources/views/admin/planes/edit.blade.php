@extends('adminlte::page')

@section('title', 'Editar Plan')

@section('content_header')
    <h1>Editar Plan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('planes.update', $plan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $plan->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4" required>{{ old('descripcion', $plan->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $plan->precio) }}" step="0.01" min="0" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="caracteristicas">Características</label>
                    <textarea name="caracteristicas" id="caracteristicas" class="form-control @error('caracteristicas') is-invalid @enderror" rows="4" required>{{ old('caracteristicas', $plan->caracteristicas) }}</textarea>
                    @error('caracteristicas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <a href="{{ route('planes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
        console.log('Editar Plan!');
    </script>
@stop
