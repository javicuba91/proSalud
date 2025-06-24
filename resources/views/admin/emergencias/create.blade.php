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
            <label for="provincia_id">Provincia</label>
            <select name="provincia_id" id="provincia_id" class="form-control" required>
                <option value="">Seleccionar provincia...</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ciudad_id">Ciudad</label>
            <select name="ciudad_id" id="ciudad_id" class="form-control" required>
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
        // Filtrar ciudades según la provincia seleccionada
        $('#provincia_id').change(function() {
            var provinciaId = $(this).val();
            var ciudadSelect = $('#ciudad_id');

            ciudadSelect.find('option').hide();
            ciudadSelect.val('');

            if (provinciaId) {
                ciudadSelect.find('option[data-provincia="' + provinciaId + '"]').show();
                ciudadSelect.find('option[value=""]').show();
            } else {
                ciudadSelect.find('option').show();
            }
        });

        // Inicialmente ocultar todas las ciudades excepto la opción por defecto
        $('#ciudad_id option').not('[value=""]').hide();
    });
</script>
@stop
