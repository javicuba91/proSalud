@extends('adminlte::page')

@section('title', 'Contactar al Administrador')

@section('content_header')
    <h1>Contactar al Administrador</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h6>Contactar con atención al cliente</h6>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h4>Atención al cliente</h4>
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-phone"></i> 600 000 000
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-clock"></i> Horario de atención: 9:00 a 16:00 horas
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-envelope"></i> Contactar por chat
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Contactar con el administrador --}}
    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Contactar con el administrador</h5>
        </div>
    </div>
    <form method="POST" action="{{ route('proveedor.contactos.store') }}">
        @csrf
        <div class="row mt-1">
            <div class="col-md-12 mb-2">
                <input type="text" class="form-control" name="motivo" placeholder="Breve motivo de tu consulta"
                    required>
            </div>
            <div class="col-md-12 mb-2">
                <textarea rows="5" class="form-control" name="descripcion" placeholder="Descripción de tu consulta" required></textarea>
            </div>
            <div class="col-md-12 mb-2 text-center mt-2">
                <button class="btn btn-dark">Enviar</button>
            </div>
        </div>
    </form>

    {{-- Consultas pendientes --}}
    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Mis consultas pendientes</h5>
        </div>
    </div>
    <div class="row mt-1 border p-2">
        @foreach ($proveedor->contactos->whereNull('respuesta') as $contacto)
            <div class="col-md-5 mb-2">
                <label>Motivo:</label>
                <input type="text" class="form-control" value="{{ $contacto->motivo }}" readonly>
            </div>
            <div class="col-md-5 mb-2">
                <label>Fecha Consulta:</label>
                <input type="text" class="form-control" value="{{ $contacto->created_at->format('d-m-Y') }}" readonly>
            </div>
            <div class="col-md-2 mb-2">
                <label>&nbsp;</label>
                <button class="btn btn-dark w-100" type="button" data-toggle="collapse"
                    data-target="#consulta-{{ $contacto->id }}">
                    Ver consulta
                </button>
            </div>
            <div class="col-md-12 mb-2 collapse" id="consulta-{{ $contacto->id }}">
                <label>Tu consulta:</label>
                <textarea class="form-control" rows="5" readonly>{{ $contacto->descripcion }}</textarea>
            </div>
        @endforeach
    </div>

    {{-- Consultas pasadas --}}
    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Mis consultas pasadas</h5>
        </div>
    </div>
    <div class="row mt-1 border p-2">
        @foreach ($proveedor->contactos->whereNotNull('respuesta') as $contacto)
            <div class="col-md-5 mb-2">
                <label>Motivo:</label>
                <input type="text" class="form-control" value="{{ $contacto->motivo }}" readonly>
            </div>
            <div class="col-md-5 mb-2">
                <label>Fecha Respuesta:</label>
                <input type="text" class="form-control" value="{{date('d-m-Y', strtotime($contacto->fecha_respuesta)) }}" readonly>
            </div>
            <div class="col-md-2 mb-2">
                <label>&nbsp;</label>
                <button class="btn btn-dark w-100" type="button" data-toggle="collapse"
                    data-target="#consulta-pasada-{{ $contacto->id }}">
                    Ver consulta
                </button>
            </div>
            <div class="col-md-12 mb-2 collapse" id="consulta-pasada-{{ $contacto->id }}">
                <label>Tu consulta:</label>
                <textarea class="form-control mb-2" rows="5" readonly>{{ $contacto->descripcion }}</textarea>
                <label>Respuesta del administrador:</label>
                <textarea class="form-control" rows="3" readonly>{{ $contacto->respuesta }}</textarea>
            </div>
        @endforeach
    </div>



@stop
