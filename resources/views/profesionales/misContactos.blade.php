@extends('adminlte::page')

@section('title', 'Mis Contactos')

@section('content_header')
    <h1>Mis Contactos</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-lg-10">
            <input type="text" class="form-control" id="buscar_paciente" placeholder="Buscar paciente...">
            <input type="hidden" name="paciente_id" id="paciente_id">
            <div id="resultados-pacientes"></div>
        </div>
        <div class="col-lg-2">
            <button id="btn-mostrar-todos" class="btn btn-primary w-100"><i class="fa fa-eye"></i> Mostrar todos</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Listado de contactos</h5>
        </div>
    </div>

    <div id="listado-pacientes">
        @foreach ($pacientes as $index => $paciente)
            <div class="row mt-3 border p-2 paciente-item" data-id="{{ $paciente->id }}">
                <div class="col-lg-1">
                    <input type="text" class="form-control"
                        value="P-{{ str_pad($paciente->id + 1, 4, '0', STR_PAD_LEFT) }}" placeholder="P-0017">
                </div>
                <div class="col-lg-3">
                    <input type="email" class="form-control" value="{{ $paciente->email }}"
                        placeholder="paciente1@prosalud.com" readonly>
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" value="{{ $paciente->nombre_completo }}"
                        placeholder="Nombre paciente" readonly>
                </div>
                <div class="col-lg-2">
                    <a href="/profesional/mis-citas/agendar?paciente_id={{ $paciente->id }}"
                        class="btn btn-dark w-100">Agendar Cita</a>
                </div>
                <div class="col-lg-2">
                    <a href="/profesional/mis-pacientes/historial/{{ $paciente->id }}" class="btn btn-dark w-100">Ver
                        historial clínico</a>
                </div>
                <div class="col-lg-2">
                    <a href="/profesional/mis-pacientes/edit/{{ $paciente->id }}" class="btn btn-dark w-100">Editar</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row border pt-2 pb-2 shadow fixed-bottom">
        <div class="col-lg-12">
            <a href="/profesional/paciente/crear" class="btn btn-success w-100"><i class="fa fa-plus"></i>Añadir nuevo paciente / contacto</a>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
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
                } else {
                    $('#resultados-pacientes').empty();
                }
            });

            // Al seleccionar paciente
            $(document).on('click', '#resultados-pacientes li', function() {
                const pacienteId = $(this).data('id');
                const pacienteNombre = $(this).text();

                $('#buscar_paciente').val(pacienteNombre);
                $('#paciente_id').val(pacienteId);
                $('#resultados-pacientes').empty();

                // Filtrar listado: mostrar sólo el paciente seleccionado
                $('#listado-pacientes .paciente-item').hide();
                $(`#listado-pacientes .paciente-item[data-id="${pacienteId}"]`).show();

                // Mostrar botón para mostrar todos
                $('#btn-mostrar-todos').show();
            });

            // Botón para mostrar todos los pacientes otra vez
            $(document).on('click', '#btn-mostrar-todos', function() {
                $('#listado-pacientes .paciente-item').show();
                $('#buscar_paciente').val('');
                $('#paciente_id').val('');
            });

            // Otras funciones existentes...
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
                    $('#codigo_qr').val(meetUrl);
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
