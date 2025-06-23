@extends('adminlte::page')

@section('title', 'Mis Planes')

@section('content_header')
    <h1>Mis Planes</h1>
@stop

@section('content')
    <style>
        .plan-card {
            border: 1px solid #dee2e6;
            padding: 2rem;
            background-color: #f8f9fa;
            height: 100%;
        }

        .plan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .plan-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .plan-current {
            background-color: #dee2e6;
            color: black;
        }

        .btn-plan {
            margin-top: 1.5rem;
        }
    </style>

    <div class="row mb-2">
        <!-- Plan Básico -->
        <div class="col-md-4 mb-2">
            <div class="plan-card plan-current">
                <div class="plan-header">
                    <div>Básico</div>
                    <div class="plan-price">80$</div>
                </div>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <ul class="mt-3">
                    <li>Plataforma web y Aplicación móvil.</li>
                    <li>Perfil de usuario</li>
                    <li>Visibilidad online (Google, Facebook, Instagram).</li>
                    <li>Agenda para el paciente en plataforma.</li>
                    <li>Estadísticas.</li>
                    <li>Sincronización con agendas externas (Google calendar).</li>
                    <li>Video consultas.</li>
                    <li>Llamadas gratuitas para pacientes, directo al consultorio.</li>
                    <li>50 mensajes de Whatsapp por mes, 2 recordatorios por cita.</li>
                    <li>Reseñas de pacientes post cita.</li>
                </ul>
                <button class="btn btn-dark w-100 mt-3">Plan actual</button>
            </div>
        </div>

        <!-- Plan Avanzado -->
        <div class="col-md-4 mb-2">
            <div class="plan-card">
                <div class="plan-header">
                    <div>Avanzado</div>
                    <div class="plan-price">120$</div>
                </div>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <ul class="mt-3">
                    <li>Todo lo del Básico, más:</li>
                    <li>Chat de pacientes.</li>
                    <li>Panel de administrador de tareas.</li>
                    <li>Notificaciones por Whatsapp (100).</li>
                    <li>Notificaciones por Mail ilimitadas.</li>
                    <li>Usuario adicional.</li>
                    <li>Google my business.</li>
                    <li>Consultorio adicional.</li>
                </ul>
                <button class="btn btn-outline-dark w-100 mt-3">Cambiar a este plan</button>
            </div>
        </div>

        <!-- Plan Premium -->
        <div class="col-md-4 mb-2">
            <div class="plan-card">
                <div class="plan-header">
                    <div>Premium</div>
                    <div class="plan-price">150$</div>
                </div>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <ul class="mt-3">
                    <li>Todo lo del Avanzado, más:</li>
                    <li>Diseño personalizado de perfil</li>
                    <li>Ranking ProSalud por especialidades</li>
                    <li>Consultorios ilimitados.</li>
                    <li>Historia clínica digital.</li>
                    <li>Recetas digitales.</li>
                    <li>Campañas SMS</li>
                    <li>¿Facturas electrónicas???</li>
                </ul>
                <button class="btn btn-outline-dark w-100 mt-3">Cambiar a este plan</button>
            </div>
        </div>
    </div>
@stop
