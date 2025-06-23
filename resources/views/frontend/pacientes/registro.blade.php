@extends('frontend.pacientes.layout')

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
                    <h3 class="mb-1">Registrarme</h3>

                    <div class="row mb-4 mt-2">
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-dark w-100">Con Gmail</a>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-dark w-100">Con Facebook</a>
                        </div>
                    </div>

                    <form action="{{ route('pacientes.registroPaciente') }}" method="POST">
                        @csrf                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="nombre" type="text" class="form-control"
                                        placeholder="Nombre completo">
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
                                    <input name="repetir_email" type="email" class="form-control" placeholder="Repetir Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="password" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3 text-start">
                                    <input name="repetir_password" type="password" class="form-control" placeholder="Repetir contraseña">
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
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-dark w-30 btnLogin">Registrarme</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <p>¿Ya estás registrado?</p>
                    <a href="/pacientes/login" class="btn btn-outline-dark">Iniciar sesión</a>
                </div>
            </div>
        </div>

    </div>
@endsection()
