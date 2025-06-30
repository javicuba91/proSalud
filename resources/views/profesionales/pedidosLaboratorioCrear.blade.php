@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de laboratorio')

@section('content_header')
    <h1>Elaboración de pedidos de laboratorio</h1>
@stop

@section('content')
<form id="form-pedido-laboratorio" action="#" method="POST">
    @csrf
    <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
    <input type="hidden" name="profesional_nombre" value="{{ $profesional->nombre_completo }}">
    <input type="hidden" name="profesional_colegiado" value="{{ $profesional->num_colegiado }}">
    <input type="hidden" name="profesional_contacto" value="{{ $profesional->email }} / {{ $profesional->telefono_profesional ?? $profesional->telefono_personal }}">
    <input type="hidden" name="codigo_qr" value="LAB-{{ $profesional->id }}-{{ date('YmdHis') }}">
    <input type="hidden" name="fecha_emision" value="{{ date('Y-m-d') }}">

    <h5>Datos del paciente</h5>
    <div class="row mb-3 border p-2">
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
                    <strong>Paciente seleccionado:</strong> {{ $pacienteSeleccionado->nombre_completo }}
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <a href="/profesional/paciente/crear" class="btn btn-dark w-100">Añadir nuevo paciente</a>
        </div>
    </div>

    <!-- Datos del médico -->
    <h5>Datos del médico</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Nombre completo"
                   value="{{ $profesional->nombre_completo }}" readonly disabled>
        </div>
        <div class="col-md-6 mb-2">
            <select class="form-control" name="especialidad_id" id="especialidad_profesional">
                <option value="">-- Seleccione especialidad --</option>
                @foreach($profesional->especializaciones as $especialidad)
                    <option value="{{ $especialidad->id }}">
                        {{ $especialidad->especialidad->nombre }}
                        @if($especialidad->subespecialidad)
                            / {{ $especialidad->subespecialidad->nombre }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Número de colegiado"
                   value="{{ $profesional->num_colegiado }}" readonly disabled>
        </div>
        <div class="col-md-6 mb-2">
            <select class="form-control" name="consultorio_id" id="consultorio_profesional">
                <option value="">-- Seleccione consultorio --</option>
                @foreach($profesional->consultorios as $consultorio)
                    <option value="{{ $consultorio->id }}">
                        {{ $consultorio->clinica ?? 'Consultorio' }} - {{ $consultorio->direccion }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <input type="text" class="form-control" placeholder="Forma de contacto (email/teléfono)"
                   value="{{ $profesional->email }} / {{ $profesional->telefono_profesional ?? $profesional->telefono_personal }}" readonly disabled>
        </div>
    </div>

    <!-- Datos del pedido -->
    <h5>Datos del pedido</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6">
            {!! QrCode::size(100)->generate('LAB-' . $profesional->id . '-' . date('YmdHis')) !!}
            <input type="text" class="form-control mt-3 align-self-end" placeholder="Código QR"
               value="{{ 'LAB-' . $profesional->id . '-' . date('YmdHis') }}" readonly disabled>

        </div>
        <div class="col-md-6">
            <div class="d-flex flex-column h-100 justify-content-end" style="height: 100%;">
                <input type="date" class="form-control mt-3 align-self-end" placeholder="Fecha de emisión"
                    value="{{ date('Y-m-d') }}" readonly disabled>
            </div>
        </div>
    </div>

    <!-- Información clínica -->
    <h5>Información clínica</h5>
    <div class="mb-3 border p-2">
        <input type="text" class="form-control mb-2" name="motivo_examen"
            placeholder="Motivo del examen (ej. sospecha de infección, control de glucosa, etc.)">
        <input type="text" class="form-control mb-2" name="antecedentes_relevantes"
            placeholder="Antecedentes médicos relevantes">
        <input type="text" class="form-control mb-2" name="sintomas_presentados"
            placeholder="Síntomas presentados">
    </div>

    <!-- Pruebas de laboratorio -->
    <div class="row mb-3">
        <div class="col-lg-10">
            <h5>Pruebas de laboratorio</h5>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-dark w-100" id="agregar-prueba">
                <i class="fa fa-plus"></i> Agregar prueba
            </button>
        </div>
    </div>

    <div id="contenedor-pruebas">
        <!-- Prueba 1 (inicial) -->
        <div class="prueba-item mb-3 border p-3" data-prueba="1">
            <div class="row">
                <div class="col-lg-10">
                    <h6>Prueba 1</h6>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-danger btn-sm eliminar-prueba" data-prueba="1" style="display: none;">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <input type="text" class="form-control mb-2" name="pruebas[1][tipo_analisis]"
                placeholder="Tipo de análisis solicitado (hemograma, perfil bioquímico, etc.)">
            <input type="text" class="form-control mb-2" name="pruebas[1][muestras]"
                placeholder="Muestras a recolectar (sangre, orina, etc.)">
            <input type="text" class="form-control mb-2" name="pruebas[1][preparacion]"
                placeholder="Indicaciones sobre la preparación del paciente (ayuno, suspensión de medicamentos, etc.)">
            <input type="text" class="form-control mb-2" name="pruebas[1][prioridad]"
                placeholder="Prioridad del examen (urgente, programado, etc.)">
            <input type="text" class="form-control mb-2" name="pruebas[1][lugar_realizacion]"
                placeholder="Lugar de realización y/o envío de muestras">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="enviar">
                Enviar al paciente
            </button>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="imprimir">
                Imprimir
            </button>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="pdf">
                Exportar en PDF
            </button>
        </div>
    </div>
</form>
@stop

@section('js')
<script>
    let contadorPruebas = 1;

    $(document).ready(function() {
        // Funcionalidad de búsqueda de pacientes
        $('#buscar_paciente').on('input', function() {
            const query = $(this).val();
            if (query.length >= 2) {
                $.ajax({
                    url: '/profesional/pacientes/buscar',
                    data: { q: query },
                    success: function(data) {
                        let lista = data.map(p =>
                            `<li class="list-group-item list-group-item-action" data-id="${p.id}" style="cursor: pointer;">${p.nombre_completo}</li>`
                        ).join('');
                        $('#resultados-pacientes').html(`<ul class="list-group mt-2">${lista}</ul>`);
                    }
                });
            } else {
                $('#resultados-pacientes').empty();
            }
        });

        // Al seleccionar paciente
        $(document).on('click', '#resultados-pacientes li', function() {
            const pacienteId = $(this).data('id');
            const pacienteInfo = $(this).text().split(' - ');
            const pacienteNombre = pacienteInfo[0];

            $('#buscar_paciente').val(pacienteNombre);
            $('#paciente_id').val(pacienteId);
            $('#resultados-pacientes').empty();
        });

        // Limpiar resultados al hacer clic fuera
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#buscar_paciente, #resultados-pacientes').length) {
                $('#resultados-pacientes').empty();
            }
        });

        // Agregar nueva prueba
        $('#agregar-prueba').on('click', function() {
            contadorPruebas++;

            const nuevaPrueba = `
                <div class="prueba-item mb-3 border p-3" data-prueba="${contadorPruebas}">
                    <div class="row">
                        <div class="col-lg-10">
                            <h6>Prueba ${contadorPruebas}</h6>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm eliminar-prueba" data-prueba="${contadorPruebas}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-2" name="pruebas[${contadorPruebas}][tipo_analisis]"
                        placeholder="Tipo de análisis solicitado (hemograma, perfil bioquímico, etc.)">
                    <input type="text" class="form-control mb-2" name="pruebas[${contadorPruebas}][muestras]"
                        placeholder="Muestras a recolectar (sangre, orina, etc.)">
                    <input type="text" class="form-control mb-2" name="pruebas[${contadorPruebas}][preparacion]"
                        placeholder="Indicaciones sobre la preparación del paciente (ayuno, suspensión de medicamentos, etc.)">
                    <input type="text" class="form-control mb-2" name="pruebas[${contadorPruebas}][prioridad]"
                        placeholder="Prioridad del examen (urgente, programado, etc.)">
                    <input type="text" class="form-control mb-2" name="pruebas[${contadorPruebas}][lugar_realizacion]"
                        placeholder="Lugar de realización y/o envío de muestras">
                </div>
            `;

            $('#contenedor-pruebas').append(nuevaPrueba);

            // Mostrar botón de eliminar para todas las pruebas si hay más de una
            if ($('.prueba-item').length > 1) {
                $('.eliminar-prueba').show();
            }
        });

        // Eliminar prueba
        $(document).on('click', '.eliminar-prueba', function() {
            const pruebaId = $(this).data('prueba');
            $(`.prueba-item[data-prueba="${pruebaId}"]`).remove();

            // Ocultar botón de eliminar si solo queda una prueba
            if ($('.prueba-item').length <= 1) {
                $('.eliminar-prueba').hide();
            }

            // Renumerar las pruebas
            renumerarPruebas();
        });

        function renumerarPruebas() {
            $('.prueba-item').each(function(index) {
                const nuevoNumero = index + 1;
                $(this).find('h6').text(`Prueba ${nuevoNumero}`);
            });
        }

        // Validación del formulario
        $('#form-pedido-laboratorio').on('submit', function(e) {
            // Validar que hay un paciente seleccionado
            if (!$('#paciente_id').val()) {
                e.preventDefault();
                alert('Por favor, seleccione un paciente.');
                return false;
            }

            // Validar que hay al menos una especialidad seleccionada
            if (!$('#especialidad_profesional').val()) {
                e.preventDefault();
                alert('Por favor, seleccione una especialidad.');
                return false;
            }

            // Validar que hay al menos una prueba completa
            let pruebaCompleta = false;
            $('.prueba-item').each(function() {
                const tipoAnalisis = $(this).find('input[name*="[tipo_analisis]"]').val();
                if (tipoAnalisis && tipoAnalisis.trim() !== '') {
                    pruebaCompleta = true;
                    return false; // break
                }
            });

            if (!pruebaCompleta) {
                e.preventDefault();
                alert('Por favor, complete al menos una prueba con el tipo de análisis.');
                return false;
            }

            return true;
        });
    });
</script>
@endsection
