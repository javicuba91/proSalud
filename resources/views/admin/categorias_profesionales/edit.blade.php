@extends('adminlte::page')

@section('title', 'Editar Categoría Profesional')

@section('content_header')
    <h1>Editar Categoría Profesional</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar: {{ $categoriaProfesional->nombre }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias-profesionales.update', $categoriaProfesional) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text"
                           class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           name="nombre"
                           value="{{ old('nombre', $categoriaProfesional->nombre) }}"
                           required
                           maxlength="255"
                           placeholder="Ingrese el nombre de la categoría profesional">
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror"
                              id="descripcion"
                              name="descripcion"
                              rows="4"
                              placeholder="Ingrese una descripción (opcional)">{{ old('descripcion', $categoriaProfesional->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="orden">Orden</label>
                    <input type="number"
                           class="form-control @error('orden') is-invalid @enderror"
                           id="orden"
                           name="orden"
                           value="{{ old('orden', $categoriaProfesional->orden) }}"
                           min="0"
                           placeholder="Ingrese el orden de visualización (opcional)">
                    @error('orden')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        El orden determina la posición en la que aparecerá la categoría en los listados.
                    </small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('categorias-profesionales.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: 600;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
    </style>
@stop
