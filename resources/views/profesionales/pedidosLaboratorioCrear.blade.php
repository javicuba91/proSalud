@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de laboratorio')
@section('css')
    <style>
        .profile-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content_header')
    <h1>Elaboración de pedidos de laboratorio</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-2 mb-3">
            <img class="img img-responsive img-fluid profile-image" src="{{ asset('imagenes/logo.png') }}" alt="">
        </div>
        <div class="col-lg-2 mb-3">
            <img class="img img-responsive img-fluid profile-image" src="{{ asset($profesional->logo) }}" alt="">
        </div>
    </div>

    <h5>Datos del paciente</h5>
    <div class="row mb-3 border p-2">
        <div class="col-lg-4 mb-3">
            <label class="form-label">Nombre paciente</label>
            <input value="{{ $cita->paciente->nombre_completo }}" type="text" class="form-control" readonly disabled>
        </div>
        <div class="col-lg-4 mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input value="{{ $cita->paciente->fecha_nacimiento }}" type="date" class="form-control" readonly disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Cédula</label>
            <input value="{{ $cita->paciente->cedula }}" type="text" class="form-control" readonly disabled>
        </div>
    </div>

    <!-- Datos del médico -->
    <h5>Datos del médico</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->nombre_completo }}" class="form-control" readonly disabled
                placeholder="Nombre completo">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->fecha_nacimiento }}" class="form-control" readonly disabled
                placeholder="Especialidad">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->num_colegiado }}" class="form-control" readonly disabled
                placeholder="Número de colegiado">
        </div>
        @if ($cita->modalidad == 'presencial')
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ optional($cita->consultorio)->direccion }}" class="form-control" readonly
                    disabled placeholder="Centro médico o consultorio">
            </div>
        @else
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ $cita->url_meet }}" class="form-control" readonly disabled
                    placeholder="Enlace de Google Meet">
            </div>
        @endif
        <div class="col-12">
            <input type="text" value="{{ $cita->profesional->email }} / {{ $cita->profesional->telefono_personal }}"
                class="form-control" readonly disabled placeholder="Forma de contacto (email/teléfono)">
        </div>
    </div>

    <form action="{{ route('profesional.pedidoLaboratorio.update') }}" method="POST" id="form-informacion-clinica">
        @csrf
        <!-- Datos del pedido -->
        <h5>Datos del pedido</h5>
        <div class="row mb-3 border p-2">
            <div class="col-md-6">
                @if ($pedido->qr == null)
                    {!! QrCode::size(100)->generate('LAB-' . $profesional->id . '-' . date('YmdHis')) !!}
                    <input name="qr" type="text" class="form-control mt-3 align-self-end" placeholder="Código QR"
                        value="{{ 'LAB-' . $profesional->id . '-' . date('YmdHis') }}" readonly>
                @else
                    {!! QrCode::size(100)->generate($pedido->qr) !!}
                    <input type="text" class="form-control mt-3 align-self-end" placeholder="Código QR"
                        value="{{ $pedido->qr }}" readonly>
                @endif
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column h-100 justify-content-end" style="height: 100%;">
                    <input type="date" class="form-control mt-3 align-self-end" placeholder="Fecha de emisión"
                        value="{{ date('Y-m-d') }}" readonly disabled>
                </div>
            </div>
        </div>

        <!-- Información clínica -->

        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
        <h5>Información clínica</h5>
        <div class="mb-3 border p-2">
            <label for="motivo">Motivo:</label>
            <input type="text" class="form-control mb-2" name="motivo"
                value="{{ old('motivo', $pedido->motivo ?? '') }}"
                placeholder="Motivo del estudio (dolor abdominal, trauma, sospecha de patología específica, etc.)">

            <label for="sintoma">Síntomas:</label>
            <input type="text" class="form-control mb-2" name="sintoma"
                value="{{ old('sintoma', $pedido->sintoma ?? '') }}"
                placeholder="Síntomas relevantes y hallazgos del examen físico">

            <label for="antecedentes">Antecedentes:</label>
            <input type="text" class="form-control" name="antecedentes"
                value="{{ old('antecedentes', $pedido->antecedentes ?? '') }}"
                placeholder="Antecedentes clínicos que puedan influir en la elección del estudio">
        </div>
        <div class="row mt-3 mb-4">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-dark" id="agregar-prueba">
                    <i class="fa fa-save"></i> Guardar información clínica
                </button>
            </div>

        </div>
    </form>

    <!-- Pruebas de laboratorio -->
    <div class="row mb-3">
        <div class="col-lg-10">
            <h5>Pruebas de laboratorio</h5>
        </div>
        <div class="col-lg-2">
            <button data-toggle="modal" data-target="#modalAgregarPrueba" type="button" class="btn btn-dark w-100"
                id="agregar-prueba">
                <i class="fa fa-plus"></i> Agregar prueba
            </button>
        </div>
    </div>

    <div id="contenedor-pruebas">
        @if ($pedido->pruebas->count() > 0)
            @foreach ($pedido->pruebas as $prueba)
                <div class="prueba-item mb-3 border p-3" data-prueba="{{ $prueba->id }}">
                    <div class="row mb-2 mt-2">
                        <div class="col-lg-10">
                            <h6>Prueba {{ $loop->iteration }}</h6>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm eliminar-prueba float-end float-right"
                                data-prueba="{{ $prueba->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <input readonly value="{{ old('tipo', $prueba->tipo ?? '') }}" type="text"
                        class="form-control mb-2" name="tipo"
                        placeholder="Tipo de análisis solicitado (hemograma, perfil bioquímico, etc.)">
                    <input readonly value="{{ old('muestras', $prueba->muestras ?? '') }}" type="text"
                        class="form-control mb-2" name="muestras"
                        placeholder="Muestras a recolectar (sangre, orina, etc.)">
                    <input readonly value="{{ old('indicaciones', $prueba->indicaciones ?? '') }}" type="text"
                        class="form-control mb-2" name="indicaciones"
                        placeholder="Indicaciones">
                    <input readonly value="{{ old('prioridad', ucfirst($prueba->prioridad) ?? '') }}" type="text"
                        class="form-control mb-2" name="prioridad"
                        placeholder="Prioridad del examen (urgente, programado, etc.)">
                </div>
            @endforeach
        @endif

    </div>

    <div class="row mb-3">
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="enviar">
                Enviar al paciente
            </button>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="imprimir">
                Imprimir
            </button>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-dark w-100" name="accion" value="pdf">
                Exportar en PDF
            </button>
        </div>
    </div>

    <div class="modal fade" id="modalAgregarPrueba" tabindex="-1" role="dialog"
        aria-labelledby="modalAgregarPruebaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('profesional.pruebas.laboratorios') }}">
                @csrf
                <input type="hidden" value="{{ $pedido->id }}" name="pedido_id" id="pedido_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Prueba</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-2" name="tipo"
                            placeholder="Tipo de análisis solicitado (hemograma, perfil bioquímico, etc.)">
                        <input type="text" class="form-control mb-2" name="muestras"
                            placeholder="Muestras a recolectar (sangre, orina, etc.)">
                        <input type="text" class="form-control mb-2" name="indicaciones"
                            placeholder="Indicaciones">
                        <select class="form-control mb-2" name="prioridad">
                            <option value="programado">Programado</option>
                            <option value="urgente">Urgente</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            // Eliminar prueba
            $(document).on('click', '.eliminar-prueba', function() {
                const pruebaId = $(this).data('prueba');
                $(`.prueba-item[data-prueba="${pruebaId}"]`).remove();

                // Ocultar botón de eliminar si solo queda una prueba
                if ($('.prueba-item').length <= 1) {
                    $('.eliminar-prueba').hide();
                }
                // por ajax eliminar la prueba por su id
                $.ajax({
                    url: `/profesional/pedidoLaboratorio/prueba/${pruebaId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // un sweeet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Prueba eliminada',
                            text: 'La prueba ha sido eliminada correctamente.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
@endsection
