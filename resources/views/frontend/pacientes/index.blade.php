@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Inicio')</title>

@section('content')
    <div class="container mt-4">
        <ul class="nav nav-tabs d-flex flex-wrap gap-2" id="tabButtons" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100 active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                    type="button" role="tab" aria-controls="tab1" aria-selected="true">
                    Médicos
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                    type="button" role="tab" aria-controls="tab2" aria-selected="false">
                    Odontólogos
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3"
                    type="button" role="tab" aria-controls="tab3" aria-selected="false">
                    Psicólogos
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4"
                    type="button" role="tab" aria-controls="tab4" aria-selected="false">
                    Laboratorio clínico
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5"
                    type="button" role="tab" aria-controls="tab5" aria-selected="false">
                    Centros de imagen
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab6-tab" data-bs-toggle="tab" data-bs-target="#tab6"
                    type="button" role="tab" aria-controls="tab6" aria-selected="false">
                    Farmacias
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab7-tab" data-bs-toggle="tab" data-bs-target="#tab7"
                    type="button" role="tab" aria-controls="tab7" aria-selected="false">
                    Emergencias
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="btn btn-outline-dark w-100" id="tab8-tab" data-bs-toggle="tab" data-bs-target="#tab8"
                    type="button" role="tab" aria-controls="tab8" aria-selected="false">
                    Otros
                </button>
            </li>
        </ul>

        <div class="tab-content bg-light mt-2 p-2">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <form action="{{ route('pacientes.buscar.medicos') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <select name="especialidad_id" id="" class="form-control form-select">
                                <option value="">-- Selecciona una especialidad -- </option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="sub_especialidad_id" id="" class="form-control form-select">
                                <option value="">-- Selecciona una sub-especialidad -- </option>

                            </select>
                        </div>
                        <div class="col">
                            <input type="text" name="nombre_completo" placeholder="Nombre médico"
                                class="form-control">
                        </div>
                        <div class="col">
                            <select name="modalidad" id="" class="form-control form-select">
                                <option value="">-- Selecciona una modalidad -- </option>
                                <option value="presencial">Presencial</option>
                                <option value="videoconsulta">Videollamada</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-select" name="provincia_id" id="provincia_id">
                                <option value="">-- Seleccione la provincia -- </option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }} -
                                        {{ $provincia->region->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-select" name="ciudad_id" id="ciudad_id">
                                <option value="">-- Seleccione la ciudad -- </option>
                            </select>
                        </div>
                        <div class="col">
                            <select name="seguro_id" id="" class="form-control form-select">
                                <option value="">-- Selecciona un seguro -- </option>
                                @foreach ($seguros as $seguro)
                                    <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-dark w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="row">
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una sub-especialidad -- </option>

                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Nombre prof." class="form-control">
                    </div>
                    <div class="col">
                        <select name="modalidad" id="" class="form-control form-select">
                            <option value="">-- Selecciona una modalidad -- </option>
                            <option value="presencial">Presencial</option>
                            <option value="videoconsulta">Videollamada</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <div class="row">
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una sub-especialidad -- </option>

                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Nombre prof." class="form-control">
                    </div>
                    <div class="col">
                        <select name="modalidad" id="" class="form-control form-select">
                            <option value="">-- Selecciona una modalidad -- </option>
                            <option value="presencial">Presencial</option>
                            <option value="videoconsulta">Videollamada</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                <div class="row">
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Nombre prueba" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Geolocalizar" class="form-control">
                    </div>
                    <div class="col">
                        <select name="seguro_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona un seguro -- </option>
                            @foreach ($seguros as $seguro)
                                <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                <div class="row">
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Nombre prueba" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Geolocalizar" class="form-control">
                    </div>
                    <div class="col">
                        <select name="seguro_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona un seguro -- </option>
                            @foreach ($seguros as $seguro)
                                <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                <div class="row">
                    <div class="col">
                        <input type="text" placeholder="Disponibilidad" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Geolocalizar" class="form-control">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-tab">
                <form action="{{ route('pacientes.buscar.emergencias') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <select name="tipo" id="" class="form-control form-select">
                                <option value="">-- Seleccione tipo de servicio -- </option>
                                <option value="Farmacia 24 horas">Farmacia 24 horas</option>
                                <option value="Ambulancia 24 horas">Ambulancia 24 horas</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-select" name="provincia_id1" id="provincia_id1">
                                <option value="">-- Seleccione la provincia -- </option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }} -
                                        {{ $provincia->region->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control form-select" name="ciudad_id1" id="ciudad_id1">
                                <option value="">-- Seleccione la ciudad -- </option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Geolocalizar" class="form-control">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-dark w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="tab8-tab">
                <div class="row">
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="especialidad_id" id="" class="form-control form-select">
                            <option value="">-- Selecciona una sub-especialidad -- </option>

                        </select>
                    </div>
                    <div class="col">
                        <select name="modalidad" id="" class="form-control form-select">
                            <option value="">-- Selecciona una modalidad -- </option>
                            <option value="presencial">Presencial</option>
                            <option value="videoconsulta">Videollamada</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Provincia" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" placeholder="Ciudad" class="form-control">
                    </div>
                    <div class="col">
                        <button class="btn btn-dark w-100">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('select[name="especialidad_id"]').on('change', function() {
                var especialidadId = $(this).val();

                if (especialidadId) {
                    $.ajax({
                        url: '/subespecialidades/' + especialidadId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            let $subSelect = $('select[name="sub_especialidad_id"]');
                            $subSelect.empty();
                            $subSelect.append(
                                '<option value="">-- Seleccione subespecialidad --</option>'
                            );

                            $.each(data, function(key, value) {
                                $subSelect.append('<option value="' + value.id + '">' +
                                    value.nombre + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="sub_especialidad_id"]').empty().append(
                        '<option value="">-- Seleccione subespecialidad --</option>');
                }
            });


            $('#provincia_id').on('change', function() {
                let provinciaID = $(this).val();
                cargarCiudades(provinciaID);
            });

            $('#provincia_id1').on('change', function() {
                let provinciaID = $(this).val();
                cargarCiudades2(provinciaID);
            });

            function cargarCiudades2(provinciaId) {
                if (!provinciaId) return;

                $.get(`/get-ciudades/${provinciaId}`, function(data) {
                    $('#ciudad_id1').empty().append('<option value="">-- Seleccione la ciudad --</option>');
                    $.each(data, function(i, ciudad) {

                        $('#ciudad_id1').append(
                            `<option value="${ciudad.id}">${ciudad.nombre}</option>`
                        );
                    });
                });
            }

            function cargarCiudades(provinciaId) {
                if (!provinciaId) return;

                $.get(`/get-ciudades/${provinciaId}`, function(data) {
                    $('#ciudad_id').empty().append('<option value="">-- Seleccione la ciudad --</option>');
                    $.each(data, function(i, ciudad) {

                        $('#ciudad_id').append(
                            `<option value="${ciudad.id}">${ciudad.nombre}</option>`
                        );
                    });
                });
            }

        });
    </script>
@endsection
