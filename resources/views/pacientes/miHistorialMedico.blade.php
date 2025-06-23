@extends('adminlte::page')

@section('title', 'Mi Historial Médico')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('content_header')
    <h1>Mi Historial Médico: <span class="text-danger font-bold">{{$paciente->nombre_completo}}</span></h1>
@stop

@section('content')
    <div class="border p-2 mb-2">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <img width="100" class="img img-responsive img-fluid" src="{{asset($paciente->foto)}}" alt="">                
            </div>

            <div class="col-lg-6 mb-2">
                <input type="date" class="form-control" readonly value="{{ $paciente->fecha_nacimiento }}"
                    placeholder="Fecha de nacimiento">
            </div>

            <div class="col-lg-6 mb-2">
                <select name="genero" readonly id="genero" class="form-control form-select">
                    <option value="">Seleccione su género</option>
                    <option value="Masculino" {{ $paciente->genero == 'Masculino' ? 'selected' : '' }}>
                        Masculino</option>
                    <option value="Femenino" {{ $paciente->genero == 'Femenino' ? 'selected' : '' }}>
                        Femenino
                    </option>
                    <option value="Otro" {{ $paciente->genero == 'Otro' ? 'selected' : '' }}>Otro
                    </option>
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <input type="text" readonly value="{{ $paciente->estado_civil }}" class="form-control"
                    placeholder="Estado civil">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" readonly value="{{ $paciente->nacionalidad }}" class="form-control"
                    placeholder="Nacionalidad">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" readonly value="{{ $paciente->celular }}" class="form-control" placeholder="Teléfono">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" readonly value="{{ $paciente->email }}" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-12 mb-2">
                <input type="text" class="form-control" readonly value="{{ $paciente->direccion }}"
                    placeholder="Dirección de residencia">
            </div>
        </div>
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Consideraciones médicas</h5>
            </div>
        </div>

        @foreach ($paciente->antecedentes as $antecedente)
            <div class="row mt-2 border p-2">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" placeholder="Alergias" value="{{ $antecedente->alergias }}">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" placeholder="Condiciones médicas preexistentes"
                        value="{{ $antecedente->condiciones_medicas }}">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Medicamentos que consume habitualmente"
                        value="{{ $antecedente->medicamentos }}">
                </div>
            </div>
        @endforeach
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-2">
            <div class="col-lg-12 mb-2">
                <h3 class="">Seguro de salud</h3>
            </div>
        </div>

        <div class="row border p-2 mb-2">
            <div class="col-lg-12 mb-2">
                <select class="form-control form-select" name="seguros_medicos[]" id="seguros_medicos" multiple>
                    @foreach ($seguros as $seguro)
                        <option value="{{ $seguro->id }}" @if ($paciente->segurosMedicos->contains('id', $seguro->id)) selected @endif>
                            {{ $seguro->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12 mb-2">
                <h3 class="">Datos de emergencia</h3>
            </div>
        </div>
        @foreach ($paciente->contactos_emergencia as $contacto)
            <div class="row mt-2 border p-2">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" placeholder="Nombre" value="{{ $contacto->nombre }}">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" placeholder="Relación" value="{{ $contacto->relacion }}">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" placeholder="Teléfono" value="{{ $contacto->telefono }}">
                </div>
            </div>
        @endforeach
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-2">
            <div class="col-lg-12 mb-2">
                <h3 class="">Informes de consulta</h3>
            </div>
        </div>

        @foreach ($informes as $informe)
            <div class="row border p-2 mb-2">
                <div class="col-md-1 mb-2">
                    <input type="text" value="{{$informe->id}}" class="form-control" placeholder="QR">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="text" value="{{date("Y-m-d", strtotime($informe->created_at))}}" class="form-control" placeholder="Fecha">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="text" value="{{$informe->motivo_consulta}}" class="form-control" placeholder="Motivo">
                </div>
                <div class="col-md-2 mb-2">
                    <a class="btn btn-dark w-100" href="/profesional/cita/informe-consulta/{{$informe->cita_id}}">Ver informe</a>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control" placeholder="Seguimiento/nueva consulta">
                </div>
                <div class="col-md-2 mb-2">
                    <a href="" class="btn btn-dark w-100">Contactar</a>
                </div>
            </div>        
        @endforeach
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-2">
            <div class="col-lg-12 mb-2">
                <h3 class="">Recetas</h3>
            </div>
        </div>

        @foreach ($recetas as $receta)
            <div class="row border p-2 mb-2">
                <div class="col-md-3 mb-2">
                    @php
                        $receta1 = \App\Models\Receta::find($receta->id);
                        $medicamentos = $receta1->medicamentosRecetados->map(function($med) {
                            return optional($med->medicamento)->nombre;
                        })->filter()->implode(', ');
                    @endphp
                    <input type="text" value="{{ $medicamentos }}" class="form-control" placeholder="Medicamento/s recetados">

                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" value="{{$receta->fecha_emision}}" class="form-control" placeholder="Fecha">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" value="{{$receta->nombre_completo}}" class="form-control" placeholder="Médico que recetó">
                </div>
                <div class="col-md-3 mb-2">
                    <a href="/paciente/cita/informe-consulta/{{$receta->idInforme}}/receta" class="btn btn-dark w-100">Ver receta</a>
                </div>
            </div>
        @endforeach
    </div>

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