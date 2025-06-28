@extends('adminlte::page')

@section('title', 'Crear Respuesta')

@section('content_header')
    <h1>Crear Respuesta de Experto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('respuestas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="preguntas_expertos_id">Pregunta <span class="text-danger">*</span></label>
                    <select name="preguntas_expertos_id" id="preguntas_expertos_id"
                        class="form-control @error('preguntas_expertos_id') is-invalid @enderror" required>
                        <option value="">Seleccione una pregunta</option>
                        @foreach ($preguntas as $pregunta)
                            <option value="{{ $pregunta->id }}"
                                {{ old('preguntas_expertos_id') == $pregunta->id ? 'selected' : '' }}>
                                <strong>{{ $pregunta->especialidad->nombre ?? 'Sin especialidad' }}</strong>
                                @if ($pregunta->subespecialidad)
                                    / {{ $pregunta->subespecialidad->nombre }}
                                @endif
                                -> {{ Str::limit($pregunta->pregunta, 100) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="profesional_id">Profesional <span class="text-danger">*</span></label>
                    <select name="profesional_id" id="profesional_id" class="form-control" required disabled>
                        <option value="">Seleccione una pregunta primero</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="respuesta">Respuesta <span class="text-danger">*</span></label>
                    <textarea name="respuesta" id="respuesta" class="form-control" rows="6" required
                        placeholder="Escriba aquí la respuesta del experto...">{{ old('respuesta') }}</textarea>
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
            $('#preguntas_expertos_id').on('change', function() {
                var preguntaId = $(this).val();
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
                            profesionalSelect.html(
                                '<option value="">Seleccione un profesional</option>');

                            if (response.length > 0) {
                                $.each(response, function(index, profesional) {
                                    var selected = '';
                                    // Mantener selección si viene de old()
                                    @if (old('profesional_id'))
                                        if (profesional.id ==
                                            {{ old('profesional_id') }}) {
                                            selected = 'selected';
                                        }
                                    @endif

                                    profesionalSelect.append(
                                        '<option value="' + profesional.id + '" ' +
                                        selected + '>' + profesional.nombre_completo +
                                        '</option>'
                                    );
                                });
                            } else {
                                profesionalSelect.append(
                                    '<option value="">No hay profesionales disponibles para esta especialidad</option>'
                                    );
                            }

                            profesionalSelect.prop('disabled', false);
                        },
                    });
                } else {
                    // Si no hay pregunta seleccionada, deshabilitar select de profesionales
                    profesionalSelect.html('<option value="">Seleccione una pregunta primero</option>');
                    profesionalSelect.prop('disabled', true);
                }
            });

            // Si hay una pregunta seleccionada al cargar la página (old value), cargar sus profesionales
            @if (old('preguntas_expertos_id'))
                $('#preguntas_expertos_id').trigger('change');
            @endif
        });
    </script>
@stop
