@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>
        Bienvenidos al Panel de Administración</h1>
@stop

@section('css')
    <style>
        .toast {
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;
        }

        .toast-success {
            background-color: #e6f4ea;
            border-left: 5px solid #28a745;
        }

        .toast-header {
            background-color: transparent;
            border-bottom: none;
            font-weight: 600;
        }

        .toast-body {
            color: #2e654b;
            font-size: 0.95rem;
        }
    </style>

@endsection

@section('content')

    @if($total_notificaciones > 0)       
        <div style="position: fixed; top: 4rem; right: 1rem; z-index: 1055;">
            <div id="myToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success mr-2"></i>
                    <strong class="mr-auto text-success">Acciones pendientes</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Debes revisar las <a href="/admin/notificaciones">notificaciones pendientes</a> para completar las acciones requeridas.
                </div>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="info-box mb-3">
                <span style="background-color: hotpink; color: black;" class="info-box-icon elevation-1"><i
                        class="fas fa-bell"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Notificaciones ({{ $total_notificaciones }})</span>
                    <div class="row">
                        <div class="col-4">
                            <strong>Doc. Pendientes Profesional ({{ $total_documentos_profesionales }})</strong>
                            <ul>
                                @foreach ($documentos_profesionales as $documento_profesional)
                                    <li>{{ $documento_profesional->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-4">
                            <strong>Doc. Pendientes Proveedor ({{ $total_documentos_proveedores }})</strong>
                            <ul>
                                @foreach ($documentos_proveedores as $documento_proveedor)
                                    <li>{{ $documento_proveedor->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-4">
                            <strong>Contactos Profesional ({{ $total_contacto_profesionales }})</strong>
                            <ul>
                                @foreach ($contacto_profesionales as $contacto_profesional)
                                    <li>{{ $contacto_profesional->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-4">
                            <strong>Contactos Proveedor ({{ $total_contacto_proveedores }})</strong>
                            <ul>
                                @foreach ($contacto_proveedores as $contacto_proveedor)
                                    <li>{{ $contacto_proveedor->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-4">
                            <strong>Valoraciones Profesional ({{ $total_valoraciones_profesionales }})</strong>
                            <ul>
                                @foreach ($valoraciones_profesionales as $valoracion_profesional)
                                    <li>{{ $valoracion_profesional->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-4">
                            <strong>Valoraciones Proveedor ({{ $total_valoraciones_proveedores }})</strong>
                            <ul>
                                @foreach ($valoraciones_proveedores as $valoracion_proveedor)
                                    <li>{{ $valoracion_proveedor->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a href="{{ route('admin.notificaciones.index') }}" class="text-decoration-none">Ver todas las
                        Notificaciones</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Pacientes</span>
                    <span class="info-box-number">{{ $total_pacientes }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-md icon-fa"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Profesionales</span>
                    <span class="info-box-number">
                        {{ $total_profesionales }}
                    </span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dumbbell icon-fa"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Proveedores</span>
                    <span class="info-box-number">{{ $total_proveedores }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-syringe icon-fa"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Emergencias</span>
                    <span class="info-box-number">{{ $total_emergencias }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Citas</span>
                    <span class="info-box-number">{{ $total_citas }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Citas Canceladas</span>
                    <span class="info-box-number">
                        {{ $total_citas_canceladas }}
                    </span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: orange;color:white;" class="info-box-icon elevation-1"><i
                        class="fas fa-clock"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Citas Pendientes</span>
                    <span class="info-box-number">{{ $total_citas_pendientes }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: aquamarine; color: black;" class="info-box-icon elevation-1"><i
                        class="fa fa-hand-holding-usd"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Ingresos</span>
                    <span class="info-box-number">${{ $total_ingresos }}</span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: deepskyblue; color: black;" class="info-box-icon elevation-1"><i
                        class="fa fa-hand-holding-usd"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Ingresos Profesional</span>
                    <span class="info-box-number">${{ $total_ingresos_profesionales }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: yellow; color: black;" class="info-box-icon elevation-1"><i
                        class="fa fa-hand-holding-usd"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Ingresos Proveedor</span>
                    <span class="info-box-number">${{ $total_ingresos_proveedor }}</span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: burlywood; color: black;" class="info-box-icon elevation-1"><i
                        class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Doc. Pendiente Profesional</span>
                    <span class="info-box-number">{{ $total_documentos_profesional }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span style="background-color: hotpink; color: black;" class="info-box-icon elevation-1"><i
                        class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Doc. Pendiente Proveedor</span>
                    <span class="info-box-number">{{ $total_documentos_proveedor }}</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Evolución de registro de usuarios por tipo y meses</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="usuarios-chart" height="270"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {

            const usuariosPorTipo = @json($usuariosPorTipo);

            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

            const colors = {
                proveedor: '#007bff',
                profesional: '#28a745',
                paciente: '#dc3545'
            };

            const datasets = Object.keys(usuariosPorTipo).map(tipo => {
                return {
                    label: tipo.charAt(0).toUpperCase() + tipo.slice(1),
                    data: usuariosPorTipo[tipo],
                    backgroundColor: 'transparent',
                    borderColor: colors[tipo],
                    pointBorderColor: colors[tipo],
                    pointBackgroundColor: colors[tipo],
                    fill: false,
                    tension: 0.3
                };
            });

            const $chart = $('#usuarios-chart');

            new Chart($chart, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: datasets
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                        legend: {
                            display: true,
                            labels: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

@endsection
