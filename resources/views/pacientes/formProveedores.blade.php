@extends('adminlte::page')

@section('title', 'Pedir presupuesto proveedores')

@section('content_header')
    <h1>Pedir presupuesto</h1>
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

    <div class="row justify-content-center g-4 mt-5">
        <div class="col-6 col-md-2  mb-4">
            <div class="icon-card">
                <a class="text-dark" href="/paciente/buscar-proveedores/presupuestos">
                    <i class="fas fa-prescription-bottle-alt icon-fa"></i>
                    <p>Farmacias</p>
                </a>
            </div>
        </div>
        <div class="col-6 col-md-2  mb-4">
            <div class="icon-card">
                <i class="fas fa-vials icon-fa"></i>
                <p>Laboratorio clínico</p>
            </div>
        </div>
        <div class="col-6 col-md-2  mb-4">
            <div class="icon-card">
                <i class="fas fa-x-ray icon-fa"></i>
                <p>Centros de imágenes</p>
            </div>
        </div>
    </div>
@stop
