@extends('adminlte::page')

@section('title', 'Datos personales')

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
    </style>
@endsection


@section('content_header')
    <div class="row align-items-center mb-3">
        <div class="col-lg-12">
            <h1>Datos personales</h1>
        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form enctype="multipart/form-data" method="POST" action="{{ route('profesionales.updatePacientes', $paciente->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="float-right">
                    <div class="float-right">
                        <button id="editarDatos" type="button" class="btn btn-primary mr-2">Editar datos</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2 col-lg-2">
                @if ($paciente->foto)
                    <label for="">Foto de Perfil</label>
                    <img src="{{ asset($paciente->foto) }}" alt="Foto Perfil"
                        class="img img-responsive img-fluid profile-image">
                @endif
            </div>
        </div>

        <div class="border p-4 mb-2">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input name="foto" disabled type="file" value="{{ $paciente->foto }}" class="form-control"
                        placeholder="Foto">
                </div>
                <div class="col-md-6 mb-2">
                    <input name="nombre_completo" disabled type="text" value="{{ $paciente->user->name }}"
                        class="form-control" placeholder="Nombre completo">
                </div>
                <div class="col-md-6 mb-2">
                    <input name="fecha_nacimiento" disabled type="date" value="{{ $paciente->fecha_nacimiento }}"
                        class="form-control" placeholder="Fecha de nacimiento">
                </div>
                <div class="col-md-6 mb-2">
                    <select name="genero" disabled name="genero" id="genero" class="form-control form-select">
                        <option value="">Seleccione su género</option>
                        <option value="Masculino" {{ $paciente->genero == 'Masculino' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="Femenino" {{ $paciente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ $paciente->genero == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <select disabled id="estado_civil" name="estado_civil"
                        class="form-control @error('estado_civil') is-invalid @enderror" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Soltero" {{ $paciente->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero
                        </option>
                        <option value="Casado" {{ $paciente->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                        <option value="Unión libre" {{ $paciente->estado_civil == 'Unión libre' ? 'selected' : '' }}>Unión
                            libre</option>
                        <option value="Pareja de hecho"
                            {{ $paciente->estado_civil == 'Pareja de hecho' ? 'selected' : '' }}>Pareja de hecho</option>
                        <option value="Viudo" {{ $paciente->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                        <option value="Divorciado" {{ $paciente->estado_civil == 'Divorciado' ? 'selected' : '' }}>
                            Divorciado</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <input name="nacionalidad" disabled type="text" value="{{ $paciente->nacionalidad }}"
                        class="form-control" placeholder="Nacionalidad">
                </div>
                <div class="col-md-6 mb-2">
                    <input name="celular" disabled type="text" value="{{ $paciente->celular }}" class="form-control"
                        placeholder="Celular">
                </div>
                <div class="col-md-6 mb-2">
                    <input disabled type="text"value="{{ $paciente->user->email }}" class="form-control"
                        placeholder="Email">
                </div>
                <div class="col-md-6 mb-2">
                    <input name="direccion" disabled type="text" value="{{ $paciente->direccion }}" class="form-control"
                        placeholder="Dirección de residencia">
                </div>
                <div class="col-md-6 mb-2">
                    <select name="ciudad_id" disabled class="form-control form-select" id="ciudad_id">
                        <option value="">Seleccione una ciudad</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}" {{ ($paciente->ciudad_id == $ciudad->id) ? 'selected' : '' }}>
                                {{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <input name="cedula" disabled type="text" value="{{ $paciente->cedula }}" class="form-control"
                        placeholder="Cédula">
                </div>
                @php
                    $grupo = substr($paciente->grupo_sanguineo, 0, -1); // Ej. "A"
                    $rh = substr($paciente->grupo_sanguineo, -1); // Ej. "+"
                @endphp
                <div class="col-md-3 mb-2">
                    <select disabled class="form-control" name="grupo" id="grupo">
                        <option value="A" {{ $grupo == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $grupo == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $grupo == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $grupo == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select disabled class="form-control" name="rh" id="rh">
                        <option value="+" {{ $rh == '+' ? 'selected' : '' }}>+</option>
                        <option value="-" {{ $rh == '-' ? 'selected' : '' }}>-</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button id="guardarDatos" type="submit" class="btn btn-dark mr-2" disabled>Guardar
                        cambios</button>
                </div>
            </div>
        </div>
        <div class="border p-4 mb-2">
            <div class="row align-items-center mb-3">
                <div class="col-lg-6">
                    <h5>Antecedentes patológicos personales</h5>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">
                        <button disabled type="button" id="anyadirAntecedente" class="btn btn-dark mr-2"><i
                                class="fa fa-plus"></i>
                            Añadir</button>
                    </div>
                </div>
            </div>

            @foreach ($paciente->antecedentes as $antecedente)
                <div class="row mt-2 border p-2">
                    <div class="col-md-3 mb-2">
                        <input disabled type="text" class="form-control" placeholder="Alergias"
                            value="{{ $antecedente->alergias }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input disabled type="text" class="form-control"
                            placeholder="Condiciones médicas preexistentes"
                            value="{{ $antecedente->condiciones_medicas }}">
                    </div>
                    <div class="col-md-3">
                        <input disabled type="text" class="form-control"
                            placeholder="Medicamentos que consume habitualmente"
                            value="{{ $antecedente->medicamentos }}">
                    </div>
                    <div class="col-md-3">
                        <button disabled data-id="{{ $antecedente->id }}"
                            class="btn btn-danger w-100 btn-eliminarAntecedente"><i class="fa fa-trash"></i>
                            Eliminar</button>
                    </div>
                </div>
            @endforeach

            <div id="antecedentesNuevos"></div>
        </div>

        <div class="border p-4 mb-2">
            <div class="row mt-1">
                <div class="col-lg-12">
                    <h5>Seguro de Salud</h5>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <select disabled class="form-control form-select" name="seguros_medicos[]" id="seguros_medicos" multiple>
                    @foreach ($seguros as $seguro)
                        <option value="{{ $seguro->id }}" @if ($paciente->segurosMedicos->contains('id', $seguro->id)) selected @endif>
                            {{ $seguro->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="border p-4 mb-2">
            <div class="row align-items-center mb-3">
                <div class="col-lg-6">
                    <h5>Datos de emergencia</h5>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">
                        <button type="button" id="anyadirContactoEmergencia" class="btn btn-dark mr-2">
                            <i class="fa fa-plus"></i> Añadir
                        </button>
                    </div>
                </div>
            </div>

            @foreach ($paciente->contactos_emergencia as $contacto)
                <div class="row mt-2 border p-2">
                    <div class="col-md-3 mb-2">
                        <input disabled type="text" class="form-control" placeholder="Nombre"
                            value="{{ $contacto->nombre }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input disabled type="text" class="form-control" placeholder="Relación"
                            value="{{ $contacto->relacion }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input disabled type="text" class="form-control" placeholder="Teléfono"
                            value="{{ $contacto->telefono }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <button disabled data-id="{{ $contacto->id }}"
                            class="btn btn-danger w-100 btn-eliminarContacto"><i class="fa fa-trash"></i>
                            Eliminar</button>
                    </div>
                </div>
            @endforeach

            <div id="contactosEmergenciaNuevos"></div>
        </div>


        <div style="display: none" class="border p-4 mb-2">
            <div class="row mt-1">
                <div class="col-lg-12">
                    <h5>Documentos</h5>
                </div>
                <div class="col-md-12 mb-2">
                    <input disabled type="text" class="form-control"
                        placeholder="Subir cédula, pasaporte o documento equivalente">
                </div>
            </div>
        </div>

        <div class="border p-4 mb-2">
            <div class="row mt-1">
                <div class="col-lg-12">
                    <h5>Datos acceso a ProSalud</h5>
                </div>
                <div class="col-md-4 mb-2">
                    <input disabled type="text" value="{{ $paciente->user->email }}" class="form-control"
                        placeholder="Usuario" readonly>
                </div>
                <div class="col-md-4 mb-2">
                    <input name="password" disabled type="text" class="form-control"
                        placeholder="Contraseña ***********">
                </div>
                <div class="col-md-4 mb-2">
                    <input name="repetir_password" disabled type="text" class="form-control"
                        placeholder="Cambiar contraseña">
                </div>
            </div>
        </div>

        <div class="border p-4 mb-2">
            <div class="row mt-1">
                <div class="col-lg-12">
                    <h5>Darme de baja</h5>
                </div>
                <div class="col-md-12">
                    <button id="btnEliminarCuenta" class="btn btn-danger">Eliminar cuenta</button>
                </div>
                <div class="col-md-12">
                    <div id="mensajeEliminacion" class="mt-3 text-success" style="display: none;"></div>
                </div>
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


        document.getElementById('editarDatos').addEventListener('click', function() {
            // Habilitar todos los inputs y selects
            document.querySelectorAll('input, select, textarea').forEach(function(el) {
                el.removeAttribute('disabled');
            });
            // Habilitar botón de guardar
            document.getElementById('guardarDatos').removeAttribute('disabled');
            let botonesEliminar = document.getElementsByClassName('btn-eliminarAntecedente');
            for (let i = 0; i < botonesEliminar.length; i++) {
                botonesEliminar[i].removeAttribute('disabled');
            }

            // Habilitar botón añadir antecedente
            document.getElementById('anyadirAntecedente').removeAttribute('disabled');

            // Habilitar botón añadir contactos emergencia
            document.getElementById('anyadirContactoEmergencia').removeAttribute('disabled');

            // Habilitar botones eliminar contactos emergencia
            let botonesEliminarContactos = document.getElementsByClassName('btn-eliminarContacto');
            for (let btn of botonesEliminarContactos) {
                btn.removeAttribute('disabled');
            }
        });

        let antecedenteIndex = {{ count($paciente->antecedentes) }};

        document.getElementById('anyadirAntecedente').addEventListener('click', function() {
            const container = document.getElementById('antecedentesNuevos');

            const row = document.createElement('div');
            row.classList.add('row', 'mt-2', 'border', 'p-2');

            row.innerHTML = `
        <div class="col-md-3 mb-2">
            <input type="text" name="antecedentes[${antecedenteIndex}][alergias]" class="form-control" placeholder="Alergias">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" name="antecedentes[${antecedenteIndex}][condiciones_medicas]" class="form-control" placeholder="Condiciones médicas preexistentes">
        </div>
        <div class="col-md-3">
            <input type="text" name="antecedentes[${antecedenteIndex}][medicamentos]" class="form-control" placeholder="Medicamentos que consume habitualmente">
        </div>
    `;
            container.appendChild(row);
            antecedenteIndex++;
        });

        $(document).on('click', '.btn-eliminarAntecedente', function(e) {
            e.preventDefault();

            if (!confirm('¿Seguro que quieres eliminar este antecedente?')) {
                return;
            }

            let button = $(this);
            let antecedenteId = button.data('id');

            // Opción A: Eliminar del DOM (interfaz) inmediatamente:
            button.closest('.row').remove();

            // Opción B: Hacer petición AJAX para eliminar en base de datos
            $.ajax({
                url: '/paciente/antecedentes/' + antecedenteId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // token CSRF de Laravel
                },
                success: function(response) {
                    alert('Antecedente eliminado correctamente');
                },
                error: function(xhr) {
                    alert('Error al eliminar antecedente');
                    // Si quieres, recarga o vuelve a mostrar la fila
                }
            });
        });


        let contactoEmergenciaIndex =
            {{ count($paciente->contactos_emergencia) }};; // contador global para contactos nuevos

        document.getElementById('anyadirContactoEmergencia').addEventListener('click', function() {
            const container = document.getElementById('contactosEmergenciaNuevos');

            const row = document.createElement('div');
            row.classList.add('row', 'mt-2', 'border', 'p-2');

            row.innerHTML = `
        <div class="col-md-4 mb-2">
            <input type="text" name="contactos_emergencia[${contactoEmergenciaIndex}][nombre]" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" name="contactos_emergencia[${contactoEmergenciaIndex}][relacion]" class="form-control" placeholder="Relación">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" name="contactos_emergencia[${contactoEmergenciaIndex}][telefono]" class="form-control" placeholder="Teléfono">
        </div>
        <div class="col-md-1 mb-2">
            <button type="button" class="btn btn-danger btn-eliminarContactoEmergencia w-100">Eliminar</button>
        </div>
    `;

            container.appendChild(row);
            contactoEmergenciaIndex++; // incrementar índice
        });


        $(document).on('click', '.btn-eliminarContacto', function(e) {
            e.preventDefault();

            if (!confirm('¿Seguro que quieres eliminar este contacto?')) {
                return;
            }

            let button = $(this);
            let contactoId = button.data('id');

            button.closest('.row').remove();

            $.ajax({
                url: '/paciente/contactos/' + contactoId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // token CSRF de Laravel
                },
                success: function(response) {
                    alert('Contacto eliminado correctamente');
                },
                error: function(xhr) {
                    alert('Error al eliminar antecedente');
                }
            });
        });
    </script>

    <script>
        $('#btnEliminarCuenta').click(function(e) {
            e.preventDefault();

            if (!confirm('¿Estás seguro de que deseas eliminar tu cuenta?')) {
                return;
            }

            $.ajax({
                url: "{{ route('usuario.eliminarCuenta') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#mensajeEliminacion').text(response.message).show();

                    // Redirigir o cerrar sesión luego de un tiempo
                    setTimeout(function() {
                        window.location.href = '/pacientes/login';
                    }, 2000);
                },
                error: function(xhr) {
                    alert('Ocurrió un error al eliminar la cuenta.');
                }
            });
        });
    </script>


@endsection
