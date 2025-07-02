@extends('adminlte::page')

@section('title', 'Mis Datos')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <style>
        /* Personalizar Select2 para seguros médicos */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
            border: 1px solid #007bff !important;
            color: white !important;
            border-radius: 4px;
            padding: 0 8px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #f8f9fa !important;
        }

        /* Personalizar el dropdown */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
            color: white !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #e3f2fd !important;
            color: #007bff !important;
        }

        /* Personalizar el contenedor principal */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Estilos para previsualización de imágenes */
        .image-preview {
            margin-top: 10px;
            display: none;
        }

        .image-preview img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        .remove-preview {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
        }

        .preview-container {
            position: relative;
            display: inline-block;
        }

        /* Estilos para botones de eliminar imagen */
        .btn-eliminar-imagen {
            font-size: 12px;
            padding: 2px 6px;
        }

        /* Estilos para alertas de eliminación */
        .alert-eliminacion {
            padding: 8px 12px;
            margin-top: 8px;
            font-size: 12px;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content_header')
    <div class="row">
        <div class="col-lg-6 d-flex align-items-center">
            <h1>Datos personales propietario</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-end align-items-center">
            <button id="btnEditar" class="btn btn-outline-secondary">Editar datos</button>
            <button id="btnGuardar" class="btn btn-primary ml-2" style="display: none;">Guardar cambios</button>
            <button id="btnCancelar" class="btn btn-secondary ml-2" style="display: none;">Cancelar</button>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form id="formMisDatos" action="{{ route('proveedores.guardarMisDatos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <p>
                    Estos datos solo serán para uso de la plataforma, para validar información o por si tuviésemos que
                    contactar contigo.
                </p>
            </div>
        </div>

        <div class="row border p-2">
            <div class="col-md-6 mb-2">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-input"
                    placeholder="Seleccione fecha de nacimiento" value="{{ $proveedor->propietario->fecha_nacimiento ?? '' }}" disabled>
            </div>
            <div class="col-md-6 mb-2">
                <label for="genero" class="form-label">Género</label>
                <select name="genero" id="genero" class="form-control form-select form-input" disabled>
                    <option value="">Seleccione su género</option>
                    <option value="Hombre" {{ ($proveedor->propietario->genero ?? '') == 'Hombre' ? 'selected' : '' }}>
                        Hombre</option>
                    <option value="Mujer" {{ ($proveedor->propietario->genero ?? '') == 'Mujer' ? 'selected' : '' }}>Mujer
                    </option>
                    <option value="Otro" {{ ($proveedor->propietario->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro
                    </option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label for="telefono_personal" class="form-label">Teléfono personal</label>
                <input type="text" name="telefono_personal" id="telefono_personal" class="form-control form-input"
                    placeholder="Ingrese teléfono personal" value="{{ $proveedor->propietario->telefono_personal ?? '' }}" disabled>
            </div>
            <div class="col-md-4 mb-2">
                <label for="cedula_identidad" class="form-label">Cédula de identidad</label>
                <input type="text" name="cedula_identidad" id="cedula_identidad" class="form-control form-input"
                    placeholder="Ingrese cédula de identidad" value="{{ $proveedor->propietario->cedula_identidad ?? '' }}" disabled>
            </div>
            <div class="col-md-4 mb-2">
                <label for="telefono_profesional" class="form-label">Teléfono profesional</label>
                <input type="text" name="telefono_profesional" id="telefono_profesional" class="form-control form-input"
                    placeholder="Ingrese teléfono profesional" value="{{ $proveedor->propietario->telefono_profesional ?? '' }}" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="email_propietario" class="form-label">Email</label>
                <input type="email" name="email" id="email_propietario" class="form-control form-input"
                    placeholder="Ingrese email del propietario" value="{{ $proveedor->propietario->email ?? '' }}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <h5>Datos clínica/centro</h5>
            </div>
        </div>

        <div class="row mt-2 border p-2">
            <div class="col-lg-12">
                <h6>Clínica/centro 1</h6>
            </div>
            <div class="col-md-12 mb-2">
                <label for="nombre" class="form-label">Nombre clínica/centro <span class="text-danger">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control form-input"
                    placeholder="Ingrese nombre de la clínica/centro" value="{{ $proveedor->nombre ?? '' }}" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="ciudad" class="form-label">Ciudad <span class="text-danger">*</span></label>
                <input type="text" name="ciudad" id="ciudad" class="form-control form-input"
                    placeholder="Ingrese la ciudad" value="{{ $proveedor->ciudad ?? '' }}" disabled>
            </div>
            <div class="col-md-6 mb-2">
                <label for="numero_identificacion" class="form-label">Número RUC <span class="text-danger">*</span></label>
                <input type="text" name="numero_identificacion" id="numero_identificacion"
                    class="form-control form-input" placeholder="Ingrese número RUC" value="{{ $proveedor->numero_identificacion ?? '' }}" disabled>
            </div>
            <div class="col-md-6 mb-2">
                <label for="especializacion" class="form-label">Especialización</label>
                <input type="text" name="especializacion" id="especializacion" class="form-control form-input"
                    placeholder="Ingrese especialización" value="{{ $proveedor->especializacion ?? '' }}" disabled>
            </div>

            <div class="col-md-6 mb-2">
                <label for="direccion" class="form-label">Dirección escrita <span class="text-danger">*</span></label>
                <input type="text" name="direccion" id="direccion" class="form-control form-input"
                    placeholder="Ingrese dirección completa" value="{{ $proveedor->direccion ?? '' }}" disabled>
            </div>
            <div class="col-md-6 mb-2">
                <label for="direccion_maps" class="form-label">Dirección en Google Maps</label>
                <input type="text" name="direccion_maps" id="direccion_maps" class="form-control form-input"
                    placeholder="Ingrese dirección de Google Maps" value="{{ $proveedor->direccion_maps ?? '' }}" disabled>
            </div>
            <div class="col-md-4 mb-2">
                <label for="imagenes" class="form-label">Imágenes</label>
                <input type="file" name="imagenes" id="imagenes" class="form-control-file form-input"
                    accept="image/*" disabled>
                @if($proveedor->imagenes)
                    <div class="mt-2" id="current-imagenes">
                        <img src="{{ asset($proveedor->imagenes) }}" alt="Imagen actual" style="max-width: 100px; max-height: 100px;">
                        <p class="text-muted small">Imagen actual</p>
                        <button type="button" class="btn btn-danger btn-sm btn-eliminar-imagen mt-1" id="btn-eliminar-imagenes" onclick="eliminarImagenActual('imagenes')" disabled>
                            <i class="fa fa-trash"></i> Eliminar imagen
                        </button>
                    </div>
                @endif
                <div id="preview-imagenes" class="image-preview"></div>
            </div>
            <div class="col-md-4 mb-2">
                <label for="imagen_corporativa" class="form-label">Imagen corporativa/logo</label>
                <input type="file" name="imagen_corporativa" id="imagen_corporativa" class="form-control-file form-input"
                    accept="image/*" disabled>
                @if($proveedor->imagen_corporativa)
                    <div class="mt-2" id="current-imagen-corporativa">
                        <img src="{{ asset($proveedor->imagen_corporativa) }}" alt="Logo actual" style="max-width: 100px; max-height: 100px;">
                        <p class="text-muted small">Logo actual</p>
                        <button type="button" class="btn btn-danger btn-sm btn-eliminar-imagen mt-1" id="btn-eliminar-imagen-corporativa" onclick="eliminarImagenActual('imagen_corporativa')" disabled>
                            <i class="fa fa-trash"></i> Eliminar logo
                        </button>
                    </div>
                @endif
                <div id="preview-imagen-corporativa" class="image-preview"></div>
            </div>
            <div class="col-md-4 mb-2">
                <label for="clinica_edificio" class="form-label">Clínica/edificio</label>
                <input type="text" name="clinica_edificio" id="clinica_edificio" class="form-control form-input"
                    placeholder="Nombre del edificio/clínica" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="informacion_adicional" class="form-label">Información adicional</label>
                <input type="text" name="informacion_adicional" id="informacion_adicional"
                    class="form-control form-input" placeholder="Información adicional relevante" value="{{ $proveedor->informacion_adicional ?? '' }}" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="listado_servicios" class="form-label">Listado de servicios</label>
                <input type="text" name="listado_servicios" id="listado_servicios" class="form-control form-input"
                    placeholder="Servicios que ofrece la clínica/centro" value="{{ $proveedor->listado_servicios ?? '' }}" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="telefono" class="form-label">Teléfono del centro <span class="text-danger">*</span></label>
                <input type="text" name="telefono" id="telefono" class="form-control form-input"
                    placeholder="Ingrese teléfono del centro" value="{{ $proveedor->telefono ?? '' }}" disabled>
            </div>
            <div class="col-md-12 mb-2">
                <label for="email_centro" class="form-label">Email del centro <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email_centro" class="form-control form-input"
                    placeholder="Ingrese email del centro" value="{{ $proveedor->propietario->email ?? ($proveedor->email ?? '') }}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <h5>Seguros</h5>
            </div>
        </div>

        <div class="row mt-1 border p-2">
            <div class="col-md-12 mb-2">
                <label for="seguros_medicos">Seguros Médicos</label>
                <select class="form-control form-select form-input" name="seguros_medicos[]" id="seguros_medicos" multiple disabled>
                    <option value="-1">-- Sin seguro --</option>
                    @foreach ($seguros as $seguro)
                        <option value="{{ $seguro->id }}" @if ($proveedor->segurosMedicos->contains('id', $seguro->id)) selected @endif>
                            {{ $seguro->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <h5>Horario de atención</h5>
            </div>
        </div>
        <div class="row mt-2 border p-2">
            <div class="col-md-12">
                <label for="horarios" class="form-label">Horarios de atención</label>
                <input type="text" name="horarios" id="horarios" class="form-control form-input"
                    placeholder="Ej: Lunes a Viernes 8:00 - 17:00" value="{{ $proveedor->horarios ?? '' }}" disabled>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-between align-items-center">
            <div class="col-lg-10">
                <h5>Validación profesional</h5>
            </div>
            <div class="col-lg-2 text-right">
                <button class="btn btn-dark" data-toggle="modal" data-target="#modalDocumento" disabled>
                    <i class="fa fa-plus"></i> Añadir documento
                </button>
            </div>
        </div>

        <div class="row mt-2 border p-2">
            <div class="col-md-12 mb-2">
                <h6 class="mb-3">Documentación requerida</h6>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Certificado del SRI con el RUC</h6>
                        <p class="card-text text-muted">
                            Documento obligatorio que certifica el registro único de contribuyentes ante el SRI.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Licencia del centro</h6>
                        <p class="card-text text-muted">
                            Licencia de funcionamiento del centro médico o clínica.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 border p-3 bg-light">
            @php
                $documentosPorTipo = $proveedor->documentos;
            @endphp

            {{-- Documentación --}}
            <div class="col-md-12 mb-3">
                <h6 class="mb-3">
                    <i class="fa fa-folder-open text-primary"></i>
                    <strong>Documentos subidos</strong>
                </h6>
                <div class="row">
                    @if($documentosPorTipo->count() > 0)
                        @foreach ($documentosPorTipo as $doc)
                            <div class="col-lg-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3">
                                                <label class="text-muted mb-1">Nombre del Documento</label>
                                                <input type="text" value="{{ $doc->nombre }}" class="form-control" readonly>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="text-muted mb-1">Archivo</label>
                                                <a href="{{ asset($doc->archivo) }}" target="_blank" class="btn btn-outline-primary btn-block">
                                                    <i class="fa fa-file"></i> Ver documento
                                                </a>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="text-muted mb-1">Estado</label>
                                                <div class="mt-2">
                                                    <span class="badge badge-{{ $doc->estado == 'aprobado' ? 'success' : ($doc->estado == 'rechazado' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($doc->estado ?? 'pendiente') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="text-muted mb-1">Tipo</label>
                                                <div class="mt-2">
                                                    {{ ucfirst($doc->tipo) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="text-muted mb-1">Acciones</label>
                                                @if(isset($doc->id))
                                                    <button type="button" class="btn btn-danger btn-block" onclick="eliminarDocumento({{ $doc->id }})">
                                                        <i class="fa fa-trash"></i> Eliminar
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info border-0">
                                <div class="text-center py-3">
                                    <i class="fa fa-info-circle fa-2x text-info mb-3"></i>
                                    <h6>No hay documentos subidos</h6>
                                    <p class="mb-0">Use el botón <strong>"Añadir documento"</strong> para subir sus certificados y licencias requeridas.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <h5>Usuarios de gestión</h5>
            </div>
        </div>
        <div class="row mt-2 border p-2">
            <div class="col-md-6">
                <label for="usuario_gestion" class="form-label">Usuario de gestión</label>
                <input type="text" name="usuario_gestion" id="usuario_gestion" class="form-control form-input"
                    placeholder="Ingrese nombre de usuario" disabled>
            </div>
            <div class="col-md-6">
                <label for="password_gestion" class="form-label">Contraseña</label>
                <input type="password" name="password_gestion" id="password_gestion" class="form-control form-input"
                    placeholder="Ingrese contraseña" disabled>
            </div>
        </div>

        <div class="row mt-2 border p-2">
            <div class="col-lg-12 w-100">
                <a href="#" class="btn btn-dark w-100" id="btnAgregarUsuario">Añadir nuevo usuario de
                    administración</a>
            </div>
        </div>
    </form>

        <div class="modal fade" id="modalDocumento" tabindex="-1" role="dialog" aria-labelledby="modalDocumentoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('proveedores.guardarDocumento', $proveedor->id) }}" method="POST"
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


@stop

@section('js')
    <script>
        $(document).ready(function() {
            let originalValues = {};

            // Función para guardar los valores originales
            function saveOriginalValues() {
                originalValues = {};
                $('.form-input').each(function() {
                    let name = $(this).attr('name');
                    if (name && $(this).attr('type') !== 'file') {
                        originalValues[name] = $(this).val();
                    }
                });

                // Guardar valores del select de seguros médicos
                originalValues['seguros_medicos'] = $('#seguros_medicos').val() || [];
            }

            // Función para restaurar los valores originales
            function restoreOriginalValues() {
                for (let name in originalValues) {
                    if (name === 'seguros_medicos') {
                        $('#seguros_medicos').val(originalValues[name]).trigger('change');
                    } else if (name !== 'imagenes' && name !== 'imagen_corporativa') {
                        $(`[name="${name}"]`).val(originalValues[name]);
                    }
                }

                // Limpiar los inputs de archivo y sus previsualizaciones
                $('#imagenes').val('');
                $('#imagen_corporativa').val('');
                $('#preview-imagenes').hide().html('');
                $('#preview-imagen-corporativa').hide().html('');
                
                // Restaurar imágenes actuales si estaban ocultas
                $('#current-imagenes').show();
                $('#current-imagen-corporativa').show();
                
                // Remover inputs hidden de eliminación y alertas
                $('input[name="eliminar_imagenes"]').remove();
                $('input[name="eliminar_imagen_corporativa"]').remove();
                $('#alerta-imagenes').remove();
                $('#alerta-imagen_corporativa').remove();
            }

            // Función para habilitar/deshabilitar campos
            function toggleInputs(enabled) {
                $('.form-input').prop('disabled', !enabled);
                $('button[data-target="#modalDocumento"]').prop('disabled', !enabled);
                $('#btn-eliminar-imagenes').prop('disabled', !enabled);
                $('#btn-eliminar-imagen-corporativa').prop('disabled', !enabled);

                // Manejar el select de seguros médicos con Select2
                if (enabled) {
                    $('#seguros_medicos').prop('disabled', false).trigger('change');
                } else {
                    $('#seguros_medicos').prop('disabled', true).trigger('change');
                }

                if (enabled) {
                    $('#btnEditar').hide();
                    $('#btnGuardar, #btnCancelar').show();
                    $('#btnAgregarUsuario').removeClass('btn-dark').addClass('btn-secondary');
                    $('button[data-target="#modalDocumento"]').removeClass('btn-dark').addClass('btn-secondary');
                } else {
                    $('#btnEditar').show();
                    $('#btnGuardar, #btnCancelar').hide();
                    $('#btnAgregarUsuario').removeClass('btn-secondary').addClass('btn-dark');
                    $('button[data-target="#modalDocumento"]').removeClass('btn-secondary').addClass('btn-dark');
                }
            }

            // Guardar valores originales al cargar la página
            saveOriginalValues();

            // Evento para el botón Editar
            $('#btnEditar').click(function(e) {
                e.preventDefault();
                saveOriginalValues(); // Guardar valores actuales antes de editar
                toggleInputs(true);
            });

            // Evento para el botón Cancelar
            $('#btnCancelar').click(function(e) {
                e.preventDefault();
                restoreOriginalValues(); // Restaurar valores originales
                toggleInputs(false);
            });

            // Evento para el botón Guardar
            $('#btnGuardar').click(function(e) {
                e.preventDefault();

                // Validación básica
                let email = $('[name="email"]').val();
                let nombre = $('[name="nombre"]').val();
                let ciudad = $('[name="ciudad"]').val();
                let numeroIdentificacion = $('[name="numero_identificacion"]').val();
                let direccion = $('[name="direccion"]').val();
                let telefono = $('[name="telefono"]').val();

                if (!email || !nombre || !ciudad || !numeroIdentificacion || !direccion || !telefono) {
                    alert('Por favor, complete todos los campos obligatorios marcados.');
                    return;
                }

                if (!validateEmail(email)) {
                    alert('Por favor, ingrese un email válido.');
                    return;
                }

                // Confirmar antes de guardar
                if (confirm('¿Está seguro de que desea guardar los cambios?')) {
                    $('#formMisDatos').submit();
                }
            });

            // Función para validar email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Deshabilitar el botón "Añadir nuevo usuario" cuando esté en modo edición
            $('#btnAgregarUsuario').click(function(e) {
                if ($(this).hasClass('btn-secondary')) {
                    e.preventDefault();
                    alert('Termine de editar los datos actuales antes de agregar un nuevo usuario.');
                }
            });

            // Deshabilitar los botones de documentos cuando no esté en modo edición
            $('button[data-target="#modalDocumento"]').click(function(e) {
                if ($(this).prop('disabled') || $(this).hasClass('btn-secondary')) {
                    e.preventDefault();
                    if ($(this).hasClass('btn-secondary')) {
                        alert('Los documentos solo pueden añadirse en modo edición.');
                    }
                }
            });

            // Inicializar Select2 para el campo de seguros médicos
            $('#seguros_medicos').select2({
                placeholder: "-- Seleccione uno o más seguros --",
                allowClear: true,
                width: '100%'
            });

            // Función para previsualizar imágenes
            function previewImage(input, previewId) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewContainer = $(`#${previewId}`);
                        previewContainer.html(`
                            <div class="preview-container">
                                <img src="${e.target.result}" alt="Preview" class="img-thumbnail">
                                <button type="button" class="remove-preview" onclick="removePreview('${input.id}', '${previewId}')">&times;</button>
                            </div>
                        `).show();
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Función para remover previsualización
            window.removePreview = function(inputId, previewId) {
                $(`#${inputId}`).val('');
                $(`#${previewId}`).hide().html('');
            }

            // Event listeners para los inputs de imágenes
            $('#imagenes').change(function() {
                previewImage(this, 'preview-imagenes');
            });

            $('#imagen_corporativa').change(function() {
                previewImage(this, 'preview-imagen-corporativa');
            });

            // Función para eliminar imagen actual
            window.eliminarImagenActual = function(campo) {
                if (confirm('¿Está seguro de que desea eliminar esta imagen?')) {
                    // Ocultar el contenedor de la imagen actual
                    $(`#current-${campo.replace('_', '-')}`).hide();
                    
                    // Agregar un input hidden para indicar que se debe eliminar la imagen
                    if ($(`input[name="eliminar_${campo}"]`).length === 0) {
                        $('#formMisDatos').append(`<input type="hidden" name="eliminar_${campo}" value="1">`);
                    }
                    
                    // Mostrar mensaje de confirmación con estilos mejorados
                    $(`#current-${campo.replace('_', '-')}`).after(`
                        <div class="alert alert-warning alert-eliminacion mt-2" id="alerta-${campo}">
                            <small><i class="fa fa-exclamation-triangle"></i> Esta imagen será eliminada al guardar los cambios.</small>
                        </div>
                    `);
                }
            }
        });

        // Función para eliminar documentos
        function eliminarDocumento(documentoId) {
            if (confirm('¿Está seguro de que desea eliminar este documento?')) {
                // Crear formulario temporal para enviar petición DELETE
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("proveedores.documentos.destroy", ":id") }}'.replace(':id', documentoId);

                let csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                let methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 para los seguros médicos
            $('#seguros_medicos').select2({
                placeholder: "Seleccione uno o más seguros médicos"
            });
        });
    </script>
@stop
