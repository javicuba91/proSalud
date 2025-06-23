@extends('adminlte::page')

@section('title', 'Pedir Cita')

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

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <a class="text-dark" href="/paciente/buscar-profesionales">
                    <div class="icon-card text-center">
                        <i class="fas fa-user-md icon-fa"></i>
                        <p>Profesionales</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <div class="icon-card text-center">
                    <i class="fas fa-dumbbell icon-fa"></i>
                    <p>Proveedores</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <a class="text-dark" href="/pacientes/buscar/emergencias">
                    <div class="icon-card text-center">
                        <i class="fas fa-syringe icon-fa"></i>
                        <p>Emergencia</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

@stop
