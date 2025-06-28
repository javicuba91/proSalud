@extends('adminlte::page')

@section('title', 'Crear Etiqueta del Blog')

@section('content_header')
    <h1>Crear Etiqueta del Blog</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('blog.etiquetas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror"
                              id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color">Color *</label>
                    <input type="color" class="form-control @error('color') is-invalid @enderror"
                           id="color" name="color" value="{{ old('color', '#6c757d') }}" required>
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('blog.etiquetas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
