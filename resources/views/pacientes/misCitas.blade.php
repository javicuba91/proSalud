@extends('adminlte::page')

@section('title', 'Mis Citas')

@section('content_header')
    <h1>Mis Citas</h1>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <h5>Mis citas pendientes</h5>
        </div>
    </div>
    @php
        use Illuminate\Support\Str;
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp
    @foreach ($citas->where('estado', 'pendiente') as $cita)
        <div class="row mb-2 border p-2">
            <div class="col-md-2 text-center">
                {!! QrCode::size(60)->generate($cita->codigo_qr) !!}
            </div>
            <div class="col-md-3">
                <input type="text" value="{{$cita->motivo}}" class="form-control" placeholder="Breve motivo de la consulta">
            </div>
            <div class="col-md-3">
                <input type="datetime-local" value="{{$cita->fecha_hora}}" class="form-control" placeholder="Fecha">
            </div>
            <div class="col-md-2">
                <input type="text" value="{{$cita->profesional->nombre_completo}}" class="form-control" placeholder="Médico asignado">
            </div>
            <div class="col-md-2">
                <a href="/paciente/mis-citas/{{$cita->id}}/detalle" class="btn btn-dark w-100">Ver/modificar cita</a>
            </div>
        </div>
    @endforeach

    <div class="row mb-3 mt-4">
        <div class="col-lg-12">
            <h5>Mis citas aceptadas</h5>
        </div>
    </div>

    @foreach ($citas->where('estado', 'aceptada') as $cita)
        <div class="row mb-2 border p-2">
            <div class="col-md text-center">
                {!! QrCode::size(60)->generate($cita->codigo_qr) !!}
            </div>
            <div class="col-md">
                <input value="{{$cita->motivo}}" type="text" class="form-control" placeholder="Breve motivo de la consulta">
            </div>
            <div class="col-md">
                <input type="datetime-local" value="{{$cita->fecha_hora}}" class="form-control" placeholder="Fecha">
            </div>
            <div class="col-md">
                <input type="text" value="{{$cita->profesional->nombre_completo}}" class="form-control" placeholder="Médico asignado">
            </div>
            <div class="col-md">
                <input type="text" value="{{ucfirst($cita->estado)}}"  class="form-control" placeholder="Estado">
            </div>
            <div class="col-md">
                <a href="/paciente/mis-citas/{{$cita->id}}/detalle" class="btn btn-dark w-100">Ver/modificar cita</a>
            </div>
        </div>
    @endforeach

@stop
