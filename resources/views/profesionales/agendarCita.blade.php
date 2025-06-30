@extends('adminlte::page')

@section('title', 'Agendar Cita')

@section('content_header')
    <h1>Agendar Cita</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row border p-2">

        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" id="buscar_paciente"
                   placeholder="Buscar paciente..."
                   value="{{ isset($pacienteSeleccionado) ? $pacienteSeleccionado->nombre_completo : '' }}">
            <input type="hidden" name="paciente_id" id="paciente_id"
                   value="{{ isset($pacienteSeleccionado) ? $pacienteSeleccionado->id : '' }}">
            <div id="resultados-pacientes"></div>
            @if(isset($pacienteSeleccionado))
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

        <div class="col-lg-2 mb-2">
            <input type="datetime-local" class="form-control" name="fecha_hora" id="fecha_hora">
        </div>

        <div class="col-lg-4 mb-2">
            <select class="form-control" name="modalidad" id="modalidad">
                <option value="">Selecciona modalidad</option>
                <option value="presencial">Presencial</option>
                <option value="videoconsulta">Videoconsulta</option>
            </select>
        </div>

        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control" name="motivo" placeholder="Breve motivo de la consulta">
        </div>

        <div class="col-lg-12 mb-2" id="consultorio-container" style="display: none;">
            <select class="form-control" name="consultorio_id" id="consultorio_id">
                <!-- Consultorios cargados por AJAX -->
            </select>
        </div>

        <div class="col-lg-12 mb-2">
            <a href="#" class="btn btn-dark w-100" id="guardar-cita">Guardar datos</a>
        </div>

    </div>

@stop

@section('js')

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
                    $.ajax({
                        url: '/profesional/consultorios/buscar',
                        success: function(data) {
                            let options = data.map(c =>
                                `<option value="${c.id}">${c.direccion}</option>`).join('');
                            $('#consultorio_id').html(options);
                            $('#consultorio-container').show();
                        }
                    });
                } else {
                    $('#consultorio-container').hide();
                    $('#consultorio_id').html('');
                }

                if (modalidad === 'videoconsulta') {
                    let meetUrl = 'https://meet.google.com/' + Math.random().toString(36).substring(2, 7);
                    $('#codigo_qr').val(
                        meetUrl
                        ); // Temporalmente, puedes usar el mismo campo para URL y luego separarlo si quieres
                }
            });

            $('#guardar-cita').click(function(e) {
                e.preventDefault();
                const formData = {
                    paciente_id: $('#paciente_id').val(),
                    fecha_hora: $('#fecha_hora').val(),
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
                        alert('Cita agendada correctamente');
                        location.reload();
                    },
                    error: function() {
                        alert('Ocurrió un error al agendar la cita');
                    }
                });
            });



        });
    </script>


@endsection
