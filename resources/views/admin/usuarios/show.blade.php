@extends('adminlte::page')

@section('title', 'Ver Usuario')

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
            <h5 class="mb-0 d-inline">Detalles del Usuario</h5>
            <a style="font-weight: bold;" href="{{ route('usuarios.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>

        <div class="card-body">
            <!-- Información General del Usuario -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-user mr-2"></i>Información General
                    </h6>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>ID de Usuario:</strong><br>
                    <span class="badge badge-info">{{ $usuario->id }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Nombre Completo:</strong><br>
                    <span>{{ $usuario->name }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Correo Electrónico:</strong><br>
                    <span>{{ $usuario->email }}</span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Rol:</strong><br>
                    @php
                        $roleColors = [
                            'admin' => 'danger',
                            'profesional' => 'primary',
                            'paciente' => 'success',
                            'proveedor' => 'warning',
                        ];
                        $color = $roleColors[$usuario->role] ?? 'secondary';
                    @endphp
                    <span class="p-2 badge badge-{{ $color }}">
                        <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($usuario->role) }}
                    </span>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Estado:</strong><br>
                    @if ($usuario->activo)
                        <span class="badge badge-success p-2">
                            <i class="fas fa-check-circle mr-1"></i>Activo
                        </span>
                    @else
                        <span class="badge badge-danger p-2">
                            <i class="fas fa-times-circle mr-1"></i>Inactivo
                        </span>
                    @endif
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Email Verificado:</strong><br>
                    @if ($usuario->email_verified_at)
                        <span class="badge badge-success p-2">
                            <i class="fas fa-check mr-1"></i>Verificado
                        </span>
                        <br><small class="text-muted">{{ $usuario->email_verified_at->format('d/m/Y H:i:s') }}</small>
                    @else
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>No verificado
                        </span>
                    @endif
                </div>
            </div>

            <!-- Información específica por rol -->
            @if ($usuario->role == 'profesional')
                @if($usuario->profesional)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-success border-bottom pb-2 mb-3">
                                <i class="fas fa-user-md mr-2"></i>Información del Profesional
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Nombre Completo:</strong><br>
                            <span>{{ $usuario->profesional->nombre_completo ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Cédula de Identidad:</strong><br>
                            <span>{{ $usuario->profesional->cedula_identidad ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Email:</strong><br>
                            <span>{{ $usuario->profesional->email ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Fecha de Nacimiento:</strong><br>
                            <span>{{ $usuario->profesional->fecha_nacimiento ? \Carbon\Carbon::parse($usuario->profesional->fecha_nacimiento)->format('d/m/Y') : 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Género:</strong><br>
                            <span>{{ $usuario->profesional->genero ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Teléfono Personal:</strong><br>
                            <span>{{ $usuario->profesional->telefono_personal ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Teléfono Profesional:</strong><br>
                            <span>{{ $usuario->profesional->telefono_profesional ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Licencia Médica:</strong><br>
                            <span>{{ $usuario->profesional->licencia_medica ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Número Colegiado:</strong><br>
                            <span>{{ $usuario->profesional->num_colegiado ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Años de Experiencia:</strong><br>
                            <span>{{ $usuario->profesional->anios_experiencia ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Idiomas:</strong><br>
                            <span>{{ $usuario->profesional->idiomas ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Categoría:</strong><br>
                            @if($usuario->profesional->categoria)
                                <span class="badge badge-primary">{{ $usuario->profesional->categoria->nombre }}</span>
                            @else
                                <span class="text-muted">No especificado</span>
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Número de Cuenta:</strong><br>
                            <span>{{ $usuario->profesional->numero_cuenta ?? 'No especificado' }}</span>
                        </div>

                        @if($usuario->profesional->ciudad)
                        <div class="col-md-4 mb-3">
                            <strong>Ubicación:</strong><br>
                            <span>{{ $usuario->profesional->ciudad->nombre ?? 'No especificado' }}, {{ $usuario->profesional->ciudad->provincia->nombre ?? '' }}</span>
                        </div>
                        @endif

                        <div class="col-md-4 mb-3">
                            <strong>Modalidades:</strong><br>
                            @if($usuario->profesional->presencial)
                                <span class="badge badge-primary mr-1">Presencial</span>
                            @endif
                            @if($usuario->profesional->videoconsulta)
                                <span class="badge badge-info mr-1">Videoconsulta</span>
                            @endif
                            @if(!$usuario->profesional->presencial && !$usuario->profesional->videoconsulta)
                                <span class="text-muted">No especificado</span>
                            @endif
                        </div>

                        @if($usuario->profesional->plan)
                        <div class="col-md-4 mb-3">
                            <strong>Plan Actual:</strong><br>
                            <span class="badge badge-warning">{{ $usuario->profesional->plan->nombre ?? 'Sin plan' }}</span>
                        </div>
                        @endif

                        @if($usuario->profesional->descripcion_profesional)
                        <div class="col-md-12 mb-3">
                            <strong>Descripción Profesional:</strong><br>
                            <p class="border p-3 bg-light">{{ $usuario->profesional->descripcion_profesional }}</p>
                        </div>
                        @endif

                        @if($usuario->profesional->foto)
                        <div class="col-md-6 mb-3">
                            <strong>Foto:</strong><br>
                            <img src="{{ asset($usuario->profesional->foto) }}" alt="Foto del profesional" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        @endif

                        @if($usuario->profesional->logo)
                        <div class="col-md-6 mb-3">
                            <strong>Logo:</strong><br>
                            <img src="{{ asset($usuario->profesional->logo) }}" alt="Logo del profesional" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        @endif

                        @if($usuario->profesional->especializaciones->count() > 0)
                        <div class="col-md-12 mb-3">
                            <strong>Especializaciones:</strong><br>
                            @foreach($usuario->profesional->especializaciones as $especializacion)
                                <span class="badge badge-secondary mr-1 mb-1">
                                    {{ $especializacion->especialidad->nombre ?? 'Sin especialidad' }}
                                    @if($especializacion->subespecialidad)
                                        - {{ $especializacion->subespecialidad->nombre }}
                                    @endif
                                </span>
                            @endforeach
                        </div>
                        @endif

                        @if($usuario->profesional->consultorios->count() > 0)
                        <div class="col-md-12 mb-3">
                            <strong>Consultorios:</strong><br>
                            @foreach($usuario->profesional->consultorios as $consultorio)
                                <div class="alert alert-light mb-2">
                                    <strong>{{ $consultorio->clinica ?? 'Sin nombre' }}</strong><br>
                                    <small>{{ $consultorio->direccion ?? 'Sin dirección' }}</small>
                                </div>
                            @endforeach
                        </div>
                        @endif

                        @if($usuario->profesional->segurosMedicos->count() > 0)
                        <div class="col-md-12 mb-3">
                            <strong>Seguros Médicos Aceptados:</strong><br>
                            @foreach($usuario->profesional->segurosMedicos as $seguro)
                                <span class="badge badge-outline-primary mr-1 mb-1">{{ $seguro->nombre }}</span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Estadísticas del Profesional -->
                        <div class="col-md-12">
                            <h6 class="text-secondary border-bottom pb-2 mb-3 mt-3">
                                <i class="fas fa-chart-bar mr-2"></i>Estadísticas
                            </h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-info">
                                        <span class="info-box-icon"><i class="fas fa-user-friends"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Citas</span>
                                            <span class="info-box-number">{{ $usuario->profesional->citas->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Citas Aceptadas</span>
                                            <span class="info-box-number">{{ $usuario->profesional->citas->where('estado', 'aceptada')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-warning">
                                        <span class="info-box-icon"><i class="fas fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Valoraciones</span>
                                            <span class="info-box-number">{{ $usuario->profesional->valoraciones->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-building"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Consultorios</span>
                                            <span class="info-box-number">{{ $usuario->profesional->consultorios->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Este usuario está marcado como profesional pero no tiene un perfil de profesional asociado.
                                Esto puede indicar que el registro está incompleto.
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($usuario->role == 'paciente')
                @if($usuario->paciente)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-info border-bottom pb-2 mb-3">
                                <i class="fas fa-user-injured mr-2"></i>Información del Paciente
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Nombre Completo:</strong><br>
                            <span>{{ $usuario->paciente->nombre_completo ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Cédula:</strong><br>
                            <span>{{ $usuario->paciente->cedula ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Email:</strong><br>
                            <span>{{ $usuario->paciente->email ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Fecha de Nacimiento:</strong><br>
                            <span>{{ $usuario->paciente->fecha_nacimiento ? \Carbon\Carbon::parse($usuario->paciente->fecha_nacimiento)->format('d/m/Y') : 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Género:</strong><br>
                            <span>{{ $usuario->paciente->genero ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Estado Civil:</strong><br>
                            <span>{{ $usuario->paciente->estado_civil ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Nacionalidad:</strong><br>
                            <span>{{ $usuario->paciente->nacionalidad ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Celular:</strong><br>
                            <span>{{ $usuario->paciente->celular ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Grupo Sanguíneo:</strong><br>
                            <span>{{ $usuario->paciente->grupo_sanguineo ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Dirección:</strong><br>
                            <span>{{ $usuario->paciente->direccion ?? 'No especificado' }}</span>
                        </div>

                        @if($usuario->paciente->foto)
                        <div class="col-md-12 mb-3">
                            <strong>Foto:</strong><br>
                            <img src="{{ asset($usuario->paciente->foto) }}" alt="Foto del paciente" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        @endif

                        <!-- Estadísticas del Paciente -->
                        <div class="col-md-12">
                            <h6 class="text-secondary border-bottom pb-2 mb-3 mt-3">
                                <i class="fas fa-chart-bar mr-2"></i>Estadísticas
                            </h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-box bg-info">
                                        <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Citas</span>
                                            <span class="info-box-number">{{ $usuario->paciente->citas->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon"><i class="fas fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Valoraciones Dadas</span>
                                            <span class="info-box-number">{{ $usuario->paciente->valoraciones->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box bg-warning">
                                        <span class="info-box-icon"><i class="fas fa-shield-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Seguros Activos</span>
                                            <span class="info-box-number">{{ $usuario->paciente->segurosMedicos->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Este usuario está marcado como paciente pero no tiene un perfil de paciente asociado.
                                Esto puede indicar que el registro está incompleto.
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($usuario->role == 'proveedor')
                @if($usuario->proveedor)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-warning border-bottom pb-2 mb-3">
                                <i class="fas fa-building mr-2"></i>Información del Proveedor
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Tipo de Proveedor:</strong><br>
                            @php
                                $tipoLabels = [
                                    'farmacia' => 'Farmacia',
                                    'laboratorio' => 'Laboratorio',
                                    'centro_imagenes' => 'Centro de Imágenes'
                                ];
                            @endphp
                            <span class="badge badge-warning">{{ $tipoLabels[$usuario->proveedor->tipo] ?? ucfirst($usuario->proveedor->tipo ?? 'No especificado') }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Nombre del Negocio:</strong><br>
                            <span>{{ $usuario->proveedor->nombre ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Número de Identificación:</strong><br>
                            <span>{{ $usuario->proveedor->numero_identificacion ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Email:</strong><br>
                            <span>{{ $usuario->proveedor->email ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Ciudad:</strong><br>
                            <span>{{ $usuario->proveedor->ciudad ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Teléfono:</strong><br>
                            <span>{{ $usuario->proveedor->telefono ?? 'No especificado' }}</span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Dirección:</strong><br>
                            <span>{{ $usuario->proveedor->direccion ?? 'No especificado' }}</span>
                        </div>

                        <!-- Información adicional del Proveedor -->
                        <div class="col-md-12">
                            <h6 class="text-secondary border-bottom pb-2 mb-3 mt-3">
                                <i class="fas fa-info-circle mr-2"></i>Estado del Proveedor
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-box bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-calendar-plus"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Fecha de Registro</span>
                                            <span class="info-box-number text-sm">{{ $usuario->proveedor->created_at ? $usuario->proveedor->created_at->format('d/m/Y') : 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Estado de Verificación</span>
                                            <span class="info-box-number text-sm">Pendiente</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Este usuario está marcado como proveedor pero no tiene un perfil de proveedor asociado.
                                Esto puede indicar que el registro está incompleto.
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($usuario->role == 'admin')
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-danger border-bottom pb-2 mb-3">
                            <i class="fas fa-user-shield mr-2"></i>Información del Administrador
                        </h6>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Este usuario tiene permisos de administrador del sistema.
                        </div>
                    </div>
                </div>
            @endif

            <!-- Acciones disponibles -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h6 class="text-secondary border-bottom pb-2 mb-3">
                        <i class="fas fa-cogs mr-2"></i>Acciones Disponibles
                    </h6>
                </div>
                <div class="col-md-12">
                    <div class="btn-group" role="group">
                        @php
                            $editRoute = match($usuario->role) {
                                'paciente' => route('pacientes.edit', $usuario->id),
                                'profesional' => route('profesionales.edit', $usuario->id),
                                'proveedor' => route('proveedores.edit', $usuario->id),
                                'admin' => route('administradores.edit', $usuario->id),
                                default => route('usuarios.edit', $usuario->id)
                            };
                        @endphp
                        <a href="{{ $editRoute }}" class="btn btn-primary">
                            <i class="fas fa-edit mr-1"></i>Editar Usuario
                        </a>

                        @if ($usuario->activo)
                            <button type="button" class="btn btn-warning">
                                <i class="fas fa-user-times mr-1"></i>Desactivar
                            </button>
                        @else
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-user-check mr-1"></i>Activar
                            </button>
                        @endif

                        @if (!$usuario->email_verified_at)
                            <button type="button" class="btn btn-info">
                                <i class="fas fa-envelope mr-1"></i>Reenviar Verificación
                            </button>
                        @endif

                        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion()">
                            <i class="fas fa-trash mr-1"></i>Eliminar Usuario
                        </button>
                    </div>
                </div>
            </div>
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
                    <strong>Fecha de Registro:</strong>
                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i:s') : 'No disponible' }}
                </div>
                <div class="col-md-6">
                    <strong>Última actualización:</strong>
                    {{ $usuario->updated_at ? $usuario->updated_at->format('d/m/Y H:i:s') : 'No disponible' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario oculto para eliminación -->
    <form id="delete-form" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('css')
    <style>
        .badge-outline-primary {
            color: #007bff;
            border: 1px solid #007bff;
            background-color: transparent;
        }
        .badge-outline-info {
            color: #17a2b8;
            border: 1px solid #17a2b8;
            background-color: transparent;
        }
        .img-thumbnail {
            border-radius: 8px;
        }
        .alert-light {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .info-box {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info-box-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-right: 15px;
            border-radius: 50%;
        }
        .info-box-content {
            color: white;
        }
        .info-box-text {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .info-box-number {
            display: block;
            font-size: 24px;
            font-weight: bold;
        }
        .info-box.bg-info { background-color: #17a2b8; }
        .info-box.bg-success { background-color: #28a745; }
        .info-box.bg-warning { background-color: #ffc107; color: #212529; }
        .info-box.bg-warning .info-box-content { color: #212529; }
        .info-box.bg-warning .info-box-icon { color: #212529; }
        .info-box.bg-primary { background-color: #007bff; }
    </style>
@stop

@section('js')
    <script>
        function confirmarEliminacion() {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@stop
