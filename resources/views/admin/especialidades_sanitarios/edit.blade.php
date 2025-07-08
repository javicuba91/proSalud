@extends('adminlte::page')

@section('title', 'Editar Especialidad Sanitaria')

@section('content_header')
    <h1>Editar Especialidad Sanitaria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar: {{ $especialidadSanitario->nombre }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('especialidades-sanitarios.update', $especialidadSanitario) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text"
                           class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           name="nombre"
                           value="{{ old('nombre', $especialidadSanitario->nombre) }}"
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
                              placeholder="Ingrese una descripción de la especialidad">{{ old('descripcion', $especialidadSanitario->descripcion) }}</textarea>
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
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $especialidadSanitario->categoria_id) == $categoria->id ? 'selected' : '' }}>
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
                        <i class="fa fa-save"></i> Actualizar
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
