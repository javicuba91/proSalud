@extends('adminlte::page')

@section('title', 'Pedir Cita Profesionales')

@section('content_header')
    <h1>Pedir Cita</h1>
@stop

@section('content')

    <style>
        .icon-card {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s;
        }

        .icon-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .icon-fa {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #333;
        }
    </style>

    <div class="row justify-content-center my-4">
        <div class="col-4 col-md-2">
            <a class="text-dark" href="/pacientes/buscar/medicos">
                <div class="icon-card">
                    <a class="text-dark" href="/pacientes/buscar/medicos">
                        <i class="fas fa-user-md icon-fa"></i>
                        <p>Médicos</p>
                    </a>
                </div>
            </a>
        </div>
    </div>


    <div class="row justify-content-center g-4">
        @foreach ($categorias_profesionales as $categoria)
            <div class="col-6 col-md-2 mb-4">
                <div class="icon-card">
                    <a class="text-dark" href="/pacientes/buscar/medicos">
                        <i class="fas fa-user icon-fa"></i>
                        <p>{{ $categoria->nombre }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@stop
