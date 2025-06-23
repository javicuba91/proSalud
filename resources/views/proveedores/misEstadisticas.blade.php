@extends('adminlte::page')

@section('title', 'Mis Estadísticas')

@section('content_header')
    <h1>Mis Estadísticas</h1>
@stop

@section('content')
    <style>
        .icon-card {
            border: 1px solid #ccc;
            padding: 70px;
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

    <div class="row">
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">
                <a class="text-dark" href="/paciente/buscar-proveedores">
                    <p>Número de pacientes atendidos</p>
                </a>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Número de citas canceladas</p>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Comentarios recibidos / 
                Valoración <i class="fa fa-star"></i></p>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Presupuestos recibidos</p>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Presupuestos contestados</p>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Presupuestos aceptados</p>
            </div>
        </div>
        <div class="col-6 col-md-4  mb-4">
            <div class="icon-card">                
                <p>Veces que vieron tu/s teléfono/s</p>
            </div>
        </div>
    </div>
@stop
