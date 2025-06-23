@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Login')</title>

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
                    <h3 class="mb-1">Iniciar Sesión</h3>

                    <div class="row mb-4 mt-2">
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-dark w-100">Con Gmail</a>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-dark w-100">Con Facebook</a>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 text-start">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start position-relative">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        
                            <!-- Icono de ver/ocultar -->
                            <span id="togglePassword" onclick="togglePasswordVisibility()" class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye"  style="cursor:pointer;"></i>
                            </span>
                        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                        <div class="d-flex justify-content-between mb-3">
                            <small>Recordar</small>
                            <a href="#" class="text-decoration-none text-dark"><small>¿Contraseña
                                    olvidada?</small></a>
                        </div>
                        <button type="submit" class="btn btn-dark w-30 btnLogin">Acceder</button>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <p>¿Aún no estás registrado?</p>
                    <a href="/pacientes/registro" class="btn btn-outline-dark">Registrarme</a>
                </div>
            </div>
        </div>

    </div>
@endsection()

@section('js')
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
        }
    </script>    
@endsection