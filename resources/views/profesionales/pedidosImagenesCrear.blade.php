@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de centros de imágenes')

@section('content_header')
    <h1>Elaboración de pedidos de centros de imágenes</h1>
@stop

@section('css')
    <style>
        .profile-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="row">
        <div class="col-lg-2 mb-3">
            <img class="img img-responsive img-fluid profile-image" src="{{ asset('imagenes/logo.png') }}" alt="">
        </div>
        <div class="col-lg-2 mb-3">
            <img class="img img-responsive img-fluid profile-image" src="{{ asset($profesional->logo) }}" alt="">
        </div>
    </div>

    <h5>Datos del paciente</h5>
    <div class="row mb-3 border p-2">
        <div class="col-lg-4 mb-3">
            <label class="form-label">Nombre paciente</label>
            <input value="{{ $cita->paciente->nombre_completo }}" type="text" class="form-control" readonly disabled>
        </div>
        <div class="col-lg-4 mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input value="{{ $cita->paciente->fecha_nacimiento }}" type="date" class="form-control" readonly disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Cédula</label>
            <input value="{{ $cita->paciente->cedula }}" type="text" class="form-control" readonly disabled>
        </div>
    </div>

    <!-- Datos del médico -->
    <h5>Datos del médico</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->nombre_completo }}" class="form-control" readonly disabled
                placeholder="Nombre completo">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->fecha_nacimiento }}" class="form-control" readonly disabled
                placeholder="Especialidad">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->num_colegiado }}" class="form-control" readonly disabled
                placeholder="Número de colegiado">
        </div>
        @if ($cita->modalidad == 'presencial')
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ optional($cita->consultorio)->direccion }}" class="form-control" readonly
                    disabled placeholder="Centro médico o consultorio">
            </div>
        @else
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ $cita->url_meet }}" class="form-control" readonly disabled
                    placeholder="Enlace de Google Meet">
            </div>
        @endif
        <div class="col-12">
            <input type="text" value="{{ $cita->profesional->email }} / {{ $cita->profesional->telefono_personal }}"
                class="form-control" readonly disabled placeholder="Forma de contacto (email/teléfono)">
        </div>
    </div>


    <form action="{{ route('profesional.pedido-imagenes.update') }}" method="POST" id="formulario-pedido">
        @csrf
        <h5>Datos del pedido</h5>
        <div class="row mb-3 border p-2">
            <div class="col-md-6">
                @if ($pedido->qr == null)
                    {!! QrCode::size(100)->generate('LAB-' . $profesional->id . '-' . date('YmdHis')) !!}
                    <input name="qr" type="text" class="form-control mt-3 align-self-end" placeholder="Código QR"
                        value="{{ 'LAB-' . $profesional->id . '-' . date('YmdHis') }}" readonly>
                @else
                    {!! QrCode::size(100)->generate($pedido->qr) !!}
                    <input type="text" class="form-control mt-3 align-self-end" placeholder="Código QR"
                        value="{{ $pedido->qr }}" readonly>
                @endif
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column h-100 justify-content-end" style="height: 100%;">
                    <input type="date" class="form-control mt-3 align-self-end" placeholder="Fecha de emisión"
                        value="{{ date('Y-m-d') }}" readonly disabled>
                </div>
            </div>
        </div>

        <!-- Información clínica -->

        <input type="hidden" name="pedido_imagen_id" value="{{ $pedido->id }}">

        <h5>Información clínica</h5>
        <div class="mb-3 border p-2">
            <label for="motivo">Motivo:</label>
            <input type="text" class="form-control mb-2" name="motivo"
                value="{{ old('motivo', $pedido->motivo ?? '') }}"
                placeholder="Motivo del estudio (dolor abdominal, trauma, sospecha de patología específica, etc.)">

            <label for="sintomas">Síntomas:</label>
            <input type="text" class="form-control mb-2" name="sintomas"
                value="{{ old('sintomas', $pedido->sintomas ?? '') }}"
                placeholder="Síntomas relevantes y hallazgos del examen físico">

            <label for="antecedentes">Antecedentes:</label>
            <input type="text" class="form-control" name="antecedentes"
                value="{{ old('antecedentes', $pedido->antecedentes ?? '') }}"
                placeholder="Antecedentes clínicos que puedan influir en la elección del estudio">
        </div>
        <div class="row mt-3 mb-4">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-dark" id="agregar-prueba">
                    <i class="fa fa-save"></i> Guardar información clínica
                </button>
            </div>
        </div>
    </form>

    <!-- Prueba 1 -->
    <div class="row mb-3">
        <div class="col-lg-10">
            <h5>Pruebas de imágenes</h5>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-dark w-100" id="agregar-prueba">
                <i class="fa fa-plus"></i> Agregar prueba
            </button>
        </div>
    </div>
    <div class="mb-3 border p-3">
        <input type="text" class="form-control mb-2"
            placeholder="Tipo de estudio solicitado (radiografía, ecografía, tomografía, resonancia, etc.)">
        <input type="text" class="form-control mb-2"
            placeholder="Región anatómica a estudiar (cráneo, abdomen, articulaciones, etc.)">
        <input type="text" class="form-control mb-2"
            placeholder="Instrucciones especiales (contraste, ayuno, movimientos, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Prioridad del examen (urgente, programado, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Lugar de realización y/o envío de muestras">
    </div>

    <!-- Botones -->
    <div class="row mb-3">
        <div class="col-lg-4"><button class="btn btn-dark w-100">Enviar al paciente</button></div>
        <div class="col-lg-4"><button class="btn btn-dark w-100">Imprimir</button></div>
        <div class="col-lg-4"><button class="btn btn-dark w-100">Exportar en PDF</button></div>
    </div>
@stop
