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
            <a style="font-weight: bold;" href="{{ route('usuarios.index', $usuario->id) }}" class="float-right text-white">
                <i class="fa fa-arrow-left"></i> Volver al listado
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
                               id="name" name="name" value="{{ old('name', $usuario->name) }}  "
                               data-label="Nombre Completo" disabled readonly>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label"><strong>Correo Electrónico:</strong></label>
                        <input type="email" class="form-control"
                               id="email" name="email" value="{{ $usuario->email }}" disabled readonly>
                        <small class="form-text text-muted">El correo electrónico no puede ser modificado</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="role" class="form-label"><strong>Rol:</strong></label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                                data-label="Rol" required onchange="toggleRoleFields()">
                            <option value="paciente" {{ old('role', $usuario->role) == 'paciente' ? 'selected' : '' }}>Paciente</option>
                            <option value="profesional" {{ old('role', $usuario->role) == 'profesional' ? 'selected' : '' }}>Profesional</option>
                            <option value="proveedor" {{ old('role', $usuario->role) == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                            <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1"
                                   {{ old('activo', $usuario->activo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">
                                <strong>Usuario Activo</strong>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3 ">
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
                            <label for="paciente_nombre_completo" class="form-label">Nombre Completo: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('paciente_nombre_completo') is-invalid @enderror"
                                   id="paciente_nombre_completo" name="paciente_nombre_completo"
                                   value="{{ old('paciente_nombre_completo', $usuario->paciente->nombre_completo ?? '') }}"
                                   data-label="Nombre Completo del Paciente" required>
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
                            <label for="paciente_email" class="form-label">Email:</label>
                            <input type="email" class="form-control"
                                   id="paciente_email" name="paciente_email"
                                   value="{{ $usuario->paciente->email ?? '' }}" disabled readonly>
                            <small class="form-text text-muted">El email no puede ser modificado</small>
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
                                <option value="Masculino" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('paciente_genero', $usuario->paciente->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('paciente_genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paciente_estado_civil" class="form-label">Estado Civil:</label>
                            <input type="text" class="form-control @error('paciente_estado_civil') is-invalid @enderror"
                                   id="paciente_estado_civil" name="paciente_estado_civil"
                                   value="{{ old('paciente_estado_civil', $usuario->paciente->estado_civil ?? '') }}">
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
                                <option value="AB+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('paciente_grupo_sanguineo', $usuario->paciente->grupo_sanguineo ?? '') == 'O-' ? 'selected' : '' }}>O-</option>
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

                        <div class="col-md-6 mb-3">
                            <label for="paciente_foto" class="form-label">Foto:</label>
                            <input type="file" class="form-control-file @error('paciente_foto') is-invalid @enderror"
                                   id="paciente_foto" name="paciente_foto" accept="image/*">
                            @if($usuario->paciente && $usuario->paciente->foto)
                                <small class="form-text text-muted">Foto actual: {{ basename($usuario->paciente->foto) }}</small>
                            @endif
                            @error('paciente_foto')
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
                            <label for="profesional_email" class="form-label">Email:</label>
                            <input type="email" class="form-control"
                                   id="profesional_email" name="profesional_email"
                                   value="{{ $usuario->profesional->email ?? '' }}" disabled readonly>
                            <small class="form-text text-muted">El email no puede ser modificado</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control @error('profesional_fecha_nacimiento') is-invalid @enderror"
                                   id="profesional_fecha_nacimiento" name="profesional_fecha_nacimiento"
                                   value="{{ old('profesional_fecha_nacimiento', $usuario->profesional->fecha_nacimiento ?? '') }}">
                            @error('profesional_fecha_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_genero" class="form-label">Género:</label>
                            <select class="form-control @error('profesional_genero') is-invalid @enderror"
                                    id="profesional_genero" name="profesional_genero">
                                <option value="">Seleccionar...</option>
                                <option value="Hombre" {{ old('profesional_genero', $usuario->profesional->genero ?? '') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                <option value="Mujer" {{ old('profesional_genero', $usuario->profesional->genero ?? '') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                                <option value="Otro" {{ old('profesional_genero', $usuario->profesional->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('profesional_genero')
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

                        <div class="col-md-4 mb-3">
                            <label for="profesional_telefono_profesional" class="form-label">Teléfono Profesional:</label>
                            <input type="text" class="form-control @error('profesional_telefono_profesional') is-invalid @enderror"
                                   id="profesional_telefono_profesional" name="profesional_telefono_profesional"
                                   value="{{ old('profesional_telefono_profesional', $usuario->profesional->telefono_profesional ?? '') }}">
                            @error('profesional_telefono_profesional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_licencia_medica" class="form-label">Licencia Médica:</label>
                            <input type="text" class="form-control @error('profesional_licencia_medica') is-invalid @enderror"
                                   id="profesional_licencia_medica" name="profesional_licencia_medica"
                                   value="{{ old('profesional_licencia_medica', $usuario->profesional->licencia_medica ?? '') }}">
                            @error('profesional_licencia_medica')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_num_colegiado" class="form-label">Número Colegiado:</label>
                            <input type="text" class="form-control @error('profesional_num_colegiado') is-invalid @enderror"
                                   id="profesional_num_colegiado" name="profesional_num_colegiado"
                                   value="{{ old('profesional_num_colegiado', $usuario->profesional->num_colegiado ?? '') }}">
                            @error('profesional_num_colegiado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="profesional_anios_experiencia" class="form-label">Años de Experiencia:</label>
                            <input type="number" class="form-control @error('profesional_anios_experiencia') is-invalid @enderror"
                                   id="profesional_anios_experiencia" name="profesional_anios_experiencia"
                                   value="{{ old('profesional_anios_experiencia', $usuario->profesional->anios_experiencia ?? '') }}">
                            @error('profesional_anios_experiencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profesional_idiomas" class="form-label">Idiomas:</label>
                            <input type="text" class="form-control @error('profesional_idiomas') is-invalid @enderror"
                                   id="profesional_idiomas" name="profesional_idiomas"
                                   value="{{ old('profesional_idiomas', $usuario->profesional->idiomas ?? '') }}">
                            @error('profesional_idiomas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profesional_numero_cuenta" class="form-label">Número de Cuenta:</label>
                            <input type="text" class="form-control @error('profesional_numero_cuenta') is-invalid @enderror"
                                   id="profesional_numero_cuenta" name="profesional_numero_cuenta"
                                   value="{{ old('profesional_numero_cuenta', $usuario->profesional->numero_cuenta ?? '') }}">
                            @error('profesional_numero_cuenta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="profesional_descripcion_profesional" class="form-label">Descripción Profesional:</label>
                            <textarea class="form-control @error('profesional_descripcion_profesional') is-invalid @enderror"
                                      id="profesional_descripcion_profesional" name="profesional_descripcion_profesional" rows="4">{{ old('profesional_descripcion_profesional', $usuario->profesional->descripcion_profesional ?? '') }}</textarea>
                            @error('profesional_descripcion_profesional')
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

                        <div class="col-md-6 mb-3">
                            <label for="profesional_foto" class="form-label">Foto:</label>
                            <input type="file" class="form-control-file @error('profesional_foto') is-invalid @enderror"
                                   id="profesional_foto" name="profesional_foto" accept="image/*">
                            @if($usuario->profesional && $usuario->profesional->foto)
                                <small class="form-text text-muted">Foto actual: {{ basename($usuario->profesional->foto) }}</small>
                            @endif
                            @error('profesional_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profesional_logo" class="form-label">Logo:</label>
                            <input type="file" class="form-control-file @error('profesional_logo') is-invalid @enderror"
                                   id="profesional_logo" name="profesional_logo" accept="image/*">
                            @if($usuario->profesional && $usuario->profesional->logo)
                                <small class="form-text text-muted">Logo actual: {{ basename($usuario->profesional->logo) }}</small>
                            @endif
                            @error('profesional_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                    id="proveedor_tipo" name="proveedor_tipo" required>
                                <option value="">Seleccionar...</option>
                                <option value="farmacia" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'farmacia' ? 'selected' : '' }}>Farmacia</option>
                                <option value="laboratorio" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                                <option value="centro_imagenes" {{ old('proveedor_tipo', $usuario->proveedor->tipo ?? '') == 'centro_imagenes' ? 'selected' : '' }}>Centro de Imágenes</option>
                            </select>
                            @error('proveedor_tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_nombre" class="form-label">Nombre del Negocio:</label>
                            <input type="text" class="form-control @error('proveedor_nombre') is-invalid @enderror"
                                   id="proveedor_nombre" name="proveedor_nombre"
                                   value="{{ old('proveedor_nombre', $usuario->proveedor->nombre ?? '') }}" required>
                            @error('proveedor_nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_numero_identificacion" class="form-label">Número de Identificación:</label>
                            <input type="text" class="form-control @error('proveedor_numero_identificacion') is-invalid @enderror"
                                   id="proveedor_numero_identificacion" name="proveedor_numero_identificacion"
                                   value="{{ old('proveedor_numero_identificacion', $usuario->proveedor->numero_identificacion ?? '') }}" required>
                            @error('proveedor_numero_identificacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_email" class="form-label">Email:</label>
                            <input type="email" class="form-control"
                                   id="proveedor_email" name="proveedor_email"
                                   value="{{ $usuario->proveedor->email ?? '' }}" disabled readonly>
                            <small class="form-text text-muted">El email no puede ser modificado</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_ciudad" class="form-label">Ciudad:</label>
                            <input type="text" class="form-control @error('proveedor_ciudad') is-invalid @enderror"
                                   id="proveedor_ciudad" name="proveedor_ciudad"
                                   value="{{ old('proveedor_ciudad', $usuario->proveedor->ciudad ?? '') }}" required>
                            @error('proveedor_ciudad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="proveedor_telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control @error('proveedor_telefono') is-invalid @enderror"
                                   id="proveedor_telefono" name="proveedor_telefono"
                                   value="{{ old('proveedor_telefono', $usuario->proveedor->telefono ?? '') }}" required>
                            @error('proveedor_telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="proveedor_direccion" class="form-label">Dirección:</label>
                            <textarea class="form-control @error('proveedor_direccion') is-invalid @enderror"
                                      id="proveedor_direccion" name="proveedor_direccion" rows="3" required>{{ old('proveedor_direccion', $usuario->proveedor->direccion ?? '') }}</textarea>
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
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('usuarios.index', $usuario->id) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
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

        /* Estilos mejorados para campos con error */
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Animación para el botón de envío */
        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
    </style>
@endsection

@section('js')
    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const roleFields = document.querySelectorAll('.role-fields');

            // Ocultar todos los campos específicos de rol
            roleFields.forEach(field => {
                field.style.display = 'none';
                // Deshabilitar campos requeridos en secciones ocultas
                const requiredFields = field.querySelectorAll('[required]');
                requiredFields.forEach(reqField => {
                    reqField.disabled = true;
                });
            });

            // Mostrar solo los campos del rol seleccionado
            if (role) {
                const targetField = document.getElementById(role + '-fields');
                if (targetField) {
                    targetField.style.display = 'block';
                    // Habilitar campos requeridos en la sección visible
                    const requiredFields = targetField.querySelectorAll('[required]');
                    requiredFields.forEach(reqField => {
                        reqField.disabled = false;
                    });
                }
            }
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            toggleRoleFields();

            // Agregar listener al formulario
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Formulario enviado');
                    console.log('Action:', form.action);
                    console.log('Method:', form.method);

                    // Antes de enviar, habilitar temporalmente todos los campos para que se envíen
                    const allFields = form.querySelectorAll('input, select, textarea');
                    allFields.forEach(field => {
                        if (field.disabled && field.name) {
                            field.disabled = false;
                            field.setAttribute('data-was-disabled', 'true');
                        }
                    });

                    // Verificar campos requeridos solo en secciones visibles
                    const requiredFields = form.querySelectorAll('[required]:not([disabled])');
                    let hasErrors = false;
                    let missingFields = [];

                    requiredFields.forEach(field => {
                        // Solo verificar campos que están en secciones visibles
                        const fieldContainer = field.closest('.role-fields');
                        const isFieldVisible = !fieldContainer ||
                                             fieldContainer.style.display !== 'none';

                        if (isFieldVisible && !field.value.trim()) {
                            console.log('Campo requerido vacío:', field.name || field.id);
                            hasErrors = true;
                            missingFields.push(field.getAttribute('data-label') || field.name || field.id);

                            // Agregar clase de error visual
                            field.classList.add('is-invalid');
                        } else {
                            // Remover clase de error si el campo está completo
                            field.classList.remove('is-invalid');
                        }
                    });

                    if (hasErrors) {
                        console.log('Hay campos requeridos vacíos:', missingFields);
                        e.preventDefault();

                        // Restaurar estado de campos deshabilitados
                        const fieldsToRestore = form.querySelectorAll('[data-was-disabled="true"]');
                        fieldsToRestore.forEach(field => {
                            field.disabled = true;
                            field.removeAttribute('data-was-disabled');
                        });

                        alert('Por favor, complete todos los campos requeridos antes de continuar.');

                        // Hacer scroll al primer campo con error
                        const firstErrorField = form.querySelector('[required].is-invalid');
                        if (firstErrorField) {
                            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            setTimeout(() => {
                                firstErrorField.focus();
                            }, 500);
                        }
                        return false;
                    }

                    // Si no hay errores, el formulario se enviará normalmente
                    console.log('Formulario válido, enviando...');
                });
            }
        });
    </script>
@endsection
