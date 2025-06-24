@extends('adminlte::page')

@section('title', 'Crear Emergencia')

@section('content_header')
    <h1>Crear Emergencia</h1>
@stop

@section('content')
    <form action="{{ route('emergencias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Seleccionar tipo...</option>
                <option value="Farmacia 24 horas">Farmacia 24 horas</option>
                <option value="Ambulancia 24 horas">Ambulancia 24 horas</option>
            </select>
        </div>
        <div class="form-group">
            <label for="region_id">Región</label>
            <select name="region_id" id="region_id" class="form-control" required>
                <option value="">Seleccionar región...</option>
                @foreach($region as $reg)
                    <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="provincia_id">Provincia</label>
            <select name="provincia_id" id="provincia_id" class="form-control" required disabled>
                <option value="">Seleccionar provincia...</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}" data-region="{{ $provincia->region_id }}">{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ciudad_id">Ciudad</label>
            <select name="ciudad_id" id="ciudad_id" class="form-control" required disabled>
                <option value="">Seleccionar ciudad...</option>
                @foreach($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" data-provincia="{{ $ciudad->provincia_id }}">{{ $ciudad->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Opcional">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('emergencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Inicialmente ocultar todas las opciones excepto las por defecto
        $('#provincia_id option').not('[value=""]').hide();
        $('#ciudad_id option').not('[value=""]').hide();

        // Filtrar provincias según la región seleccionada
        $('#region_id').change(function() {
            var regionId = $(this).val();
            var provinciaSelect = $('#provincia_id');
            var ciudadSelect = $('#ciudad_id');

            // Limpiar y deshabilitar selects dependientes
            provinciaSelect.val('').prop('disabled', !regionId);
            ciudadSelect.val('').prop('disabled', true);

            // Ocultar todas las opciones
            provinciaSelect.find('option').hide();
            ciudadSelect.find('option').hide();

            if (regionId) {
                // Mostrar provincias de la región seleccionada
                provinciaSelect.find('option[value=""]').show();
                provinciaSelect.find('option[data-region="' + regionId + '"]').show();
            } else {
                // Mostrar todas las provincias si no hay región seleccionada
                provinciaSelect.find('option').show();
            }

            // Siempre mostrar la opción por defecto de ciudades
            ciudadSelect.find('option[value=""]').show();
        });

        // Filtrar ciudades según la provincia seleccionada
        $('#provincia_id').change(function() {
            var provinciaId = $(this).val();
            var ciudadSelect = $('#ciudad_id');

            // Limpiar y habilitar/deshabilitar select de ciudades
            ciudadSelect.val('').prop('disabled', !provinciaId);

            // Ocultar todas las opciones
            ciudadSelect.find('option').hide();

            if (provinciaId) {
                // Mostrar ciudades de la provincia seleccionada
                ciudadSelect.find('option[value=""]').show();
                ciudadSelect.find('option[data-provincia="' + provinciaId + '"]').show();
            } else {
                // Mostrar opción por defecto
                ciudadSelect.find('option[value=""]').show();
            }
        });
    });
</script>
@stop
