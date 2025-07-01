@extends('adminlte::page')

@section('title', 'Mis Datos')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor documentos */
        .col-md-12.mb-2 {
            background: #f9f9f9;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        /* Etiqueta título */
        .col-md-12.mb-2>label {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 12px;
            color: #333;
        }

        /* Cada fila */
        .col-md-12.mb-2 .row {
            align-items: center;
            margin-bottom: 10px;
        }

        /* Input texto */
        .col-md-12.mb-2 .row .form-control {
            background: #fff;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .col-md-12.mb-2 .row .form-control:focus {
            border-color: #495057;
            box-shadow: none;
        }

        /* Enlace “Abrir” */
        .col-md-12.mb-2 .row a {
            background: #007bff;
            color: black !important;
            padding: 7px 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .col-md-12.mb-2 .row a:hover {
            background: #0056b3;
        }

        /* Icono archivo */
        .col-md-12.mb-2 .row a i.fa-file {
            margin-right: 6px;
            font-size: 1.1rem;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content_header')
    <div class="row">
        <div class="col-lg-12">
            <h1>Mis Datos</h1>
        </div>

    </div>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    @if (session(key: 'errors'))
        <div class="alert alert-danger mt-2">
            {{ session('errors') }}
        </div>
    @endif

@stop

@section('content')
    <div class="border p-4 mb-2">
        <div class="row mb-2">
            <div class="col-md-2 col-lg-2">
                @if ($profesional->foto)
                    <label for="">Foto de Perfil</label>
                    <img src="{{ asset($profesional->foto) }}" alt="Foto Perfil"
                        class="img img-responsive img-fluid profile-image">
                @endif
            </div>
            <div class="col-md-2 col-lg-2">
                @if ($profesional->logo)
                    <label for="">Logo Profesional</label>
                    <img src="{{ asset($profesional->logo) }}" alt="Foto Logo"
                        class="img img-responsive img-fluid profile-image">
                @endif
            </div>
        </div>
        <div class="row border p-2">
            <div class="col-md-3 mb-2">
                <input id="foto" name="foto" type="file" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <input id="logo" name="logo" type="file" class="form-control">
            </div>
            <div class="col-md-6 mb-2">
                <input id="nombre_completo"type="text" value="{{ $profesional->nombre_completo }}" class="form-control"
                    placeholder="Nombre completo">
            </div>
            <div class="col-md-6 mb-2">
                <input id="fecha_nacimiento" type="date" value="{{ $profesional->fecha_nacimiento }}"
                    class="form-control" placeholder="Fecha de nacimiento">
            </div>
            <div class="col-md-6 mb-2">
                <select name="" id="genero" class="form-control form-select">
                    <option value="">Seleccione su género</option>
                    <option value="Hombre" {{ $profesional->genero == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ $profesional->genero == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Otro" {{ $profesional->genero == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <input id="telefono_personal" type="text" value="{{ $profesional->telefono_personal }}"
                    class="form-control" placeholder="Teléfono personal">
            </div>
            <div class="col-md-4 mb-2">
                <input id="cedula_identidad" type="text" value="{{ $profesional->cedula_identidad }}"
                    class="form-control" placeholder="Cédula de identidad">
            </div>
            <div class="col-md-4 mb-2">
                <input id="telefono_profesional" type="text" value="{{ $profesional->telefono_profesional }}"
                    class="form-control" placeholder="Teléfono profesional">
            </div>
            <div class="col-md-12 mb-2">
                <input type="text" readonly disabled value="{{ $profesional->user->email }}" class="form-control"
                    placeholder="Email">
            </div>
            <div class="col-md-12 mb-2">
                <input id="idiomas" type="text" value="{{ $profesional->idiomas }}" class="form-control"
                    placeholder="Idiomas">
            </div>
            <div class="col-md-4 mb-2">
                <select class="form-control form-select" name="region_id" id="region_id">
                    <option value="">-- Selecciona una región --</option>
                    @foreach ($regiones as $region)
                        <option value="{{ $region->id }}"
                            {{ $region->id == old('region_id', $region_id ?? '') ? 'selected' : '' }}>
                            {{ $region->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <select class="form-control form-select" name="provincia_id" id="provincia_id">
                    <option value="">-- Seleccione la provincia -- </option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <select class="form-control form-select" name="ciudad_id" id="ciudad_id">
                    <option value="">-- Seleccione la ciudad -- </option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label for="">¿Aceptas citas presenciales?</label>
                <select class="form-control form-select" name="aceptas_presencial" id="aceptas_presencial">
                    <option value="0" {{ old('presencial', $profesional->presencial) == 0 ? 'selected' : '' }}>No
                    </option>
                    <option value="1" {{ old('presencial', $profesional->presencial) == 1 ? 'selected' : '' }}>Sí
                    </option>
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label for="">¿Aceptas citas por videoconsulta?</label>
                <select class="form-control form-select" name="aceptas_videoconsulta" id="aceptas_videoconsulta">
                    <option value="0" {{ old('videoconsulta', $profesional->videoconsulta) == 0 ? 'selected' : '' }}>
                        No</option>
                    <option value="1" {{ old('videoconsulta', $profesional->videoconsulta) == 1 ? 'selected' : '' }}>
                        Sí</option>
                </select>
            </div>

        </div>
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Datos profesionales y experiencia laboral</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-2">
                <textarea name="" id="descripcion_profesional" rows="5" class="form-control"
                    placeholder="Descríbete como profesional">{{ $profesional->descripcion_profesional }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <input id="anios_experiencia" value="{{ $profesional->anios_experiencia }}" type="text"
                    class="form-control" placeholder="¿Años de experiencia?">
            </div>
            <div class="col-md-6 mb-2">
                <input id="licencia_medica" type="text" value="{{ $profesional->licencia_medica }}"
                    class="form-control" placeholder="Licencia médica (opción de subir documento)">
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="col-lg-12">
                <div class="text-center">
                    <button id="editar_datos" class="btn btn-dark">Guardar Datos</button>
                </div>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-between align-items-center mb-2">
            <div class="col-lg-10">
                <h6>Título universitario</h6>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-sm btn-dark w-100" data-toggle="modal" data-target="#modalTituloUniversitario">
                    <i class="fa fa-plus"></i> Añadir
                </button>
            </div>
        </div>


        <div id="contenedor-titulos-universitarios">
            @foreach ($profesional->titulosUniversitarios as $titulo)
                <div class="row mb-2" id="titulo-{{ $titulo->id }}">
                    <div class="col-md-3">
                        <input type="text" value="{{ $titulo->nombre }}" class="form-control"
                            placeholder="Nombre del título">
                    </div>
                    <div class="col-md-3">
                        <input type="text" value="{{ $titulo->centro_educativo }}" class="form-control"
                            placeholder="Centro educativo">
                    </div>
                    <div class="col-md-2">
                        <input type="text" value="{{ $titulo->pais }}" class="form-control" placeholder="País">
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-id="{{ $titulo->id }}"
                            class="btn btn-danger w-100 eliminar-titulo">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                            <i class="fa fa-plus"></i> Subir documento
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4 d-flex justify-content-between align-items-center mb-2">
            <div class="col-lg-10">
                <h6>Especialización</h6>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-dark w-100" data-dis data-toggle="modal" data-target="#modalEspecializacion">
                    <i class="fa fa-plus"></i> Añadir
                </button>
            </div>
        </div>

        <div id="contenedor-especializaciones">
            @foreach ($profesional->especializaciones as $especialidad)
                <div class="row" id="especializacion-{{ $especialidad->id }}">
                    <div class="col-md-2 mb-2">
                        @if ($especialidad->subespecialidad != null)
                            <input type="text"
                                value="{{ $especialidad->especialidad->nombre }} / {{ $especialidad->subespecialidad->nombre }}"
                                class="form-control" placeholder="Nombre del título">
                        @else
                            <input type="text" value="{{ $especialidad->especialidad->nombre }}" class="form-control"
                                placeholder="Nombre del título">
                        @endif
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" value="{{ $especialidad->centro_educativo }}" class="form-control"
                            placeholder="Centro educativo">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" value="{{ $especialidad->pais }}" class="form-control"
                            placeholder="País">
                    </div>
                    <div class="col-md-1 mb-2">
                        <input type="text" value="${{ $especialidad->precio_presencial }}" class="form-control"
                            placeholder="Precio consulta presencial">
                    </div>
                    <div class="col-md-1 mb-2">
                        <input type="text" value="${{ $especialidad->precio_videoconsulta }}" class="form-control"
                            placeholder="Precio videoconsulta">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="button" data-id="{{ $especialidad->id }}"
                            class="btn btn-danger w-100 eliminar-especializacion">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                            <i class="fa fa-plus"></i> Subir documento
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4 d-flex justify-content-between align-items-center mb-2">
            <div class="col-lg-10">
                <h6>Formaciones Adicionales</h6>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-dark w-100" data-toggle="modal" data-target="#modalFormacionesAdicionales">
                    <i class="fa fa-plus"></i> Añadir
                </button>
            </div>
        </div>


        <div class="col-lg-12 mt-2">
            <h6>Cursos</h6>
        </div>

        @foreach ($profesional->formacionesAdicionales->where('tipo', 'curso') as $curso)
            <div class="row" id="curso-{{ $curso->id }}">
                <div class="col-md-8 mb-2">
                    <input type="text" value="{{ $curso->nombre }}" class="form-control" placeholder="Nombre curso">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger w-100 eliminar-curso" data-id="{{ $curso->id }}">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                        <i class="fa fa-plus"></i> Subir documento
                    </button>
                </div>
            </div>
        @endforeach

        <div class="col-lg-12 mt-2">
            <h6>Másters</h6>
        </div>

        @foreach ($profesional->formacionesAdicionales->where('tipo', 'master') as $master)
            <div class="row" id="curso-{{ $master->id }}">
                <div class="col-md-8 mb-2">
                    <input type="text" value="{{ $master->nombre }}" class="form-control"
                        placeholder="Nombre curso">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger w-100 eliminar-curso" data-id="{{ $master->id }}">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                        <i class="fa fa-plus"></i> Subir documento
                    </button>
                </div>
            </div>
        @endforeach

        <div class="col-lg-12 mt-2">
            <h6>Talleres</h6>
        </div>

        @foreach ($profesional->formacionesAdicionales->where('tipo', 'taller') as $taller)
            <div class="row" id="curso-{{ $taller->id }}">
                <div class="col-md-8 mb-2">
                    <input type="text" value="{{ $taller->nombre }}" class="form-control"
                        placeholder="Nombre taller">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger w-100 eliminar-curso" data-id="{{ $taller->id }}">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                        <i class="fa fa-plus"></i> Subir documento
                    </button>
                </div>
            </div>
        @endforeach

        <div class="col-lg-12 mt-2">
            <h6>Seminarios</h6>
        </div>

        @foreach ($profesional->formacionesAdicionales->where('tipo', 'seminario') as $seminario)
            <div class="row" id="curso-{{ $seminario->id }}">
                <div class="col-md-8 mb-2">
                    <input type="text" value="{{ $seminario->nombre }}" class="form-control"
                        placeholder="Nombre taller">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger w-100 eliminar-curso" data-id="{{ $seminario->id }}">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                        <i class="fa fa-plus"></i> Subir documento
                    </button>
                </div>
            </div>
        @endforeach

        <div class="col-lg-12 mt-2">
            <h6>Doctorados</h6>
        </div>

        @foreach ($profesional->formacionesAdicionales->where('tipo', 'doctorado') as $curso)
            <div class="row" id="curso-{{ $curso->id }}">
                <div class="col-md-8 mb-2">
                    <input type="text" value="{{ $curso->nombre }}" class="form-control" placeholder="Nombre curso">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger w-100 eliminar-curso" data-id="{{ $curso->id }}">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </div>
                <div class="col-lg-2 text-right">
                    <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                        <i class="fa fa-plus"></i> Subir documento
                    </button>
                </div>
            </div>
        @endforeach

        <div class="row mt-4 d-flex justify-content-between align-items-center mb-2">
            <div class="col-lg-10">
                <h6>Puesto y cargo</h6>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-dark w-100" data-toggle="modal" data-target="#modalExperiencia">
                    <i class="fa fa-plus"></i> Añadir experiencia
                </button>
            </div>
        </div>

        <div id="contenedor-experiencias">
            @foreach ($profesional->experienciasLaborales as $experiencia)
                <div class="row container-fluid mb-2" id="experiencia-{{ $experiencia->id }}">
                    <div class="col-md mb-2">
                        <input value="{{ $experiencia->puesto }}" type="text" class="form-control"
                            placeholder="Puesto">
                    </div>
                    <div class="col-md mb-2">
                        <input type="text" value="{{ $experiencia->clinica }}" class="form-control"
                            placeholder="Clínica/centro">
                    </div>
                    <div class="col-md mb-2">
                        <input type="text" value="{{ $experiencia->pais }}" class="form-control" placeholder="País">
                    </div>
                    <div class="col-md mb-2">
                        <input type="text" value="{{ $experiencia->anyo }}" class="form-control" placeholder="Año">
                    </div>
                    <div class="col-md mb-2">
                        <button type="button" class="btn btn-danger w-100 eliminar-experiencia"
                            data-id="{{ $experiencia->id }}">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1 d-flex justify-content-between align-items-center">
            <div class="col-lg-10">
                <h5>Consultorios</h5>
            </div>
            <div class="col-lg-2 text-right">
                <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalConsultorio">
                    <i class="fa fa-plus"></i> Añadir consultorio
                </button>
            </div>
        </div>

        <div id="contenedor-consultorios">
            @foreach ($profesional->consultorios as $consultorio)
                <div class="row">
                    <div class="col-lg-12">
                        <h6>Consultorio {{ $loop->index + 1 }}</h6>
                    </div>
                </div>
                <div class="row mt-1 border p-2 mb-4 position-relative" id="consultorio-{{ $consultorio->id }}">
                    <div class="col-md-8 mb-2">
                        <input type="text" value="{{ $consultorio->direccion }}" class="form-control"
                            placeholder="Dirección escrita">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="button" class="btn btn-success w-100 cargarImagenes"
                            data-id="{{ $consultorio->id }}" title="Cargar Imágenes">
                            <i class="fa fa-images"></i>
                        </button>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="button" class="btn btn-danger w-100 eliminar-consultorio"
                            data-id="{{ $consultorio->id }}" title="Eliminar"
                            onclick="eliminarConsultorio({{ $consultorio->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" value="{{ $consultorio->clinica }}" class="form-control"
                            placeholder="Clínica/edificio">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" value="{{ $consultorio->info_adicional }}" class="form-control"
                            placeholder="Información adicional">
                    </div>
                    @php
                        $imagenes = App\Models\ConsultorioImagen::where('consultorio_id', $consultorio->id)->get();
                    @endphp
                    @if ($imagenes->count() > 0)                      
                        <div class="row">
                            @foreach ($imagenes as $imagen)
                                <div class="col-lg-3 position-relative mb-3" id="imagen-{{ $imagen->id }}">
                                    {{-- Ícono eliminar (posición absoluta manual con inline CSS) --}}
                                    <button type="button" class="btn btn-sm btn-danger position-absolute eliminar-imagen"
                                        style="position: absolute; top: 10px; right: 15px; z-index: 10;"
                                        data-id="{{ $imagen->id }}" data-path="{{ $imagen->imagen_path }}"
                                        title="Eliminar imagen">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    {{-- Imagen --}}
                                    <img src="{{ asset($imagen->imagen_path) }}" alt="Imagen"
                                        class="img-thumbnail w-100">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </div>

    <div class="modal fade" id="modalCargarImagenes" tabindex="-1">
        <div class="modal-dialog">
            <form id="formCargarImagenes" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar imágenes</h5>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="imagenes[]" multiple class="form-control" accept="image/*" required>
                        <input type="hidden" id="consultorioIdInput" name="consultorio_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Seguros</h5>
            </div>
        </div>

        <div class="row mt-1 border p-2">
            <div class="col-md-12 mb-2">
                <select class="form-control form-select" name="seguros_medicos[]" id="seguros_medicos" multiple>
                    <option value="-1">-- Sin seguro --</option>
                    @foreach ($seguros as $seguro)
                        <option value="{{ $seguro->id }}" @if ($profesional->segurosMedicos->contains('id', $seguro->id)) selected @endif>
                            {{ $seguro->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Horario de atención</h5>
            </div>
        </div>

        <div class="row mt-1 border p-2">
            <div class="col-md-6">
                <label for="">Calendario Presencial</label>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target="#modalVerCalendario">
                            <i class="fa fa-calendar"></i> Ver Calendario
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success w-100" data-toggle="modal" data-target="#modalGenerarCalendario">
                            <i class="fa fa-plus"></i> Generar Calendario
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <label for="">Calendario Videoconsulta</label>
                <div class="row">
                    <div class="col-lg-6">
                         <button class="btn btn-primary w-100" data-toggle="modal" data-target="#modalVerCalendarioVideollamada">
                            <i class="fa fa-calendar"></i> Ver Calendario
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success w-100" data-toggle="modal"
                        data-target="#modalGenerarCalendarioVideollamada">
                        <i class="fa fa-plus"></i> Generar Calendario Videollamada
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1 d-flex justify-content-between align-items-center">
            <div class="col-lg-10">
                <h5>Validación profesional</h5>
            </div>
            <div class="col-lg-2 text-right">
                <button class="btn w-100 btn-dark" data-toggle="modal" data-target="#modalDocumento">
                    <i class="fa fa-plus"></i> Añadir documento
                </button>
            </div>
        </div>

        <div class="row mt-1 border p-2">
            @php
                $documentosPorTipo = $profesional->documentos;
            @endphp

            {{-- Identidad --}}
            <div class="col-md-12 mb-2">
                <label><strong>Documentación</strong></label>
                <div class="row">
                    @foreach ($documentosPorTipo as $doc)
                        <div class="col-lg-4 mb-3">
                            <input type="text" value="{{ $doc->nombre }}" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <a href="{{ asset($doc->archivo) }}" target="_blank" class="d-block mb-1 form-control">
                                <i class="fa fa-file"></i> Abrir
                            </a>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <strong>Estado: </strong> {{ ucfirst($doc->estado) }}
                        </div>
                        <div class="col-lg-2 mb-3">
                            <form action="{{ route('profesionales.documentos.destroy', $doc->id) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar documento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDocumento" tabindex="-1" role="dialog" aria-labelledby="modalDocumentoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('profesionales.documentos.store', $profesional->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDocumentoLabel">Añadir documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nombre">Nombre del documento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="">Selecciona tipo</option>
                                <option value="pdf">PDF</option>
                                <option value="imagen">Imagen</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="documento">Archivo</label>
                            <input type="file" class="form-control-file" id="documento" name="documento" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar documento</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Usuarios de gestión</h5>
            </div>
        </div>
        <div class="row mt-1 border p-2">
            <div class="col-md-3 mb-2">
                <input value="{{ $profesional->email }}" readonly type="text" class="form-control"
                    placeholder="Usuario">
            </div>
            <div class="col-md-3 mb-2">
                <input id="nueva_contrasena" type="password" class="form-control" placeholder="Contraseña nueva">
            </div>
            <div class="col-md-3 mb-2">
                <input id="repetir_contrasena" type="password" class="form-control" placeholder="Repetir contraseña">
            </div>
            <div class="col-md-3 mb-2">
                <button id="btn_actualizar_contrasena" class="btn btn-dark w-100"><i class="fa fa-key"></i>
                    Actualizar
                    Contraseña</button>
            </div>
        </div>

    </div>

    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Métodos de pago</h5>
            </div>
        </div>
        <div class="row mt-1 border p-2">
            <form action="{{ route('profesional.metodos_pago.update', $profesional->id) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($metodosPago as $metodo)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="metodos_pago[]"
                            value="{{ $metodo->id }}" id="metodo_pago_{{ $metodo->id }}"
                            {{ $profesional->metodosPago->contains($metodo->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="metodo_pago_{{ $metodo->id }}">
                            {{ $metodo->nombre }}
                        </label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-dark mt-3">Guardar</button>
            </form>
        </div>
    </div>


    <div class="border p-4 mb-2">
        <div class="row mt-1">
            <div class="col-lg-12">
                <h5>Número de cuenta donde recibir los pagos</h5>
            </div>
        </div>
        <div class="row mt-1 border p-2">
            <div class="col-lg-3">
                <input readonly disabled type="text" value="{{ $profesional->nombre_completo }}" class="form-control"
                    placeholder="Nombre del titular">
            </div>
            <div class="col-md-7 mb-2">
                <input type="text" value="{{ $profesional->numero_cuenta }}" class="form-control"
                    placeholder="Número de cuenta" id="numero_cuenta">
            </div>
            <div class="col-md-2">
                <button id="guardar_numero_cuenta" class="btn btn-dark w-100">
                    <i class="fa {{ $profesional->numero_cuenta ? 'fa-edit' : 'fa-plus' }}"></i>
                    {{ $profesional->numero_cuenta ? 'Actualizar' : 'Añadir' }}
                </button>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalTituloUniversitario" tabindex="-1" role="dialog"
        aria-labelledby="tituloModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formNuevoTitulo">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalLabel">Añadir Título Universitario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Nombre del título</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Centro educativo</label>
                            <input type="text" name="centro_educativo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>País</label>
                            <input type="text" name="pais" class="form-control" required>
                        </div>
                        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEspecializacion" tabindex="-1" role="dialog" aria-labelledby="tituloModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formNuevaEspecializacion">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Especialización</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <select name="especialidad_id" id="" class="form-control form-select">
                                <option value="">-- Selecciona una especialidad -- </option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="sub_especialidad_id" id="" class="form-control form-select">
                                <option value="">-- Selecciona una sub-especialidad -- </option>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="centro_educativo" class="form-control"
                                placeholder="Centro educativo" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="pais" class="form-control" placeholder="País" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="precio_presencial" class="form-control"
                                placeholder="Precio consulta presencial" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="precio_videoconsulta" class="form-control"
                                placeholder="Precio videoconsulta" required>
                        </div>
                        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalFormacionesAdicionales" tabindex="-1" role="dialog"
        aria-labelledby="tituloModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formFormacionesAdicionales">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Formación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tipo de formación</label>
                            <select name="tipo" id="" class="form-control">
                                <option value="curso">Curso</option>
                                <option value="master">Máster</option>
                                <option value="taller">Taller</option>
                                <option value="seminario">Seminario</option>
                                <option value="doctorado">Doctorado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del título"
                                required>
                        </div>
                        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalExperiencia" tabindex="-1" role="dialog" aria-labelledby="modalExperienciaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formNuevaExperiencia">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva experiencia laboral</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="puesto" class="form-control" placeholder="Puesto/Cargo"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="clinica" class="form-control" placeholder="Clínica/Centro">
                        </div>
                        <div class="form-group">
                            <input type="text" name="pais" class="form-control" placeholder="País">
                        </div>
                        <div class="form-group">
                            <input type="text" name="ciudad" class="form-control" placeholder="Año">
                        </div>
                        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalConsultorio" tabindex="-1" role="dialog" aria-labelledby="modalConsultorioLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formNuevoConsultorio">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo consultorio</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección escrita"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="clinica" class="form-control" placeholder="Clínica/edificio">
                        </div>
                        <div class="form-group">
                            <input type="text" name="info_adicional" class="form-control"
                                placeholder="Información adicional">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalGenerarCalendario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generar calendario presencial</h5>
                </div>
                <div class="modal-body">
                    <form id="form-calendario" action="{{ route('profesional.horarios.presencial.guardar') }}"
                        method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Día</th>
                                        <th>Horarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $dias = [
                                            'Domingo',
                                            'Lunes',
                                            'Martes',
                                            'Miércoles',
                                            'Jueves',
                                            'Viernes',
                                            'Sábado',
                                        ];
                                    @endphp
                                    @foreach ($dias as $index => $dia)
                                        <tr>
                                            <td class="fw-bold">{{ $dia }}</td>
                                            <td>
                                                <div class="horarios-dia" data-dia="{{ $index }}">
                                                    @if ($horarios->has($index))
                                                        @php
                                                            $detallesUnicos = collect();

                                                            foreach ($horarios[$index] as $horario) {
                                                                foreach ($horario->detalles as $detalle) {
                                                                    $key =
                                                                        $detalle->hora_desde .
                                                                        '-' .
                                                                        $detalle->hora_hasta .
                                                                        '-' .
                                                                        $detalle->consultorio_id;
                                                                    $detallesUnicos[$key] = $detalle;
                                                                }
                                                            }

                                                        @endphp

                                                        @foreach ($detallesUnicos as $i => $detalle)
                                                            <div class="row g-2 align-items-center mb-2 horario-item"
                                                                data-id="{{ $detalle->id }}">
                                                                <div class="col-md-3">
                                                                    <input step="30" readonly disabled type="time"
                                                                        name="horarios[{{ $index }}][{{ $loop->index }}][desde]"
                                                                        class="form-control"
                                                                        value="{{ $detalle->hora_desde }}" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input readonly disabled type="time"
                                                                        name="horarios[{{ $index }}][{{ $loop->index }}][hasta]"
                                                                        class="form-control"
                                                                        value="{{ $detalle->hora_hasta }}" required>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select readonly disabled
                                                                        name="horarios[{{ $index }}][{{ $loop->index }}][consultorio_id]"
                                                                        class="form-control" required>
                                                                        <option value="">Consultorio...</option>
                                                                        @foreach ($profesional->consultorios as $consultorio)
                                                                            <option value="{{ $consultorio->id }}"
                                                                                @selected($consultorio->id == $detalle->consultorio_id)>
                                                                                Consultorio {{ $loop->index + 1 }}:
                                                                                {{ $consultorio->direccion }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger remove-horario"
                                                                        data-id="{{ $detalle->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary mt-2 add-horario"
                                                    data-dia="{{ $index }}">
                                                    <i class="fa fa-plus"></i> Añadir horario
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form-calendario">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVerCalendario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Calendario de horarios presenciales</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Calendario -->
                        <div class="col-md-9">
                            <div id="calendarioFullCalendar"></div>
                        </div>
                        <!-- Horarios del día -->
                        <div class="col-md-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios" class="list-group"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGenerarCalendarioVideollamada" tabindex="-1" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generar calendario de videollamadas</h5>
                </div>
                <div class="modal-body">
                    <form id="form-calendario-videollamada" action="{{ route('profesional.horarios.videollamada.guardar') }}"
                        method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Día</th>
                                        <th>Horarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $dias = [
                                            'Domingo',
                                            'Lunes',
                                            'Martes',
                                            'Miércoles',
                                            'Jueves',
                                            'Viernes',
                                            'Sábado',
                                        ];

                                    @endphp
                                    @foreach ($dias as $index => $dia)
                                        <tr>
                                            <td class="fw-bold">{{ $dia }}</td>
                                            <td>
                                                <div class="horarios-dia-videollamada" data-dia="{{ $index }}">
                                                    @php
                                                        $horarios = $horariosVideollamada;   
                                                    @endphp
                                                    @if ($horarios->has($index))
                                                        @php
                                                            $detallesUnicosVideollamada = collect();

                                                            foreach ($horarios[$index] as $horario) {
                                                                foreach ($horario->detalles as $detalle) {
                                                                    $key =
                                                                        $detalle->hora_desde .
                                                                        '-' .
                                                                        $detalle->hora_hasta;
                                                                    $detallesUnicosVideollamada[$key] = $detalle;
                                                                }
                                                            }

                                                        @endphp

                                                        @foreach ($detallesUnicosVideollamada as $i => $detalleVideollamada)                                                            
                                                            <div class="row g-2 align-items-center mb-2 horario-item-videollamada"
                                                                data-id="{{ $detalleVideollamada->id }}">
                                                                <div class="col-md-5">
                                                                    <input step="30" readonly disabled type="time"
                                                                        name="horarios[{{ $index }}][{{ $loop->index }}][desde]"
                                                                        class="form-control"
                                                                        value="{{ $detalleVideollamada->hora_desde }}" required>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input readonly disabled type="time"
                                                                        name="horarios[{{ $index }}][{{ $loop->index }}][hasta]"
                                                                        class="form-control"
                                                                        value="{{ $detalleVideollamada->hora_hasta }}" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger remove-horario-videollamada"
                                                                        data-id="{{ $detalleVideollamada->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary mt-2 add-horario-videollamada"
                                                    data-dia="{{ $index }}">
                                                    <i class="fa fa-plus"></i> Añadir horario
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form-calendario-videollamada">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="modalVerCalendarioVideollamada" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Calendario de horarios de videollamada</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Calendario -->
                        <div class="col-md-9">
                            <div id="calendarioFullCalendarVideollamada"></div>
                        </div>
                        <!-- Horarios del día -->
                        <div class="col-md-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios-videollamada" class="list-group"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
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

            $('#seguros_medicos').select2({
                placeholder: "Seleccione uno o más seguros médicos"
            });

            $('#seguros_medicos').on('select2:select', function(e) {
                let seguro_id = e.params.data.id;

                $.ajax({
                    url: '/profesional/guardar-seguro',
                    method: 'POST',
                    data: {
                        profesional_id: {{ $profesional->id }},
                        seguro_id: seguro_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        console.log('Seguro guardado');
                    },
                    error: function() {
                        alert('Error al guardar seguro médico');
                    }
                });
            });

            // Evento cuando se elimina un seguro
            $('#seguros_medicos').on('select2:unselect', function(e) {
                let seguro_id = e.params.data.id;

                $.ajax({
                    url: '/profesional/eliminar-seguro',
                    method: 'POST',
                    data: {
                        profesional_id: {{ $profesional->id }},
                        seguro_id: seguro_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        console.log('Seguro eliminado');
                    },
                    error: function() {
                        alert('Error al eliminar seguro médico');
                    }
                });
            });

            $('.eliminar-titulo').on('click', function() {
                const id = $(this).data('id');

                if (!confirm('¿Estás seguro de eliminar este título?')) {
                    return;
                }

                $.ajax({
                    url: `/profesional/titulo-universitario/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // asegúrate de tener esto en tu <head>
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#titulo-${id}`).remove();
                            alert(response.message);
                        } else {
                            alert('Error al eliminar el título');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud');
                    }
                });
            });

            $('.eliminar-especializacion').on('click', function() {
                const id = $(this).data('id');

                if (!confirm('¿Estás seguro de eliminar esta especialización?')) return;

                $.ajax({
                    url: `/profesional/especializacion/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#especializacion-${id}`).remove();
                            alert(response.message);
                        } else {
                            alert('Error al eliminar la especialización');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud');
                    }
                });
            });

            $('.eliminar-curso').click(function() {
                const id = $(this).data('id');

                if (!confirm('¿Estás seguro de eliminar este formación adicional?')) return;

                $.ajax({
                    url: `/profesional/formacion-adicional/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.success) {
                            $(`#curso-${id}`).remove();
                            alert(res.message);
                        } else {
                            alert('Error al eliminar la formación');
                        }
                    },
                    error: function() {
                        alert('Error al procesar la solicitud');
                    }
                });
            });

            $('.eliminar-experiencia').click(function() {
                const id = $(this).data('id');
                if (!confirm('¿Estás seguro de eliminar esta experiencia laboral?')) return;

                $.ajax({
                    url: `/profesional/experiencia/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.success) {
                            $(`#experiencia-${id}`).remove();
                            alert(res.message);
                        } else {
                            alert('Error al eliminar la experiencia');
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error al eliminar');
                    }
                });
            });

            $('.eliminar-consultorio').click(function() {
                let id = $(this).data('id');
                if (!confirm('¿Deseas eliminar este consultorio?')) return;

                $.ajax({
                    url: `/profesional/consultorios/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#consultorio-${id}`).remove();
                            alert('Consultorio eliminado correctamente');
                        } else {
                            alert('Error al eliminar el consultorio');
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error al procesar la solicitud');
                    }
                });
            });

            $('#guardar_numero_cuenta').click(function(e) {
                e.preventDefault();
                let numeroCuenta = $('#numero_cuenta').val();

                $.ajax({
                    url: '/profesional/actualizar-numero-cuenta',
                    method: 'POST',
                    data: {
                        profesional_id: {{ $profesional->id }},
                        numero_cuenta: numeroCuenta
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Número de cuenta actualizado correctamente');
                        $('#guardar_numero_cuenta').html(response.mensaje);
                    },
                    error: function() {
                        alert('Hubo un error al actualizar el número de cuenta');
                    }
                });
            });

            $('#editar_datos').click(function() {
                const formData = new FormData();
                formData.append('profesional_id', {{ $profesional->id }});

                const fotoFile = $('#foto')[0].files[0];
                if (fotoFile) {
                    formData.append('foto', fotoFile);
                }

                const fotoLogo = $('#logo')[0].files[0];
                if (fotoLogo) {
                    formData.append('logo', fotoLogo);
                }

                // Agrega los demás campos como antes
                formData.append('nombre_completo', $('#nombre_completo').val());
                formData.append('fecha_nacimiento', $('#fecha_nacimiento').val());
                formData.append('genero', $('#genero').val());
                formData.append('telefono_personal', $('#telefono_personal').val());
                formData.append('telefono_profesional', $('#telefono_profesional').val());
                formData.append('cedula_identidad', $('#cedula_identidad').val());
                formData.append('idiomas', $('#idiomas').val());
                formData.append('descripcion_profesional', $('#descripcion_profesional').val());
                formData.append('anios_experiencia', $('#anios_experiencia').val());
                formData.append('licencia_medica', $('#licencia_medica').val());
                formData.append('ciudad_id', $('#ciudad_id').val());
                formData.append('presencial', $('#aceptas_presencial').val());
                formData.append('videoconsulta', $('#aceptas_videoconsulta').val());

                $.ajax({
                    url: '/profesional/actualizar-datos',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        alert('Datos actualizados correctamente.');
                        window.location.reload();
                    },
                    error: function() {
                        alert('Error al actualizar los datos.');
                    }
                });
            });

            $('#btn_actualizar_contrasena').click(function() {
                let pass1 = $('#nueva_contrasena').val();
                let pass2 = $('#repetir_contrasena').val();

                if (!pass1 || !pass2) {
                    alert('Completa ambos campos de contraseña.');
                    return;
                }

                if (pass1 !== pass2) {
                    alert('Las contraseñas no coinciden.');
                    return;
                }

                $.ajax({
                    url: '{{ route('profesional.actualizarContrasena') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        password: pass1
                    },
                    success: function(response) {
                        alert('Contraseña actualizada correctamente');
                        $('#nueva_contrasena, #repetir_contrasena').val('');
                    },
                    error: function(xhr) {
                        alert('Ocurrió un error al actualizar la contraseña.');
                    }
                });
            });

            $('#formNuevoTitulo').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('profesional.titulos.guardar') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Título añadido correctamente")
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al guardar título');
                    }
                });
            });

            $('#formNuevaEspecializacion').submit(function(e) {
                e.preventDefault();
                console.log($(this).serialize());

                $.ajax({
                    url: '{{ route('profesional.especializaciones.guardar') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Especialización añadida correctamente")
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al guardar especialización');
                    }
                });
            });

            $('#formFormacionesAdicionales').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('profesional.formaciones-adicionales.guardar') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Formación Adicional añadida correctamente")
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al guardar especialización');
                    }
                });
            });

            $('#formNuevaExperiencia').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('profesional.experiencias.guardar') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Experiencia laboral añadida correctamente")
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al guardar experiencia');
                    }
                });
            });

            $('#formNuevoConsultorio').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('profesional.consultorios.guardar') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Consultorio añadido correctamente")
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error al guardar consultorio');
                    }
                });
            });

            const selectedRegionId = "{{ old('region_id', $region_id ?? '') }}";
            const selectedProvinciaId = "{{ old('provincia_id', $provincia_id ?? '') }}";
            const selectedCiudadId = "{{ old('ciudad_id', $ciudad_id ?? '') }}";

            // Función para cargar provincias
            function cargarProvincias(regionId, callback) {
                if (!regionId) return;

                $.get(`/get-provincias/${regionId}`, function(data) {
                    $('#provincia_id').empty().append(
                        '<option value="">-- Seleccione la provincia --</option>');
                    $.each(data, function(i, provincia) {
                        const selected = provincia.id == selectedProvinciaId ? 'selected' : '';
                        $('#provincia_id').append(
                            `<option value="${provincia.id}" ${selected}>${provincia.nombre}</option>`
                        );
                    });

                    if (callback) callback();
                });
            }

            // Función para cargar ciudades
            function cargarCiudades(provinciaId) {
                if (!provinciaId) return;

                $.get(`/get-ciudades/${provinciaId}`, function(data) {
                    $('#ciudad_id').empty().append('<option value="">-- Seleccione la ciudad --</option>');
                    $.each(data, function(i, ciudad) {
                        const selected = ciudad.id == selectedCiudadId ? 'selected' : '';
                        $('#ciudad_id').append(
                            `<option value="${ciudad.id}" ${selected}>${ciudad.nombre}</option>`
                        );
                    });
                });
            }

            // Al cambiar región
            $('#region_id').on('change', function() {
                const regionId = $(this).val();
                $('#provincia_id').empty();
                $('#ciudad_id').empty();
                cargarProvincias(regionId);
            });

            // Al cambiar provincia
            $('#provincia_id').on('change', function() {
                const provinciaId = $(this).val();
                $('#ciudad_id').empty();
                cargarCiudades(provinciaId);
            });

            // Precargar si hay valores guardados
            if (selectedRegionId) {
                cargarProvincias(selectedRegionId, function() {
                    if (selectedProvinciaId) {
                        cargarCiudades(selectedProvinciaId);
                    }
                });
            }


        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.add-horario').forEach(button => {
                button.addEventListener('click', function() {
                    const dia = this.dataset.dia;
                    const container = document.querySelector(`.horarios-dia[data-dia="${dia}"]`);
                    const index = container.querySelectorAll('.row').length;

                    const html = `
            <div class="row g-2 align-items-center mb-2 horario-item">
              <div class="col-md-3">
                <input type="time" name="horarios[${dia}][${index}][desde]" class="form-control" required>
              </div>
              <div class="col-md-3">
                <input type="time" name="horarios[${dia}][${index}][hasta]" class="form-control" required>
              </div>
              <div class="col-md-4">
                <select name="horarios[${dia}][${index}][consultorio_id]" class="form-control" required>
                  <option value="">Consultorio...</option>
                  @foreach ($profesional->consultorios as $consultorio)
                    <option value="{{ $consultorio->id }}">{{ $consultorio->direccion }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger remove-horario"><i class="fa fa-trash"></i></button>
              </div>
            </div>
          `;

                    container.insertAdjacentHTML('beforeend', html);
                });
            });

            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.remove-horario')) {
                    e.target.closest('.horario-item').remove();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.add-horario-videollamada').forEach(button => {
               
                button.addEventListener('click', function() {
                    
                    const dia = this.dataset.dia;
                    const container = document.querySelector(`.horarios-dia-videollamada[data-dia="${dia}"]`);
                    const index = container.querySelectorAll('.row').length;

                    const html = `
            <div class="row g-2 align-items-center mb-2 horario-item-videollamada">
              <div class="col-md-5">
                <input type="time" name="horarios[${dia}][${index}][desde]" class="form-control" required>
              </div>
              <div class="col-md-5">
                <input type="time" name="horarios[${dia}][${index}][hasta]" class="form-control" required>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger remove-horario-videollamada"><i class="fa fa-trash"></i></button>
              </div>
            </div>
          `;

                container.insertAdjacentHTML('beforeend', html);
                });
            });

            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.remove-horario-videollamada')) {
                    e.target.closest('.horario-item-videollamada').remove();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendarioFullCalendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/profesional/horarios',
                        method: 'GET',
                        success: function(data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function(info) {
                    $.ajax({
                        url: '/api/profesional/horarios/' + info.dateStr,
                        method: 'GET',
                        success: function(response) {

                            console.log(response);

                            let lista = $('#lista-horarios');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append(
                                    '<li class="list-group-item text-muted">Sin horarios</li>'
                                );
                            } else {
                                response.forEach((horario, index) => {
                                    const turnos = generarTurnos(horario.desde,
                                        horario.hasta);

                                    let turnosHtml = turnos.map(t => `
                                    <button data-id="${t.id}" class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                    lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <small>${horario.consultorio}</small>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                                });
                            }
                        }
                    });
                }
            });

            $('#modalVerCalendario').on('shown.bs.modal', function() {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios').on('click', '.btn-turno', function() {
                $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
                $(this).removeClass('btn-outline-success').addClass('btn-success');
            });
        });
    </script>

    <script>
        document.body.addEventListener('click', function(e) {
            const button = e.target.closest('.remove-horario');

            if (button) {
                const detalleId = button.dataset.id;

                // Si es nuevo (aún sin guardar), lo elimina directamente del DOM
                if (!detalleId) {
                    button.closest('.horario-item').remove();
                    return;
                }

                if (confirm('¿Deseas eliminar este horario definitivamente?')) {
                    fetch(`/profesional/detalle-horarios/${detalleId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                button.closest('.horario-item').remove();
                                window.location.reload();
                            } else {
                                alert('No se pudo eliminar el horario.');
                            }
                        })
                        .catch(() => alert('Error al comunicarse con el servidor.'));
                }
            }
        });
    </script>

    <script>
        let consultorioId = null;

        $('.cargarImagenes').on('click', function() {
            consultorioId = $(this).data('id');
            $('#consultorioIdInput').val(consultorioId);
            $('#modalCargarImagenes').modal('show');
        });

        $('#formCargarImagenes').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: `/profesional/consultorio/${consultorioId}/imagenes`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Imágenes cargadas correctamente');
                    $('#modalCargarImagenes').modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Error al subir imágenes');
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.eliminar-imagen', function() {
            const id = $(this).data('id');
            const path = $(this).data('path');
            const url = `/profesional/consultorio/imagen/${id}`;

            if (!confirm('¿Estás seguro de eliminar esta imagen?')) return;

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    path: path
                },
                success: function() {
                    $('#imagen-' + id).fadeOut(300, function() {
                        $(this).remove();
                    });
                },
                error: function() {
                    alert('No se pudo eliminar la imagen.');
                }
            });
        });
    </script>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendarioFullCalendarVideollamada');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/profesional/horarios-videollamada',
                        method: 'GET',
                        success: function(data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function(info) {
                    $.ajax({
                        url: '/api/profesional/horarios-videollamada/' + info.dateStr,
                        method: 'GET',
                        success: function(response) {

                            console.log(response);

                            let lista = $('#lista-horarios-videollamada');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append(
                                    '<li class="list-group-item text-muted">Sin horarios</li>'
                                );
                            } else {
                                response.forEach((horario, index) => {
                                    const turnos = generarTurnos(horario.desde,
                                        horario.hasta);

                                    let turnosHtml = turnos.map(t => `
                                    <button data-id="${t.id}" class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                    lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                                });
                            }
                        }
                    });
                }
            });

            $('#modalVerCalendarioVideollamada').on('shown.bs.modal', function() {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios-videollamada').on('click', '.btn-turno', function() {
                $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
                $(this).removeClass('btn-outline-success').addClass('btn-success');
            });
        });
    </script>

<script>
        document.body.addEventListener('click', function(e) {
            const button = e.target.closest('.remove-horario-videollamada');

            if (button) {
                const detalleId = button.dataset.id;

                // Si es nuevo (aún sin guardar), lo elimina directamente del DOM
                if (!detalleId) {
                    button.closest('.horario-item-videollamada').remove();
                    return;
                }

                if (confirm('¿Deseas eliminar este horario de videollamada definitivamente?')) {
                    fetch(`/profesional/detalle-horarios-videollamada/${detalleId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                button.closest('.horario-item-videollamada').remove();
                                window.location.reload();
                            } else {
                                alert('No se pudo eliminar el horario.');
                            }
                        })
                        .catch(() => alert('Error al comunicarse con el servidor.'));
                }
            }
        });
    </script>
@endsection
