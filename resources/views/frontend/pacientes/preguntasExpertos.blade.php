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

        <form class="mb-5" action="{{ route('pacientes.enviar.preguntasExpertos') }}" method="post">
            @csrf
            <div class="row border p-4 formPreguntasExperto">
                <div class="col-lg-6 mb-2">
                    <select name="especialidad_id" class="form-control form-select" id="">
                        <option value="-1">-- Seleccione especialidad --</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mb-2">
                    <select name="sub_especialidad_id" class="form-control form-select" id="">
                        <option value="-1">-- Seleccione subespecialidad --</option>

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

        <div class="row mt-5">
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

        <form method="GET" action="{{ route('pacientes.respuestas.index') }}">
            <div class="row mt-5 mb-5">
                <div class="col-lg-4 mb-2">
                    <select name="especialidad_id" class="form-control filtrosRespuestas form-select" id="">
                        <option value="-1">-- Seleccione especialidad --</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 mb-2">
                    <select name="sub_especialidad_id" class="form-control filtrosRespuestas form-select" id="">
                        <option value="-1">-- Seleccione subespecialidad --</option>

                    </select>
                </div>
                <div class="col-lg-2 mb-2">
                    <button class="btn btn-dark w-100">Filtrar</button>
                </div>
                <div class="col-lg-2 mb-2">
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
                                    {{ $respuesta->pregunta->pregunta }}
                                    ({{ $respuesta->pregunta->especialidad->nombre }}
                                    @if ($respuesta->pregunta->sub_especialidad_id != null)
                                        / {{ $respuesta->pregunta->subespecialidad->nombre }})
                                    @endif
                                </button>
                            </h2>
                            <div id="collapse{{ $respuesta->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
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
            $('select[name="especialidad_id"]').on('change', function() {
                var especialidadId = $(this).val();

                if (especialidadId) {
                    $.ajax({
                        url: '/subespecialidades/' + especialidadId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let $subSelect = $('select[name="sub_especialidad_id"]');
                            $subSelect.empty();
                            $subSelect.append(
                                '<option value="">-- Seleccione subespecialidad --</option>'
                            );

                            $.each(data, function(key, value) {
                                $subSelect.append('<option value="' + value.id + '">' +
                                    value.nombre + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="sub_especialidad_id"]').empty().append(
                        '<option value="">-- Seleccione subespecialidad --</option>');
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
