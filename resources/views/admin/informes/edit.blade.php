@extends('adminlte::page')

@section('title', 'Editar Informe de Consulta')

@section('content_header')
    <h1 class="mb-0">Editar Informe de Consulta: {{ $informe->id }}</h1>
@stop

@section('content')
    <!-- Mensajes de éxito/error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Editar Informe</h5>
            <a style="font-weight: bold;" href="{{ route('informes.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
        <div class="card-body">
            <!-- Información del Paciente -->
            <div class="border rounded p-3 bg-light mb-3">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img img-fluid img-responsive img-thumbnail"
                            src="{{ asset($informe->cita->paciente->foto) }}" alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <strong>Nombre paciente:</strong><br>
                                <span>{{ $informe->cita->paciente->nombre_completo }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Fecha de nacimiento:</strong><br>
                                <span>{{ \Carbon\Carbon::parse($informe->cita->paciente->fecha_nacimiento)->format('d-m-Y') }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Género:</strong><br>
                                <span>{{ $informe->cita->paciente->genero }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Estado civil:</strong><br>
                                <span>{{ $informe->cita->paciente->estado_civil }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <strong>Nacionalidad:</strong><br>
                                <span>{{ $informe->cita->paciente->nacionalidad }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Teléfono:</strong><br>
                                <span>{{ $informe->cita->paciente->celular }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Email:</strong><br>
                                <span>{{ $informe->cita->paciente->email }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Dirección de residencia:</strong>
                                <span>{{ $informe->cita->paciente->direccion }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border rounded p-3 bg-light mb-3">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img img-fluid img-responsive img-thumbnail"
                            src="{{ asset($informe->cita->profesional->foto) }}" alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <strong>Nombre profesional:</strong><br>
                                <span>{{ $informe->cita->profesional->nombre_completo }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Fecha de nacimiento:</strong><br>
                                <span>{{ \Carbon\Carbon::parse($informe->cita->profesional->fecha_nacimiento)->format('d-m-Y') }}</span>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <strong>Género:</strong><br>
                                <span>{{ $informe->cita->profesional->genero }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Teléfono Personal:</strong><br>
                                <span>{{ $informe->cita->profesional->telefono_personal }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <strong>Teléfono Profesional:</strong><br>
                                <span>{{ $informe->cita->profesional->telefono_profesional }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Email:</strong><br>
                                <span>{{ $informe->cita->profesional->email }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Idiomas:</strong><br>
                                <span>{{ $informe->cita->profesional->idiomas }}</span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <strong>Plan:</strong><br>
                                <span>{{ $informe->cita->profesional->plan->nombre }}
                                    ({{ $informe->cita->profesional->plan->precio }}€)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Número de colegiado:</strong> <br>
                                <span>{{ $informe->cita->profesional->num_colegiado }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Categoría:</strong> <br>
                                <span>{{ $informe->cita->profesional->categoria->nombre }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Provincia:</strong> <br>
                                <span>{{ $informe->cita->profesional->ciudad->provincia->nombre }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Ciudad:</strong> <br>
                                <span>{{ $informe->cita->profesional->ciudad->nombre }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Informe -->
            <form action="{{ route('informes.update', $informe->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Selector de Paciente -->
                <div class="border rounded p-3 bg-warning mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark text-bold mb-3">Cambiar Paciente Asociado</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label fw-bold">Seleccionar Paciente:</label>
                            <select name="paciente_id" class="form-control @error('paciente_id') is-invalid @enderror">
                                <option value="">Mantener paciente actual ({{ $informe->cita->paciente->nombre_completo }})</option>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}
                                        {{ $informe->cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->nombre_completo }} - {{ $paciente->cedula ?? 'Sin cédula' }} - {{ $paciente->email ?? 'Sin email' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">Si selecciona un paciente diferente, se actualizará la cita asociada al informe. Las recetas también se mantendrán asociadas a este informe.</small>
                        </div>
                    </div>
                </div>

                <div class="border rounded p-3 bg-light mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-danger text-bold">Informe de Consulta</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Motivo de la consulta</label>
                            <textarea rows="3" class="form-control @error('motivo_consulta') is-invalid @enderror" name="motivo_consulta">{{ old('motivo_consulta', $informe->motivo_consulta) }}</textarea>
                            @error('motivo_consulta')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Antecedentes patológicos familiares</label>
                            <textarea rows="3" class="form-control @error('antecedentes_familiares') is-invalid @enderror" name="antecedentes_familiares">{{ old('antecedentes_familiares', $informe->antecedentes_familiares) }}</textarea>
                            @error('antecedentes_familiares')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Enfermedad actual o anamnesis</label>
                            <textarea rows="3" class="form-control @error('enfermedad_actual') is-invalid @enderror" name="enfermedad_actual">{{ old('enfermedad_actual', $informe->enfermedad_actual) }}</textarea>
                            @error('enfermedad_actual')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Exploración física</label>
                            <textarea rows="3" class="form-control @error('exploracion_fisica') is-invalid @enderror" name="exploracion_fisica">{{ old('exploracion_fisica', $informe->exploracion_fisica) }}</textarea>
                            @error('exploracion_fisica')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Pruebas complementarias</label>
                            <textarea rows="3" class="form-control @error('pruebas_complementarias') is-invalid @enderror" name="pruebas_complementarias">{{ old('pruebas_complementarias', $informe->pruebas_complementarias) }}</textarea>
                            @error('pruebas_complementarias')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Juicio clínico</label>
                            <textarea rows="3" class="form-control @error('juicio_clinico') is-invalid @enderror" name="juicio_clinico">{{ old('juicio_clinico', $informe->juicio_clinico) }}</textarea>
                            @error('juicio_clinico')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Odontograma</label>
                            <textarea rows="3" class="form-control @error('dibujo_dental') is-invalid @enderror" name="dibujo_dental">{{ old('dibujo_dental', $informe->dibujo_dental) }}</textarea>
                            @error('dibujo_dental')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Plan terapéutico</label>
                            <textarea rows="3" class="form-control @error('plan_terapeutico') is-invalid @enderror" name="plan_terapeutico">{{ old('plan_terapeutico', $informe->plan_terapeutico) }}</textarea>
                            @error('plan_terapeutico')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <a href="{{ route('informes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // Advertencia cuando se cambia el paciente
        document.querySelector('select[name="paciente_id"]').addEventListener('change', function() {
            if (this.value !== '' && this.value !== '{{ $informe->cita->paciente_id }}') {
                const selectedOption = this.options[this.selectedIndex];
                const warningMessage = `⚠️ ATENCIÓN: Está cambiando el paciente asociado a este informe.\n\nNuevo paciente: ${selectedOption.text}\n\nEsto actualizará:\n- La cita asociada\n- El paciente del informe\n\nLas recetas se mantendrán vinculadas a este informe.`;
                alert(warningMessage);
            }
        });

        console.log('Editar Informe de Consulta!');
    </script>
@stop
