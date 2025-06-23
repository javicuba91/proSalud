@extends('adminlte::page')

@section('title', 'Pedir presupuesto')

@section('content_header')
    <h1>Pedir presupuesto</h1>
@stop

@section('content')

    <div class="row bg-light p-3">
        <div class="col-md">
            <button class="btn btn-outline-secondary w-100">Disponibilidad</button>
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
            <h3 class="">Farmacias</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="border p-2 mb-2">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Foto">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Nombre centro">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Tipo de servicio: Farmacias</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Provincia">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Ciudad">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Dirección completa">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Marcar como favorito">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Valoraciones">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Horario de atención">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Seguros con los que trabaja">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Ver perfil</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Pedir presupuesto</button>
                    </div>
                </div>
            </div>
            <div class="border p-2 mb-2">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Foto">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Nombre centro">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Tipo de servicio: Farmacias</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Provincia">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Ciudad">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Dirección completa">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Marcar como favorito">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Valoraciones">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Horario de atención">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Seguros con los que trabaja">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Ver perfil</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Pedir presupuesto</button>
                    </div>
                </div>
            </div>
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
