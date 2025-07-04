@extends('frontend.profesionales.layout')

@section('title')
    ProSalud - Registro
@endsection


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
                    <form action="{{ route('profesionales.registroProfesional') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 text-start">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 text-start">
                                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input type="text" class="form-control" name="telefono" placeholder="Celular">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <select class="form-control" name="ciudad" id="ciudad-select" required>
                                        <option value="" disabled selected>Selecciona una ciudad</option>
                                        @foreach ($ciudades as $ciudad)
                                            <option value="{{ $ciudad->nombre }}">{{ $ciudad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3 text-start">
                            <input type="text" class="form-control" name="cedula" placeholder="Número de cédula">
                        </div>
                        <div class="mb-3 text-start">
                            <select class="form-select" name="categoria_id" required>
                                <option value="" disabled selected>Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
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
