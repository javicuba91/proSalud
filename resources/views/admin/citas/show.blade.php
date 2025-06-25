@extends('adminlte::page')

@section('title', 'Ver Cita')

@section('content')
    <!-- Mensajes de éxito/error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm rounded-3 mt-4">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Editar Informe</h5>
            <a style="font-weight: bold;" href="{{ route('informes.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>

        <div class="card-body">
            <!-- Información General de la Cita -->
            <div class="row">
                <div class="col-lg-3">
                    @if ($cita->codigo_qr)
                        <div class="col-md-12 text-left mb-3">
                            {{-- Mostrar el QR --}}
                            {!! QrCode::size(150)->generate($cita->codigo_qr) !!}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2 mb-3"><i class="fas fa-calendar-alt mr-2"></i>Información
                        General</h6>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>ID de Cita:</strong><br>
                    <span class="badge badge-info">{{ $cita->id }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Código QR:</strong><br>
                    <span class="badge badge-secondary">{{ $cita->codigo_qr }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Fecha y Hora:</strong><br>
                    <span>{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y H:i') }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Estado:</strong><br>
                    @php
                        $estadoColors = [
                            'pendiente' => 'warning',
                            'aceptada' => 'info',
                            'cancelada' => 'danger',
                            'completada' => 'success',
                            'noacude' => 'secondary',
                        ];
                        $color = $estadoColors[$cita->estado] ?? 'secondary';
                    @endphp
                    <span class="p-2 badge badge-{{ $color }}">{{ ucfirst($cita->estado) }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Modalidad:</strong><br>
                    @if ($cita->modalidad == 'presencial')
                        <span class="badge badge-primary p-2"><i
                                class="fas fa-hospital mr-1"></i>{{ ucfirst($cita->modalidad) }}</span>
                    @else
                        <span class="badge badge-success p-2"><i
                                class="fas fa-video mr-1"></i>{{ ucfirst($cita->modalidad) }}</span>
                    @endif
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Recordatorio Enviado:</strong><br>
                    @if ($cita->recordatorio_enviado)
                        <span class="badge badge-success p-2"><i class="fas fa-check mr-1"></i>Sí</span>
                    @else
                        <span class="badge badge-warning p-2"><i class="fas fa-times mr-1"></i>No</span>
                    @endif
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Informe Creado:</strong><br>
                    @if ($cita->informe_creado)
                        <span class="badge badge-success p-2"><i class="fas fa-check mr-1"></i>Sí</span>
                    @else
                        <span class="badge badge-warning p-2"><i class="fas fa-times mr-1"></i>No</span>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <strong>Motivo de la Consulta:</strong><br>
                    <div class="border rounded p-2 bg-light">
                        {{ $cita->motivo }}
                    </div>
                </div>
            </div>

            <!-- Información del Profesional -->
            <div class="border rounded p-3 bg-light mb-3">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img img-fluid img-responsive img-thumbnail" src="{{ asset($cita->paciente->foto) }}"
                            alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <strong>Nombre paciente:</strong><br>
                                <span>{{ $cita->paciente->nombre_completo }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Fecha de nacimiento:</strong><br>
                                <span>{{ \Carbon\Carbon::parse($cita->paciente->fecha_nacimiento)->format('d-m-Y') }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Género:</strong><br>
                                <span>{{ $cita->paciente->genero }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Estado civil:</strong><br>
                                <span>{{ $cita->paciente->estado_civil }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <strong>Nacionalidad:</strong><br>
                                <span>{{ $cita->paciente->nacionalidad }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Teléfono:</strong><br>
                                <span>{{ $cita->paciente->celular }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Email:</strong><br>
                                <span>{{ $cita->paciente->email }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Dirección de residencia:</strong>
                                <span>{{ $cita->paciente->direccion }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border rounded p-3 bg-light mb-3">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img img-fluid img-responsive img-thumbnail" src="{{ asset($cita->profesional->foto) }}"
                            alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <strong>Nombre profesional:</strong><br>
                                <span>{{ $cita->profesional->nombre_completo }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Fecha de nacimiento:</strong><br>
                                <span>{{ \Carbon\Carbon::parse($cita->profesional->fecha_nacimiento)->format('d-m-Y') }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Género:</strong><br>
                                <span>{{ $cita->profesional->genero }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Teléfono Personal:</strong><br>
                                <span>{{ $cita->profesional->telefono_personal }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <strong>Teléfono Profesional:</strong><br>
                                <span>{{ $cita->profesional->telefono_profesional }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Email:</strong><br>
                                <span>{{ $cita->profesional->email }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Idiomas:</strong><br>
                                <span>{{ $cita->profesional->idiomas }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Plan:</strong><br>
                                <span>{{ $cita->profesional->plan->nombre }}
                                    ({{ $cita->profesional->plan->precio }}€)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Número de colegiado:</strong> <br>
                                <span>{{ $cita->profesional->num_colegiado }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Categoría:</strong> <br>
                                <span>{{ $cita->profesional->categoria->nombre }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Provincia:</strong> <br>
                                <span>{{ $cita->profesional->ciudad->provincia->nombre }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Ciudad:</strong> <br>
                                <span>{{ $cita->profesional->ciudad->nombre }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Especialización -->
            @if ($cita->especializacion)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-warning border-bottom pb-2 mb-3"><i
                                class="fas fa-stethoscope mr-2"></i>Especialización</h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Especialidad:</strong><br>
                        <span>{{ $cita->especializacion->especialidad->nombre ?? 'No disponible' }}</span>
                    </div>
                    @if ($cita->especializacion->subespecialidad)
                        <div class="col-md-6 mb-3">
                            <strong>Subespecialidad:</strong><br>
                            <span>{{ $cita->especializacion->subespecialidad->nombre }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Información del Consultorio (solo para citas presenciales) -->
            @if ($cita->modalidad == 'presencial' && $cita->consultorio)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-secondary border-bottom pb-2 mb-3"><i class="fas fa-hospital mr-2"></i>Información
                            del Consultorio</h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Dirección:</strong><br>
                        <span>{{ $cita->consultorio->direccion ?? 'No disponible' }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Clínica/Centro:</strong><br>
                        <span>{{ $cita->consultorio->clinica ?? 'No disponible' }}</span>
                    </div>
                </div>
            @endif

            <!-- URL de Videoconsulta (solo para videoconsultas) -->
            @if ($cita->modalidad == 'videoconsulta' && $cita->url_meet)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-success border-bottom pb-2 mb-3"><i class="fas fa-video mr-2"></i>Videoconsulta
                        </h6>
                    </div>
                    <div class="col-md-12 mb-3">
                        <strong>URL de la Reunión:</strong><br>
                        <a href="{{ $cita->url_meet }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-external-link-alt mr-1"></i>
                            Abrir Videoconsulta
                        </a>
                        <br><small class="text-muted">{{ $cita->url_meet }}</small>
                    </div>
                </div>
            @endif

            <!-- Información Adicional -->
            @if ($cita->informeConsulta || $cita->detalleCita)
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-dark border-bottom pb-2 mb-3"><i class="fas fa-clipboard mr-2"></i>Documentos
                            Relacionados</h6>
                    </div>

                    @if ($cita->informeConsulta)
                        <div class="col-md-12">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6 class="card-title text-success">
                                                <i class="fas fa-file-medical mr-2"></i>Informe de Consulta
                                            </h6>
                                            <p class="card-text">Informe médico disponible</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ route('informes.show', $cita->informeConsulta->id) }}"
                                                class="btn btn-success btn-sm float-right float-end">
                                                <i class="fas fa-eye mr-1"></i>Ver Informe
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($cita->detalleCita)
                        <div class="col-md-6 mb-1">
                            <div class="card border-info">
                                <div class="card-body">
                                    <h6 class="card-title text-info">
                                        <i class="fas fa-info-circle mr-2"></i>Detalle de Cita
                                    </h6>
                                    <p class="card-text">Información detallada disponible</p>
                                    <button class="btn btn-info btn-sm" disabled>
                                        <i class="fas fa-eye mr-1"></i>Ver Detalle
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>

    <!-- Información de Timestamps -->
    <div class="card mt-3">
        <div class="card-header bg-light">
            <h6 class="mb-0"><i class="fas fa-clock mr-2"></i>Información de Registro</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Creado:</strong>
                    {{ $cita->created_at ? $cita->created_at->format('d/m/Y H:i:s') : 'No disponible' }}
                </div>
                <div class="col-md-6">
                    <strong>Última actualización:</strong>
                    {{ $cita->updated_at ? $cita->updated_at->format('d/m/Y H:i:s') : 'No disponible' }}
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
