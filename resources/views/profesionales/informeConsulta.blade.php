@extends('adminlte::page')

@section('title', 'Informe de consulta')


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection


@section('content_header')
    <div class="row mb-4">
        <div class="col-lg-6 d-flex align-items-center">
            <h1>Informe de consulta</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-end align-items-center">
            <a href="" class="btn btn-outline-secondary">{{ date('d-m-Y H:i:s', strtotime($cita->fecha_hora)) }}</a>
        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/pacientes/cita/informe-consulta/{{ $cita->id }}" method="post">
        @csrf

        {{-- Datos de filiación --}}
        <div class="row mb-4">
            <div class="col-lg-12">
                <h5 class="mb-3">Datos de filiación</h5>
                <div class="border rounded p-3">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Nombre paciente</label>
                            <input value="{{ $cita->paciente->nombre_completo }}" type="text" class="form-control">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input value="{{ $cita->paciente->fecha_nacimiento }}" type="date" class="form-control">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Género</label>
                            <select name="genero" id="genero" class="form-control form-select">
                                <option value="">Seleccione su género</option>
                                <option value="Masculino" {{ $cita->paciente->genero == 'Masculino' ? 'selected' : '' }}>
                                    Masculino</option>
                                <option value="Femenino" {{ $cita->paciente->genero == 'Femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>
                                <option value="Otro" {{ $cita->paciente->genero == 'Otro' ? 'selected' : '' }}>Otro
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estado civil</label>
                            <input value="{{ $cita->paciente->estado_civil }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nacionalidad</label>
                            <input value="{{ $cita->paciente->nacionalidad }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input value="{{ $cita->paciente->celular }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input value="{{ $cita->paciente->email }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Dirección de residencia</label>
                            <input value="{{ $cita->paciente->direccion }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Antecedentes patológicos personales --}}
        <div class="row mb-4 border p-4">
            <div class="col-lg-12">
                <h5 class="mb-3">Antecedentes patológicos personales</h5>
                @foreach ($cita->paciente->antecedentes as $antecedente)
                    <div class="border rounded p-2 mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alergias</label>
                                <input value="{{ $antecedente->alergias }}" type="text" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Condiciones médicas preexistentes</label>
                                <input value="{{ $antecedente->condiciones_medicas }}" type="text" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Medicamentos que consume habitualmente</label>
                                <input value="{{ $antecedente->medicamentos }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Seguro de salud --}}
        <div class="row mb-4">
            <div class="col-lg-12">
                <h5 class="mb-3">Seguro de salud</h5>
                <div class="border rounded p-3">
                    <label class="form-label">Seguro médico del paciente</label>
                    <select class="form-control form-select" name="seguros_medicos[]" id="seguros_medicos" multiple>
                        @foreach ($seguros as $seguro)
                            <option value="{{ $seguro->id }}" @if ($cita->paciente->segurosMedicos->contains('id', $seguro->id)) selected @endif>
                                {{ $seguro->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Datos de emergencia --}}
        <div class="row mb-4">
            <div class="col-lg-12">
                <h5 class="mb-3">Datos de emergencia</h5>
                @foreach ($cita->paciente->contactos_emergencia as $contacto)
                    <div class="row mt-2 border p-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Nombre"
                                value="{{ $contacto->nombre }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Relación"
                                value="{{ $contacto->relacion }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Teléfono"
                                value="{{ $contacto->telefono }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Informe de consulta --}}
        @php
            $informe = $cita->informeConsulta;
        @endphp

        <div class="row mb-4">
            <div class="col-lg-12">
                <h5 class="mb-3">Informe de consulta</h5>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Motivo de la consulta</label>
                    <textarea rows="3" class="form-control" name="motivo_consulta">{{ old('motivo_consulta', $informe->motivo_consulta ?? $cita->motivo) }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Antecedentes patológicos familiares</label>
                    <textarea rows="3" class="form-control" name="antecedentes_familiares">{{ old('antecedentes_familiares', $informe->antecedentes_familiares ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Antecedentes patológicos personales</label>
                    <textarea rows="3" class="form-control" name="antecedentes_personales">{{ old('antecedentes_personales', $informe->antecedentes_personales ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Enfermedad actual o anamnesis</label>
                    <textarea rows="3" class="form-control" name="enfermedad_actual">{{ old('enfermedad_actual', $informe->enfermedad_actual ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Exploración física</label>
                    <textarea rows="3" class="form-control" name="exploracion_fisica">{{ old('exploracion_fisica', $informe->exploracion_fisica ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Pruebas complementarias</label>
                    <textarea rows="3" class="form-control" name="pruebas_complementarias">{{ old('pruebas_complementarias', $informe->pruebas_complementarias ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Juicio clínico</label>
                    <textarea rows="3" class="form-control" name="juicio_clinico">{{ old('juicio_clinico', $informe->juicio_clinico ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3 mb-3">
                    <label class="form-label">Odontograma --> Sólo odontólogos</label>
                    <textarea rows="3" class="form-control" name="dibujo_dental">{{ old('dibujo_dental', $informe->dibujo_dental ?? '') }}</textarea>
                </div>

                <div class="border rounded p-3">
                    <label class="form-label">Plan terapéutico</label>
                    <textarea rows="3" class="form-control" name="plan_terapeutico">{{ old('plan_terapeutico', $informe->plan_terapeutico ?? '') }}</textarea>
                </div>
            </div>
        </div>


        @if($informe != null)
            {{-- Acciones --}}
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <a href="/profesional/cita/informe-consulta/{{$informe->id}}/receta" class="btn btn-dark w-100">Crear/Editar receta</a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="/profesional/cita/informe-consulta/{{ $informe->id }}/pedido-laboratorio" class="btn btn-dark w-100">Crear/Editar pedido de laboratorio
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="/profesional/cita/informe-consulta/{{$informe->id}}/pedido-imagen" class="btn btn-dark w-100">Crear/Editar pedido de imágenes</a>                    
                </div>
            </div>

            {{-- Pruebas adjuntas --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <h5 class="mb-3">Pruebas de laboratorio o centros de imagen</h5>
                    <div class="border rounded p-3">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Archivo 1</label>
                                <input type="text" class="form-control" placeholder="Seleccionar prueba/resultado PDF">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Archivo 2</label>
                                <input type="text" class="form-control" placeholder="Seleccionar prueba/resultado PDF">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Archivo 3</label>
                                <input type="text" class="form-control" placeholder="Seleccionar prueba/resultado PDF">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Botones finales --}}
        <div class="row mb-5">
            <div class="col-md-6 mb-2">
                <button type="submit" class="btn btn-dark w-100">Guardar datos</button>
            </div>
            <div class="col-md-6 mb-2">
                <button class="btn btn-outline-secondary w-100">Cancelar</button>
            </div>
        </div>
    </form>

@stop

@section('js')
    <!-- jQuery (si no está incluido aún) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#seguros_medicos').select2({
                placeholder: "Seleccione uno o más seguros médicos"
            });
        });
    </script>
@endsection
