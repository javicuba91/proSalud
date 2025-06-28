@extends('adminlte::page')

@section('title', 'Crear Documento Profesional')

@section('content_header')
    <h1>Crear Documento Profesional</h1>
@stop

@section('content')
    <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="profesional_id">Profesional</label>
            <select name="profesional_id" id="profesional_id" class="form-control" required>
                <option value="">Seleccionar profesional...</option>
                @foreach ($profesionales as $profesional)
                    <option value="{{ $profesional->id }}">
                        {{ $profesional->user->name ?? 'Profesional ID: ' . $profesional->id }}
                    </option>
                @endforeach
            </select>
            @error('profesional_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nombre">Nombre del Documento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Documento</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Selecciona tipo</option>
                <option value="pdf">PDF</option>
                <option value="imagen">Imagen</option>
                <option value="otro">Otro</option>
            </select>
            @error('tipo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="documento">Archivo del Documento</label>
            <input type="file" name="documento" id="documento" class="form-control-file"
                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
            <small class="form-text text-muted">Formatos permitidos: PDF, DOC, DOCX, JPG, JPEG, PNG. Tamaño máximo:
                5MB</small>
            @error('documento')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('documentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Mostrar el nombre del archivo seleccionado
            $('#documento').change(function() {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $(this).next('.custom-file-label').html(fileName);
                }
            });
        });
    </script>
@stop
