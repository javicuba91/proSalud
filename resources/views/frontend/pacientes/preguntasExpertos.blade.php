@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Preguntas Expertos')</title>

@section('content')
    <div class="container p-4 formCompletoPreguntasExperto">

        @if (session('success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <form class="mb-3" action="{{ route('pacientes.enviar.preguntasExpertos') }}" method="post">
            @csrf
            <div class="row border p-4 formPreguntasExperto">
                <div class="col-lg-4 mb-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="conoceCategoria" name="conoce_categoria">
                        <label class="form-check-label" for="conoceCategoria">
                            Conozco la categoría
                        </label>
                    </div>
                    <select name="categoria_id" class="form-control form-select" id="selectCategoria" disabled>
                        <option value="-1">-- Seleccione categoria --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="conoceEspecialidad" name="conoce_especialidad">
                        <label class="form-check-label" for="conoceEspecialidad">
                            Conozco la especialidad
                        </label>
                    </div>
                    <select name="especialidad_id" class="form-control form-select" id="selectEspecialidad" disabled>
                        <option value="-1">-- Seleccione especialidad (opcional) --</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="conoceSubespecialidad" name="conoce_subespecialidad">
                        <label class="form-check-label" for="conoceSubespecialidad">
                            Conozco la subespecialidad
                        </label>
                    </div>
                    <select name="sub_especialidad_id" class="form-control form-select" id="selectSubespecialidad" disabled>
                        <option value="-1">-- Seleccione subespecialidad (opcional) --</option>

                    </select>
                </div>
                <div class="col-lg-12 mb-2">
                    <textarea placeholder="Escribe tu pregunta..." class="form-control" name="pregunta" id="" rows="10"></textarea>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-dark w-100">Enviar preguntas</button>
                </div>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-lg-12">
                <ul>
                    <li>Tu pregunta se publicará de forma anónima.</li>
                    <li>Intenta que tu consulta médica sea clara y breve.</li>
                    <li>La pregunta irá dirigida a todos los especialistas, no a uno específico.</li>
                    <li> Este servicio no sustituye a una consulta con un profesional de la salud. Si tienes un problema o
                        una urgencia, acude a tu médico o a los servicios de urgencia.</li>
                    <li>No se permiten preguntas sobre casos específicos o segundas opiniones.</li>
                    <li>Por cuestiones de salud, no se publicarán cantidades ni dosis de medicamentos.</li>
                    </li>
                </ul>
            </div>
        </div>
        <h2 class="mt-3 mb-3">Respuestas a preguntas anteriores</h2>
        <p class="mb-3">Aquí puedes ver las respuestas a preguntas anteriores realizadas por otros pacientes. Si tienes una
            pregunta similar, puedes encontrar la respuesta aquí.</p>

        <form method="GET" action="{{ route('pacientes.respuestas.index') }}">
            <div class="row mt-3 mb-3">

                <div class="col-lg-3 mb-2">
                    <select name="categoria_id" class="form-control filtrosRespuestas form-select" id="">
                        <option value="-1">-- Seleccione categoría --</option>
                        @if(isset($categorias))
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-3 mb-2">
                    <select name="especialidad_id" class="form-control filtrosRespuestas form-select" id="">
                        <option value="-1">-- Seleccione especialidad --</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 mb-2">
                    <select name="sub_especialidad_id" class="form-control filtrosRespuestas form-select" id="">
                        <option value="-1">-- Seleccione subespecialidad --</option>

                    </select>
                </div>
                <div class="col-lg-2 mb-2">
                    <button class="btn btn-dark w-100">Filtrar</button>
                </div>
                <div class="col-lg-1 mb-2">
                    <a href="/pacientes/preguntas-expertos" class="btn btn-dark w-100">Borrar</a>
                </div>
            </div>
        </form>


        <div class="row mt-5 mb-5">
            <div class="col-lg-12">
                <div class="accordion" id="faqAccordion">

                    @foreach ($respuestas as $respuesta)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $respuesta->id }}">
                                   <strong>Pregunta:&nbsp;</strong> {{ $respuesta->pregunta->pregunta }}
                                    (
                                    @if ($respuesta->pregunta->categoria)
                                        <span class="badge bg-primary">{{ $respuesta->pregunta->categoria->nombre }}</span>
                                    @endif
                                    @if ($respuesta->pregunta->especialidad)
                                        <span class="badge bg-success">{{ $respuesta->pregunta->especialidad->nombre }}</span>
                                    @endif
                                    @if ($respuesta->pregunta->sub_especialidad_id != null)
                                        <span class="badge bg-info">{{ $respuesta->pregunta->subespecialidad->nombre }}</span>
                                    @endif
                                    )
                                </button>
                            </h2>

                            <div id="collapse{{ $respuesta->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Respuesta:&nbsp;</strong>
                                    {{ $respuesta->respuesta }} <br>
                                    <strong>Médico: </strong> <a href="/profesionales/ficha/{{ $respuesta->profesional->id }}">{{ $respuesta->profesional->nombre_completo }}</a> <br>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Manejar habilitación/deshabilitación de selects según checkboxes
            $('#conoceCategoria').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#selectCategoria').prop('disabled', false);
                } else {
                    $('#selectCategoria').prop('disabled', true);
                    $('#selectCategoria').val('-1');
                }
            });

            $('#conoceEspecialidad').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#selectEspecialidad').prop('disabled', false);
                } else {
                    $('#selectEspecialidad').prop('disabled', true);
                    $('#selectEspecialidad').val('-1');
                    // También deshabilitar y limpiar subespecialidad
                    $('#conoceSubespecialidad').prop('checked', false);
                    $('#selectSubespecialidad').prop('disabled', true);
                    $('#selectSubespecialidad').empty().append('<option value="-1">-- Seleccione subespecialidad (opcional) --</option>');
                }
            });

            $('#conoceSubespecialidad').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#selectSubespecialidad').prop('disabled', false);
                } else {
                    $('#selectSubespecialidad').prop('disabled', true);
                    $('#selectSubespecialidad').val('-1');
                }
            });

            // Funcionalidad existente para cargar subespecialidades
            $('select[name="especialidad_id"]').on('change', function() {
                var especialidadId = $(this).val();

                if (especialidadId && especialidadId != '-1') {
                    $.ajax({
                        url: '/subespecialidades/' + especialidadId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let $subSelect = $('select[name="sub_especialidad_id"]');
                            $subSelect.empty();
                            $subSelect.append(
                                '<option value="-1">-- Seleccione subespecialidad --</option>'
                            );

                            $.each(data, function(key, value) {
                                $subSelect.append('<option value="' + value.id + '">' +
                                    value.nombre + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="sub_especialidad_id"]').empty().append(
                        '<option value="-1">-- Seleccione subespecialidad --</option>');
                }
            });
        });
    </script>
    @if (request('especialidad_id'))
        <script>
            $(function() {
                const especialidadId = '{{ request('especialidad_id') }}';
                const subEspecialidadId = '{{ request('sub_especialidad_id') }}';

                if (especialidadId) {
                    $.ajax({
                        url: '/subespecialidades/' + especialidadId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let $subSelect = $('select[name="sub_especialidad_id"]');
                            $subSelect.empty().append(
                                '<option value="">-- Seleccione subespecialidad --</option>');
                            $.each(data, function(key, value) {
                                $subSelect.append(
                                    '<option value="' + value.id + '"' +
                                    (value.id == subEspecialidadId ? ' selected' : '') +
                                    '>' + value.nombre + '</option>'
                                );
                            });
                        }
                    });
                }
            });
        </script>
    @endif
@endsection
