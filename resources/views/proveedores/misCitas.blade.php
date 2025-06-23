@extends('adminlte::page')

@section('title', 'Mis Citas')

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
            <a href="/proveedor/mis-citas/agendar" class="btn btn-dark w-100 ">Agendar una nueva cita</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <button class="btn btn-outline-secondary mr-2 btnCitasPendientes">Pendientes</button>
            <button class="btn btn-outline-secondary mr-2 btnCitasPasadas">Pasadas</button>
            <button class="btn btn-outline-secondary">Todas</button>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <button class="btn btn-dark active-tab mr-2 modoCalendario">Modo calendario</button>
            <button class="btn btn-outline-secondary modoListado">Modo listado</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-12">
            <div id='calendar'></div>
        </div>
        <div class="col-lg-12 hidden">
            <div class="listadoCitas">

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
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: false,
                locale: 'es',
                height: 495,
                selectable: true,
                dateClick: function(info) {
                    // Mostrar la fecha seleccionada en el modal
                    document.getElementById('fechaSeleccionada').innerText =
                        `Fecha seleccionada: ${info.dateStr}`;

                    // Mostrar el modal con Bootstrap 5
                    var modal = new bootstrap.Modal(document.getElementById('modalCita'));
                    modal.show();
                }
            });
            calendar.render();
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.btnCitasPendientes').on('click', function() {
                $('#calendar').parent().addClass('hidden');
                $('.listadoCitas').parent().removeClass('hidden');
                $('.titulocitas').html('Mis Citas Aceptadas');

                // Cambia estilos de botones
                $('.modoListado').removeClass('btn-outline-secondary').addClass('btn-dark active-tab');
                $('.btnCitasPendientes').removeClass('btn-outline-secondary').addClass(
                    'btn-dark active-tab');
                $('.modoCalendario').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $('.btnCitasPasadas').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('proveedores.listadoCitasAceptadas') }}',
                    type: 'GET',
                    success: function(data) {
                        console.log("LLEGA");
                        $('.listadoCitas').html(data);
                    },
                    error: function(xhr) {
                        console.log("NO LLEGA");
                        $('.listadoCitas').html(
                            '<p class="text-danger">Error al cargar las citas.</p>');
                    }
                });
            });

            $('.btnCitasPasadas').on('click', function() {

                $('#calendar').parent().addClass('hidden');
                $('.listadoCitas').parent().removeClass('hidden');
                $('.titulocitas').html('Mis Citas Pasadas');

                // Cambia estilos de botones
                $('.btnCitasPasadas').removeClass('btn-outline-secondary').addClass('btn-dark active-tab');
                $('.modoListado').removeClass('btn-outline-secondary').addClass('btn-dark active-tab');
                $('.modoCalendario').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $('.btnCitasPendientes').removeClass('btn-dark active-tab').addClass(
                    'btn-outline-secondary');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('proveedores.listadoCitasPasadas') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.listadoCitas').html(data);
                    },
                    error: function(xhr) {
                        $('.listadoCitas').html(
                            '<p class="text-danger">Error al cargar las citas.</p>');
                    }
                });
            });

            $('.modoListado').on('click', function() {

                $('#calendar').parent().addClass('hidden');
                $('.listadoCitas').parent().removeClass('hidden');
                $('.titulocitas').html('Mis Citas Aceptadas');

                // Cambia estilos de botones
                $('.modoListado').removeClass('btn-outline-secondary').addClass('btn-dark active-tab');
                $('.btnCitasPendientes').removeClass('btn-outline-secondary').addClass(
                    'btn-dark active-tab');
                $('.modoCalendario').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $('.btnCitasPasadas').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('proveedores.listadoCitasAceptadas') }}',
                    type: 'GET',
                    success: function(data) {
                        console.log("LLEGA");
                        $('.listadoCitas').html(data);
                    },
                    error: function(xhr) {
                        console.log("NO LLEGA");
                        $('.listadoCitas').html(
                            '<p class="text-danger">Error al cargar las citas.</p>');
                    }
                });
            });

            $('.modoCalendario').on('click', function() {
                $('#calendar').parent().removeClass('hidden'); // Muestra el calendario
                $('.listadoCitas').parent().addClass('hidden'); // Oculta el listado
                $('.titulocitas').html('Mis Citas');

                // Cambia estilos de botones
                $('.modoCalendario').removeClass('btn-outline-secondary').addClass('btn-dark active-tab');
                $('.modoListado').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $('.btnCitasPasadas').removeClass('btn-dark active-tab').addClass('btn-outline-secondary');
                $('.btnCitasPendientes').removeClass('btn-dark active-tab').addClass(
                    'btn-outline-secondary');
            });
        });
    </script>

@endsection
