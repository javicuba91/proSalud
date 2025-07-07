@extends('adminlte::page')

@section('title', 'Crear Especialidad Sanitaria')

@section('content_header')
    <h1>Crear Especialidad Sanitaria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nueva Especialidad Sanitaria</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('especialidades-sanitarios.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text"
                           class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           name="nombre"
                           value="{{ old('nombre') }}"
                           required
                           maxlength="255"
                           placeholder="Ingrese el nombre de la especialidad sanitaria">
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción *</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror"
                              id="descripcion"
                              name="descripcion"
                              rows="4"
                              required
                              placeholder="Ingrese una descripción de la especialidad">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría Profesional *</label>
                    <select class="form-control @error('categoria_id') is-invalid @enderror"
                            id="categoria_id"
                            name="categoria_id"
                            required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Crear
                    </button>
                    <a href="{{ route('especialidades-sanitarios.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#categoria_id').select2({
                placeholder: 'Seleccione una categoría',
                allowClear: true
            });
        });
    </script>
@stop
