@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de laboratorio')

@section('content_header')
    <h1>Elaboración de pedidos de laboratorio</h1>
@stop

@section('content')
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
            placeholder="Motivo del examen (ej. sospecha de infección, control de glucosa, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Antecedentes médicos relevantes">
        <input type="text" class="form-control mb-2" placeholder="Síntomas presentados">
    </div>

    <!-- Prueba 1 -->
    <h5>Prueba 1</h5>
    <div class="mb-3 border p-3">
        <input type="text" class="form-control mb-2"
            placeholder="Tipo de análisis solicitado (hemograma, perfil bioquímico, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Muestras a recolectar (sangre, orina, etc.)">
        <input type="text" class="form-control mb-2"
            placeholder="Indicaciones sobre la preparación del paciente (ayuno, suspensión de medicamentos, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Prioridad del examen (urgente, programado, etc.)">
        <input type="text" class="form-control mb-2" placeholder="Lugar de realización y/o envío de muestras">
    </div>
   
    <div class="row mb-3">
        <div class="col-lg-4"><button class="btn btn-dark w-100">Enviar al paciente</button></div>
        <div class="col-lg-4"><button class="btn btn-dark w-100">Imprimir</button></div>
        <div class="col-lg-4"><button class="btn btn-dark w-100">Exportar en PDF</button></div>
    </div>
@stop
