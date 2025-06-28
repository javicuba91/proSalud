@extends('adminlte::page')

@section('title', 'Crear Cita')

@section('content_header')
    <h1>Crear Cita</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('citas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="paciente_id">Paciente</label>
                    <select name="paciente_id" id="paciente_id" class="form-control" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nombre_completo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="profesional_id">Profesional</label>
                    <select name="profesional_id" id="profesional_id" class="form-control" required>
                        <option value="">Seleccione un profesional</option>
                        @foreach ($profesionales as $profesional)
                            <option value="{{ $profesional->id }}">{{ $profesional->nombre_completo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="especializacion_id">Especializaciones</label>
                    <select name="especializacion_id" id="especializacion_id" class="form-control" required>
                        <option value="">Seleccione un profesional primero</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_hora">Fecha y Hora</label>
                    <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="modalidad">Modalidad</label>
                    <select name="modalidad" id="modalidad" class="form-control" required>
                        <option value="">Seleccione un profesional primero</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="motivo">Motivo</label>
                    <textarea name="motivo" id="motivo" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="consultorio_id">Consultorio</label>
                    <select name="consultorio_id" id="consultorio_id" class="form-control">
                        <option value="">Seleccione un profesional primero</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="url_meet">URL Meet</label>
                    <input type="url" name="url_meet" id="url_meet" class="form-control">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="aceptada">Aceptada</option>
                        <option value="cancelada">Cancelada</option>
                        <option value="completada">Completada</option>
                        <option value="noacude">No acude</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Mostrar/ocultar consultorio y URL meet según modalidad inicialmente
        $('#consultorio_id').closest('.form-group').show();
        $('#url_meet').closest('.form-group').show();

        $('#profesional_id').on('change', function() {
            var profesionalId = $(this).val();
            var $especializacion = $('#especializacion_id');
            var $modalidad = $('#modalidad');
            var $consultorio = $('#consultorio_id');

            // Limpiar los selects dependientes
            $especializacion.html('<option value="">Cargando...</option>');
            $modalidad.html('<option value="">Cargando...</option>');
            $consultorio.html('<option value="">Cargando...</option>');

            if(profesionalId) {
                // Cargar especializaciones
                $.ajax({
                    url: "{{ route('citas.especializaciones.profesional', ':id') }}".replace(':id', profesionalId),
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">Seleccione una especialización</option>';
                        data.forEach(function(e) {
                            options += '<option value="'+e.id+'">'+e.nombre+'</option>';
                        });
                        $especializacion.html(options);
                    },
                    error: function() {
                        $especializacion.html('<option value="">Error al cargar especializaciones</option>');
                    }
                });

                // Cargar modalidades
                $.ajax({
                    url: "{{ route('citas.modalidades.profesional', ':id') }}".replace(':id', profesionalId),
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">Seleccione una modalidad</option>';
                        data.forEach(function(m) {
                            options += '<option value="'+m.value+'">'+m.text+'</option>';
                        });
                        $modalidad.html(options);
                    },
                    error: function() {
                        $modalidad.html('<option value="">Error al cargar modalidades</option>');
                    }
                });

                // Cargar consultorios
                $.ajax({
                    url: "{{ route('citas.consultorios.profesional', ':id') }}".replace(':id', profesionalId),
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">Seleccione un consultorio</option>';
                        data.forEach(function(c) {
                            var texto = c.direccion + (c.clinica ? ' - ' + c.clinica : '');
                            options += '<option value="'+c.id+'">'+texto+'</option>';
                        });
                        $consultorio.html(options);
                    },
                    error: function() {
                        $consultorio.html('<option value="">Error al cargar consultorios</option>');
                    }
                });
            } else {
                $especializacion.html('<option value="">Seleccione un profesional primero</option>');
                $modalidad.html('<option value="">Seleccione un profesional primero</option>');
                $consultorio.html('<option value="">Seleccione un profesional primero</option>');
            }
        });

        // Mostrar/ocultar consultorio y URL meet según modalidad
        $('#modalidad').on('change', function() {
            var modalidad = $(this).val();

            if (modalidad === 'presencial') {
                $('#consultorio_id').closest('.form-group').show();
                $('#url_meet').closest('.form-group').hide();
                $('#url_meet').val(''); // Limpiar URL
            } else if (modalidad === 'videoconsulta') {
                $('#consultorio_id').closest('.form-group').hide();
                $('#url_meet').closest('.form-group').show();
                $('#consultorio_id').val(''); // Limpiar consultorio
            } else {
                // Si no hay modalidad seleccionada, mostrar ambos
                $('#consultorio_id').closest('.form-group').show();
                $('#url_meet').closest('.form-group').show();
            }
        });
    });
    </script>
@stop
