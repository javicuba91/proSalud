@extends('adminlte::page')

@section('title', 'Crear Pregunta')

@section('content_header')
    <h1>Crear Pregunta para Experto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('preguntas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="especialidad_id">Especialidad <span class="text-danger">*</span></label>
                    <select name="especialidad_id" id="especialidad_id" class="form-control @error('especialidad_id') is-invalid @enderror" required>
                        <option value="">Seleccione una especialidad</option>
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}" {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                                {{ $especialidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('especialidad_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_especialidad_id">Sub-especialidad</label>
                    <select name="sub_especialidad_id" id="sub_especialidad_id" class="form-control @error('sub_especialidad_id') is-invalid @enderror">
                        <option value="">Seleccione una especialidad primero</option>
                    </select>
                    @error('sub_especialidad_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pregunta">Pregunta <span class="text-danger">*</span></label>
                    <textarea name="pregunta" id="pregunta" class="form-control @error('pregunta') is-invalid @enderror" rows="4" required placeholder="Escriba aquí la pregunta para el experto...">{{ old('pregunta') }}</textarea>
                    @error('pregunta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#especialidad_id').on('change', function() {
            var especialidadId = $(this).val();
            var $subespecialidad = $('#sub_especialidad_id');

            // Limpiar el select de sub-especialidades
            $subespecialidad.html('<option value="">Cargando...</option>');

            if(especialidadId) {
                // Cargar sub-especialidades
                $.ajax({
                    url: "{{ route('preguntas.subespecialidades.especialidad', ':id') }}".replace(':id', especialidadId),
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">Seleccione una sub-especialidad (opcional)</option>';
                        data.forEach(function(s) {
                            var selected = "{{ old('sub_especialidad_id') }}" == s.id ? 'selected' : '';
                            options += '<option value="'+s.id+'" '+selected+'>'+s.nombre+'</option>';
                        });
                        $subespecialidad.html(options);
                    },
                    error: function() {
                        $subespecialidad.html('<option value="">Error al cargar sub-especialidades</option>');
                    }
                });
            } else {
                $subespecialidad.html('<option value="">Seleccione una especialidad primero</option>');
            }
        });

        // Si hay un valor old de especialidad, cargar las sub-especialidades
        @if(old('especialidad_id'))
            $('#especialidad_id').trigger('change');
        @endif
    });
    </script>
@stop
