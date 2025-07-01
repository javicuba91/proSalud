@extends('adminlte::page')

@section('title', 'Datos personales')

@section('css')
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection


@section('content_header')
    <div class="row align-items-center mb-3">
        <div class="col-lg-12">
            <h1>Datos personales</h1>
        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form enctype="multipart/form-data" method="POST" action="{{ route('profesionales.guardarPaciente') }}">
        @csrf

        <div class="border p-4 mb-2">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="foto">Foto de perfil</label>
                    <input name="foto" type="file" class="form-control" id="foto"
                        placeholder="Foto">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombre_completo">Nombre completo</label>
                    <input name="nombre_completo" type="text" class="form-control" id="nombre_completo"
                        placeholder="Nombre completo">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input name="fecha_nacimiento" type="date" class="form-control" id="fecha_nacimiento"
                        placeholder="Fecha de nacimiento">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="form-control form-select">
                        <option value="">Seleccione su género</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="estado_civil">Estado civil</label>
                    <select id="estado_civil" name="estado_civil"
                        class="form-control @error('estado_civil') is-invalid @enderror" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Unión libre">Unión libre</option>
                        <option value="Pareja de hecho">Pareja de hecho</option>
                        <option value="Viudo">Viudo</option>
                        <option value="Divorciado">Divorciado</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input name="nacionalidad" type="text" class="form-control" id="nacionalidad"
                        placeholder="Nacionalidad">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="celular">Celular</label>
                    <input name="celular" type="text" class="form-control" id="celular"
                        placeholder="Celular">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                        placeholder="Email">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion">Dirección de residencia</label>
                    <input name="direccion" type="text" class="form-control" id="direccion"
                        placeholder="Dirección de residencia">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="ciudad_id">Ciudad</label>
                    <select name="ciudad_id" class="form-control form-select" id="ciudad_id">
                        <option value="">Seleccione una ciudad</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}">
                                {{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="cedula">Cédula</label>
                    <input name="cedula" type="text" class="form-control" id="cedula"
                        placeholder="Cédula">
                </div>
                <div class="col-md-3 mb-2">
                    <label for="grupo">Grupo sanguíneo</label>
                    <select class="form-control" name="grupo" id="grupo">
                        <option value="">Seleccione grupo</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label for="rh">Factor RH</label>
                    <select class="form-control" name="rh" id="rh">
                        <option value="">Seleccione RH</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button id="guardarDatos" type="submit" class="btn btn-dark mr-2">Guardar
                        cambios</button>
                </div>
            </div>
        </div>

    </form>

@stop

