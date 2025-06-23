@extends('adminlte::page')

@section('title', 'Mis Recetas')

@section('content_header')
    <h1>Mis Recetas: {{$paciente->nombre_completo}}</h1>
@stop

@section('content')

    @php
        use Illuminate\Support\Str;
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp

    @foreach ($recetas as $receta )
        <div class="row mb-3 border p-2">
            <div class="col-md">
                {!! QrCode::size(pixels: 150)->generate($receta->qr) !!}
            </div>
            <div class="col-md">
                <input readonly disabled value="{{date("d-m-Y",strtotime($receta->fecha_emision))}}" type="text" class="form-control" placeholder="Fecha">
            </div>
            <div class="col-md">
                <input readonly disabled value="{{$receta->motivo}}" type="text" class="form-control" placeholder="Breve motivo de la consulta">
            </div>
            <div class="col-md">
                <input readonly disabled value="{{$receta->medicoReceta}}" type="text" class="form-control" placeholder="Médico que recetó">
            </div>
            <div class="col-md">
                <input readonly disabled value="{{App\Models\EspecializacionesProfesional::find($receta->especializacion_id)->especialidad->nombre}}" type="text" class="form-control" placeholder="Especialidad">
            </div>
            <div class="col-md">
                <a href="/paciente/cita/informe-consulta/{{$receta->informe_consulta_id}}/receta" class="btn btn-dark w-100">Ver receta</a>
            </div>
        </div>    
    @endforeach
    
@stop
