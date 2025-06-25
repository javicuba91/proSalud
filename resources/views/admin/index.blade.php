@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Bienvenidos al Panel de Administración</h1>
@stop

@section('content')
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
                    <span class="info-box-number">{{ $total_ingresos }}</span>
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
