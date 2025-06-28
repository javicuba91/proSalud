@extends('adminlte::page')

@section('title', 'Editar Pregunta')

@section('content_header')
    <h1>Editar Pregunta para Experto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('preguntas.update', $pregunta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="especialidad_id">Especialidad <span class="text-danger">*</span></label>
                    <select name="especialidad_id" id="especialidad_id" class="form-control @error('especialidad_id') is-invalid @enderror" required>
                        <option value="">Seleccione una especialidad</option>
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}"
                                {{ (old('especialidad_id', $pregunta->especialidad_id) == $especialidad->id) ? 'selected' : '' }}>
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
                        <option value="">Seleccione una sub-especialidad (opcional)</option>
                        <!-- Las opciones se cargarán vía JavaScript -->
                    </select>
                    @error('sub_especialidad_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pregunta">Pregunta <span class="text-danger">*</span></label>
                    <textarea name="pregunta" id="pregunta" class="form-control @error('pregunta') is-invalid @enderror"
                        rows="6" required placeholder="Escriba aquí la pregunta...">{{ old('pregunta', $pregunta->pregunta) }}</textarea>
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
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Función para cargar sub-especialidades
            function cargarSubespecialidades(especialidadId, selectedSubespecialidad = null) {
                if (especialidadId) {
                    $.ajax({
                        url: '{{ route('preguntas.subespecialidades.especialidad', '') }}/' + especialidadId,
                        type: 'GET',
                        success: function(response) {
                            var subespecialidadSelect = $('#sub_especialidad_id');
                            subespecialidadSelect.html('<option value="">Seleccione una sub-especialidad (opcional)</option>');

                            if (response.length > 0) {
                                $.each(response, function(index, subespecialidad) {
                                    var selected = (selectedSubespecialidad && subespecialidad.id == selectedSubespecialidad) ? 'selected' : '';
                                    subespecialidadSelect.append(
                                        '<option value="' + subespecialidad.id + '" ' + selected + '>' +
                                        subespecialidad.nombre + '</option>'
                                    );
                                });
                            }
                        },
                        error: function() {
                            console.error('Error al cargar sub-especialidades');
                        }
                    });
                } else {
                    $('#sub_especialidad_id').html('<option value="">Seleccione una sub-especialidad (opcional)</option>');
                }
            }

            // Cuando cambie la especialidad
            $('#especialidad_id').on('change', function() {
                var especialidadId = $(this).val();
                cargarSubespecialidades(especialidadId);
            });

            // Cargar sub-especialidades al inicializar si hay una especialidad seleccionada
            var especialidadInicial = $('#especialidad_id').val();
            var subespecialidadInicial = {{ old('sub_especialidad_id', $pregunta->sub_especialidad_id) ?? 'null' }};

            if (especialidadInicial) {
                cargarSubespecialidades(especialidadInicial, subespecialidadInicial);
            }
        });
    </script>
@stop
