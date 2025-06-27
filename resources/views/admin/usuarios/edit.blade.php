@extends('adminlte::page')

@section('title', 'Editar Usuario')

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
            <h5 class="mb-0 d-inline">
                <i class="fas fa-user-edit mr-2"></i>Editar Usuario
            </h5>
            <a style="font-weight: bold;" href="{{ route('usuarios.show', $usuario->id) }}" class="float-right text-white">
                <i class="fa fa-arrow-left"></i> Volver a detalles
            </a>
        </div>

        <div class="card-body">
            @php
                $updateRoute = match($usuario->role) {
                    'paciente' => route('pacientes.update', $usuario->id),
                    'profesional' => route('profesionales.update', $usuario->id),
                    'proveedor' => route('proveedores.update', $usuario->id),
                    'admin' => route('administradores.update', $usuario->id),
                    default => route('usuarios.update', $usuario->id)
                };
            @endphp
            <form method="POST" action="{{ $updateRoute }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Información General del Usuario -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-primary border-bottom pb-2 mb-3">
                            <i class="fas fa-user mr-2"></i>Información General
                        </h6>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label"><strong>Nombre Completo:</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label"><strong>Correo Electrónico:</strong></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="role" class="form-label"><strong>Rol:</strong></label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required onchange="toggleRoleFields()">
                            <option value="paciente" {{ old('role', $usuario->role) == 'paciente' ? 'selected' : '' }}>Paciente</option>
                            <option value="profesional" {{ old('role', $usuario->role) == 'profesional' ? 'selected' : '' }}>Profesional</option>
                            <option value="proveedor" {{ old('role', $usuario->role) == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                            <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1"
                                   {{ old('activo', $usuario->activo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">
                                <strong>Usuario Activo</strong>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="email_verified" name="email_verified" value="1"
                                   {{ old('email_verified', $usuario->email_verified_at ? 1 : 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="email_verified">
                                <strong>Email Verificado</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Información específica del Paciente -->
                <div id="paciente-fields" class="role-fields" style="display: {{ $usuario->role == 'paciente' ? 'block' : 'none' }};">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-info border-bottom pb-2 mb-3">
                                <i class="fas fa-user-injured mr-2"></i>Información del Paciente
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_nombre_completo" class="form-label">Nombre Completo:</label>
                            <input type="text" class="form-control @error('paciente_nombre_completo') is-invalid @enderror"
                                   id="paciente_nombre_completo" name="paciente_nombre_completo"
                                   value="{{ old('paciente_nombre_completo', $usuario->paciente->nombre_completo ?? '') }}">
                            @error('paciente_nombre_completo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_cedula" class="form-label">Cédula:</label>
                            <input type="text" class="form-control @error('paciente_cedula') is-invalid @enderror"
                                   id="paciente_cedula" name="paciente_cedula"
                                   value="{{ old('paciente_cedula', $usuario->paciente->cedula ?? '') }}">
                            @error('paciente_cedula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control @error('paciente_fecha_nacimiento') is-invalid @enderror"
                                   id="paciente_fecha_nacimiento" name="paciente_fecha_nacimiento"
                                   value="{{ old('paciente_fecha_nacimiento', $usuario->paciente->fecha_nacimiento ?? '') }}">
                            @error('paciente_fecha_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_genero" class="form-label">Género:</label>
                            <select class="form-control @error('paciente_genero') is-invalid @enderror"
                                    id="paciente_genero" name="paciente_genero">
                                <option value="">Seleccionar...</option>
                                <option value="masculino" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="otro" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('paciente_genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_estado_civil" class="form-label">Estado Civil:</label>
                            <select class="form-control @error('paciente_estado_civil') is-invalid @enderror"
                                    id="paciente_estado_civil" name="paciente_estado_civil">
                                <option value="">Seleccionar...</option>
                                <option value="soltero" {{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') == 'soltero' ? 'selected' : '' }}>Soltero</option>
                                <option value="casado" {{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') == 'casado' ? 'selected' : '' }}>Casado</option>
                                <option value="divorciado" {{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                                <option value="viudo" {{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') == 'viudo' ? 'selected' : '' }}>Viudo</option>
                                <option value="union_libre" {{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') == 'union_libre' ? 'selected' : '' }}>Unión Libre</option>
                            </select>
                            @error('paciente_estado_civil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_nacionalidad" class="form-label">Nacionalidad:</label>
                            <input type="text" class="form-control @error('paciente_nacionalidad') is-invalid @enderror"
                                   id="paciente_nacionalidad" name="paciente_nacionalidad"
                                   value="{{ old('paciente_nacionalidad', $usuario->paciente->nacionalidad ?? '') }}">
                            @error('paciente_nacionalidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_celular" class="form-label">Celular:</label>
                            <input type="text" class="form-control @error('paciente_celular') is-invalid @enderror"
                                   id="paciente_celular" name="paciente_celular"
                                   value="{{ old('paciente_celular', $usuario->paciente->celular ?? '') }}">
                            @error('paciente_celular')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_grupo_sanguineo" class="form-label">Grupo Sanguíneo:</label>
                            <select class="form-control @error('paciente_grupo_sanguineo') is-invalid @enderror"
                                    id="paciente_grupo_sanguineo" name="paciente_grupo_sanguineo">
                                <option value="">Seleccionar...</option>
                                <option value="A+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                            @error('paciente_grupo_sanguineo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="paciente_direccion" class="form-label">Dirección:</label>
                            <textarea class="form-control @error('paciente_direccion') is-invalid @enderror"
                                      id="paciente_direccion" name="paciente_direccion" rows="3">{{ old('paciente_direccion', $usuario->paciente->direccion ?? '') }}</textarea>
                            @error('paciente_direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Información específica del Profesional -->
                <div id="profesional-fields" class="role-fields" style="display: {{ $usuario->role == 'profesional' ? 'block' : 'none' }};">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-success border-bottom pb-2 mb-3">
                                <i class="fas fa-user-md mr-2"></i>Información del Profesional
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_nombre_completo" class="form-label">Nombre Completo:</label>
                            <input type="text" class="form-control @error('profesional_nombre_completo') is-invalid @enderror"
                                   id="profesional_nombre_completo" name="profesional_nombre_completo"
                                   value="{{ old('profesional_nombre_completo', $usuario->profesional->nombre_completo ?? '') }}">
                            @error('profesional_nombre_completo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_cedula_identidad" class="form-label">Cédula de Identidad:</label>
                            <input type="text" class="form-control @error('profesional_cedula_identidad') is-invalid @enderror"
                                   id="profesional_cedula_identidad" name="profesional_cedula_identidad"
                                   value="{{ old('profesional_cedula_identidad', $usuario->profesional->cedula_identidad ?? '') }}">
                            @error('profesional_cedula_identidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_telefono_personal" class="form-label">Teléfono Personal:</label>
                            <input type="text" class="form-control @error('profesional_telefono_personal') is-invalid @enderror"
                                   id="profesional_telefono_personal" name="profesional_telefono_personal"
                                   value="{{ old('profesional_telefono_personal', $usuario->profesional->telefono_personal ?? '') }}">
                            @error('profesional_telefono_personal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="profesional_presencial"
                                       name="profesional_presencial" value="1"
                                       {{ old('profesional_presencial', $usuario->profesional->presencial ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="profesional_presencial">
                                    Modalidad Presencial
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="profesional_videoconsulta"
                                       name="profesional_videoconsulta" value="1"
                                       {{ old('profesional_videoconsulta', $usuario->profesional->videoconsulta ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="profesional_videoconsulta">
                                    Videoconsulta
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información específica del Proveedor -->
                <div id="proveedor-fields" class="role-fields" style="display: {{ $usuario->role == 'proveedor' ? 'block' : 'none' }};">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-warning border-bottom pb-2 mb-3">
                                <i class="fas fa-building mr-2"></i>Información del Proveedor
                            </h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_tipo" class="form-label">Tipo de Proveedor:</label>
                            <select class="form-control @error('proveedor_tipo') is-invalid @enderror"
                                    id="proveedor_tipo" name="proveedor_tipo">
                                <option value="">Seleccionar...</option>
                                <option value="clinica" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'clinica' ? 'selected' : '' }}>Clínica</option>
                                <option value="laboratorio" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                                <option value="farmacia" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'farmacia' ? 'selected' : '' }}>Farmacia</option>
                                <option value="otros" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'otros' ? 'selected' : '' }}>Otros</option>
                            </select>
                            @error('proveedor_tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_nombre" class="form-label">Nombre del Negocio:</label>
                            <input type="text" class="form-control @error('proveedor_nombre') is-invalid @enderror"
                                   id="proveedor_nombre" name="proveedor_nombre"
                                   value="{{ old('proveedor_nombre', $usuario->proveedor->nombre ?? '') }}">
                            @error('proveedor_nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_numero_identificacion" class="form-label">Número de Identificación:</label>
                            <input type="text" class="form-control @error('proveedor_numero_identificacion') is-invalid @enderror"
                                   id="proveedor_numero_identificacion" name="proveedor_numero_identificacion"
                                   value="{{ old('proveedor_numero_identificacion', $usuario->proveedor->numero_identificacion ?? '') }}">
                            @error('proveedor_numero_identificacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_ciudad" class="form-label">Ciudad:</label>
                            <input type="text" class="form-control @error('proveedor_ciudad') is-invalid @enderror"
                                   id="proveedor_ciudad" name="proveedor_ciudad"
                                   value="{{ old('proveedor_ciudad', $usuario->proveedor->ciudad ?? '') }}">
                            @error('proveedor_ciudad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control @error('proveedor_telefono') is-invalid @enderror"
                                   id="proveedor_telefono" name="proveedor_telefono"
                                   value="{{ old('proveedor_telefono', $usuario->proveedor->telefono ?? '') }}">
                            @error('proveedor_telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_email" class="form-label">Email de Contacto:</label>
                            <input type="email" class="form-control @error('proveedor_email') is-invalid @enderror"
                                   id="proveedor_email" name="proveedor_email"
                                   value="{{ old('proveedor_email', $usuario->proveedor->email ?? '') }}">
                            @error('proveedor_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="proveedor_direccion" class="form-label">Dirección:</label>
                            <textarea class="form-control @error('proveedor_direccion') is-invalid @enderror"
                                      id="proveedor_direccion" name="proveedor_direccion" rows="3">{{ old('proveedor_direccion', $usuario->proveedor->direccion ?? '') }}</textarea>
                            @error('proveedor_direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Información específica del Admin -->
                <div id="admin-fields" class="role-fields" style="display: {{ $usuario->role == 'admin' ? 'block' : 'none' }};">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-danger border-bottom pb-2 mb-3">
                                <i class="fas fa-user-shield mr-2"></i>Información del Administrador
                            </h6>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Este usuario tiene permisos de administrador del sistema. No requiere información adicional específica.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg mr-3">
                            <i class="fas fa-save mr-2"></i>Guardar Cambios
                        </button>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .role-fields {
            transition: all 0.3s ease;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-group .btn {
            margin-right: 10px;
        }
        .card-header h5 {
            margin: 0;
        }
        .border-bottom {
            border-bottom: 2px solid #dee2e6 !important;
        }
        .text-primary { color: #007bff !important; }
        .text-success { color: #28a745 !important; }
        .text-info { color: #17a2b8 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-danger { color: #dc3545 !important; }
    </style>
@stop

@section('js')
    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const roleFields = document.querySelectorAll('.role-fields');

            // Ocultar todos los campos específicos de rol
            roleFields.forEach(field => {
                field.style.display = 'none';
            });

            // Mostrar solo los campos del rol seleccionado
            if (role) {
                const targetField = document.getElementById(role + '-fields');
                if (targetField) {
                    targetField.style.display = 'block';
                }
            }
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            toggleRoleFields();
        });
    </script>
@stop
