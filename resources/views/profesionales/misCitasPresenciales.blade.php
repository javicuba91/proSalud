@extends('adminlte::page')

@section('title', 'Mis Citas Presenciales')

@section('meta_tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content_header')
    <h1 class="titulocitas">Mis Citas</h1>
@stop

@section('content')
    <style>
        .hidden {
            display: none !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <a href="/profesional/mis-citas/agendar" class="btn btn-dark w-100 ">Agendar una nueva cita</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <button class="btn btn-outline-secondary mr-2 btnFiltro" data-filtro="pendientes">Pendientes</button>
            <button class="btn btn-outline-secondary mr-2 btnFiltro" data-filtro="pasadas">Pasadas</button>
            <button class="btn btn-outline-secondary mr-2 btnFiltro" data-filtro="cancelada">Canceladas</button>
            <button class="btn btn-outline-secondary btnFiltro" data-filtro="todas">Todas</button>
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
            <button class="btn btn-dark active-tab mr-2 modoCalendario">Modo calendario</button>
            <button class="btn btn-outline-secondary modoListado">Modo listado</button>
        </div>

        <input type="hidden" id="modoActual" value="calendario">
        <input type="hidden" id="filtroActual" value="todas">

    </div>
    <div class="row mt-2">
        <div class="col-lg-12">
            <div id='calendar'></div>
        </div>
        <div class="col-lg-12 hidden">
            <div class="listadoCitasPresenciales">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCitaLabel">Agendar cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="fechaSeleccionada"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarEl = document.getElementById('calendar');
            let calendar;

            function cargarCalendario(filtro = 'todas') {
                if (calendar) calendar.destroy();

                fetch("{{ route('profesional.citasPresencialesJson') }}?filtro=" + filtro)
                    .then(response => response.json())
                    .then(data => {
                      

                        calendar = new FullCalendar.Calendar(calendarEl, {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            initialView: 'dayGridMonth',
                            locale: 'es',
                            height: 495,
                            events: data.events,
                            selectable: true,
                            eventClick: function(info) {
                                const props = info.event.extendedProps;
                                $('#modalCitaLabel').text(info.event.title);
                                $('#fechaSeleccionada').html(`
                        <strong>Fecha:</strong> ${info.event.start.toLocaleDateString()}<br>
                        <strong>Hora:</strong> ${props.hora}<br>
                        <strong>Motivo:</strong> ${props.motivo}<br>
                        <strong>Consultorio:</strong> ${props.consultorio}
                    `);
                                new bootstrap.Modal(document.getElementById('modalCita')).show();
                            }
                        });

                        calendar.render();
                    });
            }


            cargarCalendario(); // Cargar por defecto

            // Función para resaltar botón seleccionado
            function actualizarBotones(filtro) {
                $('.btnFiltro').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $(`.btnFiltro[data-filtro="${filtro}"]`).removeClass('btn-outline-secondary').addClass(
                    'btn-dark active-tab');
            }

            $('.btnFiltro').on('click', function() {
                const filtro = $(this).data('filtro');
                $('#filtroActual').val(filtro);
                actualizarBotones(filtro);

                if ($('#modoActual').val() === 'calendario') {
                    cargarCalendario(filtro);
                } else {
                    cargarListado(filtro);
                }
            });

            $('.modoCalendario').on('click', function() {

                $('#modoActual').val('calendario');
                $('#calendar').parent().removeClass('hidden');
                $('.listadoCitasPresenciales').parent().addClass('hidden');

                $('.modoCalendario').addClass('btn-dark active-tab').removeClass('btn-outline-secondary');
                $('.modoListado').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');

                cargarCalendario($('#filtroActual').val());
            });

            $('.modoListado').on('click', function() {
                $('#modoActual').val('listado');
                $('#calendar').parent().addClass('hidden');
                $('.listadoCitasPresenciales').parent().removeClass('hidden');

                $('.modoListado').addClass('btn-dark active-tab').removeClass('btn-outline-secondary');
                $('.modoCalendario').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');

                cargarListado($('#filtroActual').val());
            });

            function cargarListado(filtro) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('profesional.listadoCitasPresenciales') }}',
                    method: 'GET',
                    data: {
                        filtro: filtro
                    },
                    success: function(html) {
                        $('.listadoCitasPresenciales').html(html);
                    },
                    error: function() {
                        $('.listadoCitasPresenciales').html(
                            '<p class="text-danger">Error al cargar las citas.</p>');
                    }
                });
            }

            $(document).on('click', '.btn-cambiar-fecha', function() {
                var citaId = $(this).data('id');
                var fechaActual = $(this).data('fecha');

                $('#cita_id').val(citaId);

                // Formatea la fecha para el input datetime-local
                let date = new Date(fechaActual);
                let formatted = date.toISOString().slice(0, 16);
                $('#nueva_fecha').val(formatted);


                const now = new Date();
                const offset = now.getTimezoneOffset();
                const localISOTime = new Date(now.getTime() - offset * 60000).toISOString().slice(0, 16);
                $('#nueva_fecha').attr('min', localISOTime);

            });

        });


        $(document).ready(function() {
            // Delegación: capturar clic en cualquier .btn-cancelar-cita incluso si se genera por AJAX
            $(document).on('click', '.btn-cancelar-cita', function() {
                const citaId = $(this).data('id');
                $('#cancelar_cita_id').val(citaId);
            });

            // Manejar el formulario de cancelación por AJAX
            $(document).on('submit', '#form-cancelar-cita', function(e) {
                e.preventDefault();
                const citaId = $('#cancelar_cita_id').val();

                $.ajax({
                    url: '/profesional/citas/cancelar/' + citaId,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        $('#modalCancelarCita').modal('hide');
                        alert('Cita cancelada correctamente');
                        location.reload(); // Recargar página o recargar solo la lista de citas
                    },
                    error: function() {
                        alert('Error al cancelar la cita');
                    }
                });
            });
        });
    </script>

@endsection
