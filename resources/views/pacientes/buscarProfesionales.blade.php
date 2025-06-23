@extends('adminlte::page')

@section('title', 'Buscar profesionales')

@section('content_header')
    <h1>Buscar profesionales</h1>
@stop

@section('content')

    <style>
        .medico-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #fff;
        }

        .btn-black {
            background-color: #000;
            color: #fff;
        }

        .btn-black:hover {
            background-color: #222;
        }

        .star-rating i {
            color: gold;
        }
    </style>

    <div class="row bg-light p-3">
        <div class="col-md-3 mb-1 mt-1">
            <select name="especialidad_id" id="" class="form-control">
                <option value="">--Seleccione especialidad--</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mb-1 mt-1">
            <select name="sub_especialidad_id" id="" class="form-control">
                <option value="">--Seleccione subespecialidad--</option>
              
            </select>
        </div>
        <div class="col-md-3 mb-1 mt-1">
            <select name="modalidad" id="" class="form-control">
                <option value="">--Seleccione modalidad--</option>
                <option value="presencial">Presencial</option>
                <option value="videoconsulta">VideoConsulta</option>
            </select>
        </div>
        <div class="col-md-3 mb-1 mt-1">
            <select class="form-control form-select" name="" id="">
             @foreach ($seguros as $seguro )
             <option value="{{$seguro->id}}">{{$seguro->nombre}}</option>
             @endforeach
            </select>
         </div>
        <div class="col-md-3 mb-1 mt-1">
            <button class="btn w-100 btn-outline-secondary">Provincia</button>
        </div>
        <div class="col-md-3 mb-1 mt-1">
            <button class="btn w-100 btn-outline-secondary">Ciudad</button>
        </div>
        
        <div class="col-md-3 mb-1 mt-1">
            <button class="btn w-100 btn-outline-secondary">Más filtros</button>
        </div>
        <div class="col-md-3 mb-1 mt-1">
            <button class="btn w-100 btn-dark">Aplicar filtros</button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Listado médicos</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="border p-2 mb-2">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Foto">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Valoraciones">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Especialidades">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Modalidades">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Calendario">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Seguros">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Ubicaciones">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Listado de pecios">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Marcar como favorito">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Ver perfil</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Pedir cita</button>
                    </div>
                </div>
            </div>
            <div class="border p-2 mb-2">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Foto">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Valoraciones">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Especialidades">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Modalidades">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Calendario">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Seguros">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input type="text" class="form-control" placeholder="Ubicaciones">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Listado de pecios">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <input type="text" class="form-control" placeholder="Marcar como favorito">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Ver perfil</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button class="btn btn-dark w-100">Pedir cita</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d432.49703688644036!2d-0.3992071667527209!3d39.41308034348533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604e9a0bba57dd%3A0x68c95564bacffaeb!2sMercadona!5e0!3m2!1ses!2ses!4v1745264119387!5m2!1ses!2ses"
                    style="width: 100%; height: 76.4vh" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <button class="btn w-100 btn-outline-secondary text-dark">Ampliar mapa</button>
                </div>
            </div>
        </div>
    </div>
@stop

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
                        $subSelect.append('<option value="">--Seleccione subespecialidad--</option>');
                        
                        $.each(data, function(key, value) {
                            $subSelect.append('<option value="' + value.id + '">' + value.nombre + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="sub_especialidad_id"]').empty().append('<option value="">--Seleccione subespecialidad--</option>');
            }
        });
    });
    </script>
    
@endsection