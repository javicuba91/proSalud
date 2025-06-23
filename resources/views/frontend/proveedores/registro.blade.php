@extends('frontend.proveedores.layout')

<title>@yield('title', 'ProSalud - Registro')</title>

@section('content')
    <div class="container py-5 text-center">

        <div class="row">
            <div class="col-lg-4 offset-4">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="login-box text-center">
                    <h3 class="mb-1">Solicitar unirme</h3>
                    <p class="mb-3">Contactaremos contigo lo antes posible.</p>
                    <form action="{{ route('proveedores.registroProveedor') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <select name="tipo" id="" class="form-control form-select">
                                        <option value="farmacia">Farmacia</option>
                                        <option value="laboratorio">Laboratorio</option>
                                        <option value="centro_imagenes">Centro imágenes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="nombre" type="text" class="form-control"
                                        placeholder="Nombre de la clínica/centro">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="ciudad" type="text" class="form-control" placeholder="Ciudad">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="direccion" type="text" class="form-control"
                                        placeholder="Dirección completa">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="numero_identificacion" type="text" class="form-control"
                                        placeholder="Número identificación (RUC)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="email" type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="telefono" type="text" class="form-control" placeholder="Teléfono">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Acepto el aviso legal y las políticas de privacidad.
                                </label>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-dark w-30 btnLogin float-start">Solicitar
                                    unirme</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <p>Ya te has unido?</p>
                    <a href="/profesionales/login" class="btn btn-outline-dark">Iniciar sesión</a>
                </div>
            </div>
        </div>

    </div>
@endsection()
