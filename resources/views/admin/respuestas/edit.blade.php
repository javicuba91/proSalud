@extends('adminlte::page')

@section('title', 'Editar Respuesta')

@section('content_header')
    <h1>Editar Respuesta de Experto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('respuestas.update', $respuesta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="preguntas_expertos_id">Pregunta <span class="text-danger">*</span></label>
                    <select name="preguntas_expertos_id" id="preguntas_expertos_id"
                        class="form-control @error('preguntas_expertos_id') is-invalid @enderror" required>
                        <option value="">Seleccione una pregunta</option>
                        @foreach ($preguntas as $pregunta)
                            <option value="{{ $pregunta->id }}"
                                {{ old('preguntas_expertos_id', $respuesta->preguntas_expertos_id) == $pregunta->id ? 'selected' : '' }}>
                                @if($pregunta->categoria)
                                    <strong>[{{ $pregunta->categoria->nombre }}]</strong>
                                @endif
                                @if($pregunta->especialidad)
                                    {{ $pregunta->especialidad->nombre }}
                                @endif
                                @if($pregunta->subespecialidad)
                                    / {{ $pregunta->subespecialidad->nombre }}
                                @endif
                                -> {{ Str::limit($pregunta->pregunta, 100) }}
                            </option>
                        @endforeach
                    </select>
                    @error('preguntas_expertos_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profesional_id">Profesional <span class="text-danger">*</span></label>
                    <select name="profesional_id" id="profesional_id" class="form-control @error('profesional_id') is-invalid @enderror" required>
                        <option value="">Cargando profesionales...</option>
                    </select>
                    @error('profesional_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="respuesta">Respuesta <span class="text-danger">*</span></label>
                    <textarea name="respuesta" id="respuesta" class="form-control @error('respuesta') is-invalid @enderror" rows="6" required
                        placeholder="Escriba aquí la respuesta del experto...">{{ old('respuesta', $respuesta->respuesta) }}</textarea>
                    @error('respuesta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('respuestas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Función para cargar profesionales según la pregunta seleccionada
            function cargarProfesionales(preguntaId, selectedProfesional = null) {
                var profesionalSelect = $('#profesional_id');

                // Limpiar el select de profesionales
                profesionalSelect.html('<option value="">Cargando profesionales...</option>');
                profesionalSelect.prop('disabled', true);

                if (preguntaId) {
                    $.ajax({
                        url: '{{ route('respuestas.profesionales-by-pregunta') }}',
                        type: 'GET',
                        data: {
                            pregunta_id: preguntaId
                        },
                        success: function(response) {
                            profesionalSelect.html('<option value="">Seleccione un profesional</option>');

                            if (response.length > 0) {
                                $.each(response, function(index, profesional) {
                                    var selected = (selectedProfesional && profesional.id == selectedProfesional) ? 'selected' : '';
                                    profesionalSelect.append(
                                        '<option value="' + profesional.id + '" ' + selected + '>' +
                                        profesional.nombre_completo + '</option>'
                                    );
                                });
                            } else {
                                profesionalSelect.append(
                                    '<option value="">No hay profesionales disponibles para esta especialidad</option>'
                                );
                            }

                            profesionalSelect.prop('disabled', false);
                        },
                        error: function() {
                            profesionalSelect.html('<option value="">Error al cargar profesionales</option>');
                            profesionalSelect.prop('disabled', false);
                        }
                    });
                } else {
                    // Si no hay pregunta seleccionada, deshabilitar select de profesionales
                    profesionalSelect.html('<option value="">Seleccione una pregunta primero</option>');
                    profesionalSelect.prop('disabled', true);
                }
            }

            // Cuando cambie la pregunta
            $('#preguntas_expertos_id').on('change', function() {
                var preguntaId = $(this).val();
                cargarProfesionales(preguntaId);
            });

            // Cargar profesionales al inicializar si hay una pregunta seleccionada
            var preguntaInicial = $('#preguntas_expertos_id').val();
            var profesionalInicial = {{ old('profesional_id', $respuesta->profesional_id) ?? 'null' }};

            if (preguntaInicial) {
                cargarProfesionales(preguntaInicial, profesionalInicial);
            }
        });
    </script>
@stop
