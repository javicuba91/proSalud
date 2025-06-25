@extends('adminlte::page')

@section('title', 'Editar Emergencia')

@section('content_header')
    <h1>Editar Emergencia</h1>
@stop

@section('content')
    <form action="{{ route('emergencias.update', $emergencia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Seleccionar tipo...</option>
                <option value="Farmacia 24 horas" {{ $emergencia->tipo == 'Farmacia 24 horas' ? 'selected' : '' }}>Farmacia 24 horas</option>
                <option value="Ambulancia 24 horas" {{ $emergencia->tipo == 'Ambulancia 24 horas' ? 'selected' : '' }}>Ambulancia 24 horas</option>
            </select>
        </div>
        <div class="form-group">
            <label for="region_id">Región</label>
            <select name="region_id" id="region_id" class="form-control" required>
                <option value="">Seleccionar región...</option>
                @foreach($region as $reg)
                    <option value="{{ $reg->id }}" {{ $emergencia->region_id == $reg->id ? 'selected' : '' }}>{{ $reg->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="provincia_id">Provincia</label>
            <select name="provincia_id" id="provincia_id" class="form-control" required>
                <option value="">Seleccionar provincia...</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}" data-region="{{ $provincia->region_id }}" {{ $emergencia->provincia_id == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ciudad_id">Ciudad</label>
            <select name="ciudad_id" id="ciudad_id" class="form-control" required>
                <option value="">Seleccionar ciudad...</option>
                @foreach($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" data-provincia="{{ $ciudad->provincia_id }}" {{ $emergencia->ciudad_id == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $emergencia->direccion }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $emergencia->telefono }}" placeholder="Opcional">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('emergencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Función para mostrar/ocultar opciones según las relaciones
        function updateSelectOptions() {
            var regionId = $('#region_id').val();
            var provinciaId = $('#provincia_id').val();

            // Configurar provincias
            $('#provincia_id option').not('[value=""]').hide();
            if (regionId) {
                $('#provincia_id option[data-region="' + regionId + '"]').show();
            } else {
                $('#provincia_id option').show();
            }

            // Configurar ciudades
            $('#ciudad_id option').not('[value=""]').hide();
            if (provinciaId) {
                $('#ciudad_id option[data-provincia="' + provinciaId + '"]').show();
            } else {
                $('#ciudad_id option').show();
            }
        }

        // Ejecutar al cargar la página para mostrar las opciones correctas
        updateSelectOptions();

        // Filtrar provincias según la región seleccionada
        $('#region_id').change(function() {
            var regionId = $(this).val();
            var provinciaSelect = $('#provincia_id');
            var ciudadSelect = $('#ciudad_id');

            // Si no hay región seleccionada, limpiar dependientes
            if (!regionId) {
                provinciaSelect.val('');
                ciudadSelect.val('');
            } else {
                // Si la provincia actual no pertenece a la nueva región, limpiar
                var currentProvinciaRegion = provinciaSelect.find('option:selected').data('region');
                if (currentProvinciaRegion != regionId) {
                    provinciaSelect.val('');
                    ciudadSelect.val('');
                }
            }

            updateSelectOptions();
        });

        // Filtrar ciudades según la provincia seleccionada
        $('#provincia_id').change(function() {
            var provinciaId = $(this).val();
            var ciudadSelect = $('#ciudad_id');

            // Si no hay provincia seleccionada, limpiar ciudades
            if (!provinciaId) {
                ciudadSelect.val('');
            } else {
                // Si la ciudad actual no pertenece a la nueva provincia, limpiar
                var currentCiudadProvincia = ciudadSelect.find('option:selected').data('provincia');
                if (currentCiudadProvincia != provinciaId) {
                    ciudadSelect.val('');
                }
            }

            updateSelectOptions();
        });
    });
</script>
@stop
