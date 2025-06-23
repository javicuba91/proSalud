@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de centros de imágenes')

@section('content_header')
    <h1>Elaboración de pedidos de centros de imágenes</h1>
@stop

@section('content')
    <!-- Datos del paciente -->
    <h5>Datos del paciente</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Buscar paciente">
        </div>
        <div class="col-md-4">
            <a href="/profesional/paciente/crear" class="btn btn-dark w-100">Añadir nuevo paciente</a>
        </div>
    </div>

    <!-- Datos del médico -->
    <h5>Datos del médico</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Nombre completo">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Especialidad">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Número de colegiado">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Centro médico o consultorio">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" placeholder="Forma de contacto (email/teléfono)">
        </div>
    </div>

    <!-- Datos del pedido -->
    <h5>Datos del pedido</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Código QR">
        </div>
        <div class="col-md-6">
            <input type="date" class="form-control" placeholder="Fecha de emisión">
        </div>
    </div>

    <!-- Información clínica -->
    <h5>Información clínica</h5>
    <div class="mb-3 border p-2">
        <input type="text" class="form-control mb-2"
            placeholder="Motivo del estudio (dolor abdominal, trauma, sospecha de patología específica, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Síntomas relevantes y hallazgos del examen físico">
        <input type="text" class="form-control"
            placeholder="Antecedentes clínicos que puedan influir en la elección del estudio">
    </div>

    <!-- Prueba 1 -->
    <h5>Prueba 1</h5>
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
