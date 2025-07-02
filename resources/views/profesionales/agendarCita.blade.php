@extends('adminlte::page')

@section('title', 'Agendar Cita')

@section('content_header')
    <h1>Agendar Cita</h1>
@stop

@section('css')
    <style>
        .modal-fullscreen {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0;
        }
    </style>
@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row border p-2">

        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" id="buscar_paciente" placeholder="Buscar paciente..."
                value="{{ isset($pacienteSeleccionado) ? $pacienteSeleccionado->nombre_completo : '' }}">
            <input type="hidden" name="paciente_id" id="paciente_id"
                value="{{ isset($pacienteSeleccionado) ? $pacienteSeleccionado->id : '' }}">
            <div id="resultados-pacientes"></div>
            @if (isset($pacienteSeleccionado))
                <div class="alert alert-info mt-2">
                    <i class="fa fa-info-circle"></i>
                    <strong>Paciente seleccionado:</strong> {{ $pacienteSeleccionado->nombre_completo }}<br>
                    <strong>Email:</strong> {{ $pacienteSeleccionado->email }}
                </div>
            @endif
        </div>

        <div class="col-lg-2 mb-2">
            <input type="text" class="form-control" name="codigo_qr" id="codigo_qr" readonly placeholder="Código QR">
        </div>

        <div class="col-lg-4 mb-2">
            <select class="form-control" name="modalidad" id="modalidad">
                <option value="">Selecciona modalidad</option>
                <option value="presencial">Presencial</option>
                <option value="videoconsulta">Videoconsulta</option>
            </select>
        </div>

        <div class="col-lg-6 mb-2">
            <input type="text" class="form-control" name="motivo" placeholder="Breve motivo de la consulta">
        </div>

        <div class="col-lg-12 mb-2" id="consultorio-container" style="display: none;">
            <select class="form-control" name="consultorio_id" id="consultorio_id">
                <!-- Consultorios cargados por AJAX -->
            </select>
        </div>

        <div class="col-lg-12 mb-2" id="disponibilidad-container" style="display: none;">
            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-calendar text-primary me-1"></i>
                    <span class="fw-semibold">Disponibilidad</span><br>
                    <small class="text-muted">Ver disponibilidades</small>
                </div>
                <span class="badge bg-dark fs-6" role="button" data-toggle="modal" data-target="#modalVerCalendario">
                    Ver Calendario
                </span>
                <div>
                    <input id="fecha_hora" class="form-control mt-2" type="datetime-local" name="fecha_hora">
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-2" id="disponibilidad-container-videollamada" style="display: none;">
            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-calendar text-primary me-1"></i>
                    <span class="fw-semibold">Disponibilidad</span><br>
                    <small class="text-muted">Ver disponibilidades</small>
                </div>
                <span class="badge bg-dark fs-6" role="button" data-toggle="modal"
                    data-target="#modalVerCalendarioVideollamada">
                    Ver Calendario
                </span>
                <div>
                    <input id="fecha_hora_videollamada" class="form-control mt-2" type="datetime-local"
                        name="fecha_hora_videollamada">
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <a href="#" class="btn btn-dark w-100" id="guardar-cita">Guardar datos</a>
        </div>

    </div>

    <div class="modal fade" id="modalVerCalendario" tabindex="-1" aria-labelledby="modalVerCalendarioLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar disponibilidad</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div id="calendarioFullCalendar"></div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios" class="list-group"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVerCalendarioVideollamada" tabindex="-1"
        aria-labelledby="modalVerCalendarioVideollamadaLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar disponibilidad</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div id="calendarioFullCalendarVideollamada"></div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios-videollamada" class="list-group"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            const now = new Date();
            const offset = now.getTimezoneOffset();
            const localISOTime = new Date(now.getTime() - offset * 60000).toISOString().slice(0, 16);
            $('#fecha_hora').attr('min', localISOTime);

            $('#buscar_paciente').on('input', function() {
                const query = $(this).val();
                if (query.length >= 2) {
                    $.ajax({
                        url: '/profesional/pacientes/buscar',
                        data: {
                            q: query
                        },
                        success: function(data) {

                            let lista = data.map(p =>
                                `<li class="list-group-item" data-id="${p.id}">${p.nombre_completo}</li>`
                            ).join('');
                            $('#resultados-pacientes').html(
                                `<ul class="list-group">${lista}</ul>`);
                        }
                    });
                }
            });

            // Al seleccionar paciente
            $(document).on('click', '#resultados-pacientes li', function() {
                $('#buscar_paciente').val($(this).text());
                $('#paciente_id').val($(this).data('id'));
                $('#resultados-pacientes').empty();
            });

            $('#modalidad').change(function() {
                const modalidad = $(this).val();

                if (modalidad === 'presencial') {
                    // Mostrar campos relevantes
                    $('#consultorio-container').show();
                    $('#disponibilidad-container').show();
                    $('#disponibilidad-container-videollamada').hide();

                    $.ajax({
                        url: '/profesional/consultorios/buscar',
                        success: function(data) {
                            let options = data.map(c =>
                                `<option value="${c.id}">${c.direccion}</option>`).join('');
                            $('#consultorio_id').html(options);
                        }
                    });

                } else if (modalidad === 'videoconsulta') {
                    $('#consultorio-container').hide();
                    $('#consultorio_id').html('');
                    $('#disponibilidad-container').hide();
                    $('#disponibilidad-container-videollamada').show();

                    let meetUrl = 'https://meet.google.com/' + Math.random().toString(36).substring(2, 7);
                    $('#codigo_qr').val(meetUrl);
                } else {
                    // Ocultar ambos si no se elige modalidad
                    $('#consultorio-container').hide();
                    $('#consultorio_id').html('');
                    $('#disponibilidad-container').hide();
                }
            });


            $('#guardar-cita').click(function(e) {
                e.preventDefault();
                const formData = {
                    paciente_id: $('#paciente_id').val(),
                    fecha_hora: $('#fecha_hora').val(),
                    fecha_hora_videollamada: $('#fecha_hora_videollamada').val(),
                    modalidad: $('#modalidad').val(),
                    motivo: $('input[name="motivo"]').val(),
                    consultorio_id: $('#consultorio_id').val()
                };

                $.ajax({
                    url: '/profesional/citas/guardar',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function() {
                        Swal.fire({
                            title: '¡Cita agendada!',
                            text: 'La cita fue registrada correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            timer: 3000,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al agendar la cita.',
                            icon: 'error',
                            confirmButtonText: 'Intentar de nuevo'
                        });
                    }
                });
            });


        });
    </script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <script>
        @php
            $profesional = App\Models\Profesional::where('user_id', auth()->id())->first();
        @endphp

        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendarioFullCalendar');
            let fechaSeleccionada = null;

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/frontend/profesional/horarios/{{ $profesional->id }}',
                        method: 'GET',
                        success: function(data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function(info) {

                    fechaSeleccionada = info.dateStr;

                    $.ajax({
                        url: '/api/frontend/profesional/horarios/{{ $profesional->id }}/' + info
                            .dateStr,
                        method: 'GET',
                        success: function(response) {

                            let lista = $('#lista-horarios');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append(
                                    '<li class="list-group-item text-muted">Sin horarios</li>'
                                    );
                            } else {
                                response.forEach((horario, index) => {
                                    let turnosHtml = horario.turnos.map(t => `
                                    <button class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                    lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <small>${horario.consultorio}</small>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                                });
                            }
                        }
                    });
                }

            });

            $('#modalVerCalendario').on('shown.bs.modal', function() {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios').on('click', '.btn-turno', function() {
                $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
                $(this).removeClass('btn-outline-success').addClass('btn-success');

                if (fechaSeleccionada) {
                    const hora = $(this).data('hora');
                    const datetimeLocal = fechaSeleccionada + 'T' + hora;
                    $('#fecha_hora').val(datetimeLocal);
                    $('#modalVerCalendario').modal('hide');
                }
            });
        });
    </script>

    <script>
        @php
            $profesional = App\Models\Profesional::where('user_id', auth()->id())->first();
        @endphp
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendarioFullCalendarVideollamada');
            let fechaSeleccionada = null;

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/frontend/profesional/horarios-videollamada/{{ $profesional->id }}',
                        method: 'GET',
                        success: function(data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function(info) {

                    fechaSeleccionada = info.dateStr;

                    $.ajax({
                        url: '/api/frontend/profesional/horarios-videollamada/{{ $profesional->id }}/' +
                            info.dateStr,
                        method: 'GET',
                        success: function(response) {

                            let lista = $('#lista-horarios-videollamada');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append(
                                    '<li class="list-group-item text-muted">Sin horarios</li>'
                                    );
                            } else {
                                response.forEach((horario, index) => {
                                    let turnosHtml = horario.turnos.map(t => `
                                    <button class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                    lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                                });
                            }
                        }
                    });
                }

            });

            $('#modalVerCalendarioVideollamada').on('shown.bs.modal', function() {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios-videollamada').on('click', '.btn-turno', function() {
                $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
                $(this).removeClass('btn-outline-success').addClass('btn-success');

                if (fechaSeleccionada) {
                    const hora = $(this).data('hora');
                    const datetimeLocal = fechaSeleccionada + 'T' + hora;
                    $('#fecha_hora_videollamada').val(datetimeLocal);
                    $('#modalVerCalendarioVideollamada').modal('hide');
                }
            });
        });
    </script>
@endsection
