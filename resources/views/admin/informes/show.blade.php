@extends('adminlte::page')

@section('title', 'Ver Informe de Consulta')

@section('content_header')
    <h1 class="mb-0">Ver Informe de Consulta: {{ $informe->id }}</h1>
@stop

@section('content')
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Detalle del Informe</h5>
            <a style="font-weight: bold;" href="{{ route('informes.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
        <div class="card-body">
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
            <div class="border rounded p-3 bg-light mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-danger text-bold">Informe de Consulta</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Motivo de la consulta</label>
                        <textarea rows="3" class="form-control" readonly name="motivo_consulta">{{ $informe->motivo_consulta }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Antecedentes patológicos familiares</label>
                        <textarea readonly rows="3" class="form-control" name="antecedentes_familiares">{{ old('antecedentes_familiares', $informe->antecedentes_familiares ?? '') }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Enfermedad actual o anamnesis</label>
                        <textarea readonly rows="3" class="form-control" name="enfermedad_actual">{{ old('enfermedad_actual', $informe->enfermedad_actual ?? '') }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Exploración física</label>
                        <textarea readonly rows="3" class="form-control" name="exploracion_fisica">{{ old('exploracion_fisica', $informe->exploracion_fisica ?? '') }}</textarea>            
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Pruebas complementarias</label>
                        <textarea readonly rows="3" class="form-control" name="pruebas_complementarias">{{ old('pruebas_complementarias', $informe->pruebas_complementarias ?? '') }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Juicio clínico</label>
                        <textarea readonly rows="3" class="form-control" name="juicio_clinico">{{ old('juicio_clinico', $informe->juicio_clinico ?? '') }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Odontograma --> Sólo odontólogos</label>
                        <textarea readonly rows="3" class="form-control" name="dibujo_dental">{{ old('dibujo_dental', $informe->dibujo_dental ?? '') }}</textarea>                   
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Plan terapéutico</label>
                        <textarea readonly rows="3" class="form-control" name="plan_terapeutico">{{ old('plan_terapeutico', $informe->plan_terapeutico ?? '') }}</textarea>                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Detalle de la Receta</h5>          
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 mb-3">
                    {!! QrCode::size(80)->generate($receta->qr) !!}
                </div>
                <div class="col-lg-3">
                    <label class="form-label fw-bold">ID Informe de Consulta</label>
                    <p><a href="/admin/informes-consulta/{{ $receta->informe_consulta_id }}">{{ $receta->informe_consulta_id }}
                            ({{ $receta->informeConsulta->motivo_consulta }})</a></p>
                </div>
                <div class="col-lg-3">
                    <label class="form-label fw-bold">Fecha de Emisión</label>
                    <p>{{ \Carbon\Carbon::parse($receta->fecha_emision)->format('d-m-Y H:i') }}</p>
                </div>
                <div class="col-lg-4">
                    <p>
                        <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-info w-50">
                            <i class="fa fa-eye"></i> Ver Detalle
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
