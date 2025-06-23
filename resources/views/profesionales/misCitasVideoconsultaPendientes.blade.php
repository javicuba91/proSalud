@extends('adminlte::page')

@section('title', 'Mis VideoConsultas Pendientes')

@section('content_header')
    <h1>Mis videoconsultas (pendientes)</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <a href="/profesional/mis-pacientes" class="btn btn-dark w-100 ">Programar nueva videoconsulta</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <a href="/profesional/mis-citas-videoconsulta/pendientes" class="btn btn-outline-secondary mr-2">Pendientes</a>
            <button class="btn btn-outline-secondary mr-2">Pasadas</button>
            <button class="btn btn-outline-secondary">Todas</button>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <a href="/profesional/mis-citas-videoconsulta" class="btn btn-outline-secondary mr-2">Modo calendario</a>
            <a href="" class="btn btn-dark active-tab">Modo listado</a>
        </div>
    </div>
    <div class="row border p-2 mb-2 mt-2">
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>    
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" placeholder="Fecha/hora">
        </div>
    
        <div class="col-lg-6 mb-2">
            <input type="text" class="form-control" placeholder="Código cita QR">
        </div>
        <div class="col-lg-6 mb-2">
            <input type="text" class="form-control" placeholder="Breve motivo de la consulta">
        </div>
    
        <div class="col-lg-6 mb-2">
            <a href="/profesional/mis-pacientes/historial" class="btn btn-outline-secondary active-tab w-100">Ver historial del paciente</a>
        </div>
        <div class="col-lg-6 mb-2">
            <a href="" class="btn btn-dark w-100">Aceptada</a>
        </div>
    
        <div class="col-md mb-2">
            <a data-toggle="modal" data-target="#modalVideoLlamada" href="#" class="btn btn-dark w-100">Acceder a videoconsulta</a>
        </div>

        <div class="col-md mb-2">
            <a href="" class="btn btn-dark w-100">Enviar recordatorio de la cita</a>
        </div>

        <div class="col-md mb-2">
            <a href="" class="btn btn-dark w-100">Cambiar fecha</a>
        </div>

        <div class="col-md mb-2">
            <a href="" class="btn btn-dark w-100">Cancelar cita</a>
        </div>

        <div class="col-md mb-2">
            <a href="/profesional/informe-consulta" class="btn btn-dark w-100">Crear informa de consulta</a>
        </div>
    </div>
    

    <div class="modal fade" id="modalVideoLlamada" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalVideoLlamadaLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVideoLlamadaLabel">VideoLlamada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>
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
                    document.getElementById('fechaSeleccionada').innerText = `Fecha seleccionada: ${info.dateStr}`;

                    // Mostrar el modal con Bootstrap 5
                    var modal = new bootstrap.Modal(document.getElementById('modalCita'));
                    modal.show();
                }
            });
            calendar.render();
        });
    </script>
@endsection
