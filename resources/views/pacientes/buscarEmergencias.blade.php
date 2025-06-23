@extends('adminlte::page')

@section('title', 'Emergencias')

@section('content_header')
    <h1>Emergencias</h1>
@stop

@section('content')

    <div class="row bg-light p-3">
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Servicio</button>
        </div>
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Provincia</button>
        </div>
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Ciudad</button>
        </div>
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Geolocalizar</button>
        </div>
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Más filtros</button>
        </div>
        <div class="col-md">
            <button class="btn btn-dark w-100">Aplicar filtros</button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Emergencias</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            @foreach ($emergencias as $emergencia)
            <div class="border p-2 mb-2">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <button class="btn btn-dark w-100">Tipo de servicio: {{$emergencia->tipo}}</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" value="{{$emergencia->provincia->nombre}}" placeholder="Provincia">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" value="{{$emergencia->ciudad->nombre}}" class="form-control" placeholder="Ciudad">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" value="{{$emergencia->direccion}}" class="form-control" placeholder="Dirección completa">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-2">
                        <a type="text" class="btn btn-danger text-white w-100">Marcar como favorito</a>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <a type="text" class="btn btn-success text-white w-100">Valoraciones</a>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <button class="btn btn-dark w-100">Solicitar</button>
                    </div>
                </div>
            </div>
                
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d432.49703688644036!2d-0.3992071667527209!3d39.41308034348533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604e9a0bba57dd%3A0x68c95564bacffaeb!2sMercadona!5e0!3m2!1ses!2ses!4v1745264119387!5m2!1ses!2ses"
                    style="width: 100%; height: 76.4vh" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <button class="btn w-100 btn-outline-secondary text-dark">Ampliar mapa</button>
                </div>
            </div>
        </div>
    </div>
@stop
