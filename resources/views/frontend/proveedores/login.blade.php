@extends('frontend.proveedores.layout')

<title>@yield('title', 'ProSalud - Login')</title>

@section('content')
    <div class="container py-5 text-center">

        <div class="row">
            <div class="col-lg-4 offset-4">
                <div class="login-box text-center">
                    <h3 class="mb-4">Iniciar sesión</h3>
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
                    <p>¿Aún no te has unido?</p>
                    <a href="/proveedores/registro" class="btn btn-outline-dark">Unirme</a>
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