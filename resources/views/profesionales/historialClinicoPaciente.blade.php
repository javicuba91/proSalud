@extends('adminlte::page')

@section('title', 'Historial clínico del paciente')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('content_header')
    <h1>Historial clínico del paciente</h1>
@stop

@section('content')
    <div class="border p-2 mb-2">
        <div class="row">
            <div class="col-lg-12 mb-2 text-center">
                @if ($paciente->foto)
                    <img src="{{ asset($paciente->foto) }}" alt="Foto del paciente" class="img-fluid rounded"
                        style="max-width: 400px; max-height: 400px;">
                @else
                    <span class="text-muted">Sin foto</span>
                @endif
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
                    <h6 class="text-bold">QR de la Cita</h6>
                    <div>
                        {!! QrCode::size(80)->generate($informe->cita->codigo_qr) !!}
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="fecha_informe_{{ $loop->index }}" class="form-label">Fecha</label>
                    <input type="text" id="fecha_informe_{{ $loop->index }}"
                        value="{{ date('d-m-Y', strtotime($informe->created_at)) }}" class="form-control" readonly
                        placeholder="Fecha">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="motivo_informe_{{ $loop->index }}" class="form-label">Motivo</label>
                    <input type="text" id="motivo_informe_{{ $loop->index }}"
                        value="{{ $informe->motivo_consulta }}" class="form-control" readonly placeholder="Motivo">
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">&nbsp;</label>
                    <a class="btn btn-dark w-100 d-block"
                        href="/profesional/cita/informe-consulta/{{ $informe->cita_id }}">Ver informe</a>
                </div>
                <div class="col-md-3 mb-2">
                    <label for="seguimiento_informe_{{ $loop->index }}" class="form-label">Seguimiento/nueva
                        consulta</label>
                    <input type="text" id="seguimiento_informe_{{ $loop->index }}" class="form-control" readonly
                        placeholder="Seguimiento/nueva consulta">
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">&nbsp;</label>
                    <a href="" class="btn btn-dark w-100 d-block">Contactar</a>
                </div>
                <!-- Pruebas asociadas -->
                @php
                    $todasLasPruebas = collect();

                    if ($informe->pedidoLaboratorio && $informe->pedidoLaboratorio->pruebas->count() > 0) {
                        $todasLasPruebas = $todasLasPruebas->merge($informe->pedidoLaboratorio->pruebas);
                    }

                    if ($informe->pedidoImagen && $informe->pedidoImagen->pruebas->count() > 0) {
                        $todasLasPruebas = $todasLasPruebas->merge($informe->pedidoImagen->pruebas);
                    }
                @endphp

                @if ($todasLasPruebas->count() > 0)
                    <div class="col-md-12 mt-3">
                        <h6 class="text-primary">Pruebas asociadas al informe:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Motivo de la prueba</th>
                                        <th>Tipo</th>
                                        <th>Fecha de solicitud de la Prueba</th>
                                        <th>Categoría</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Resultados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todasLasPruebas as $prueba)
                                        <tr>
                                            @if ($prueba->pedidoLaboratorio)
                                                <td class="font-weight-bold">
                                                    {{ $prueba->pedidoLaboratorio->motivo ?? '-' }}</td>
                                            @elseif ($prueba->pedidoImagen)
                                                <td class="font-weight-bold">{{ $prueba->pedidoImagen->motivo ?? '-' }}
                                                </td>
                                            @else
                                                <td class="font-weight-bold">-</td>
                                            @endif
                                            <td>{{ $prueba->tipo ?? '-' }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($prueba->created_at)) }}</td>
                                            <td>
                                                @if ($prueba->pedido_laboratorio_id)
                                                    <span class="badge badge-info">Laboratorio</span>
                                                @elseif($prueba->pedido_imagen_id)
                                                    <span class="badge badge-primary">Imagen</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ ucfirst($prueba->prioridad ?? '-') }}</td>
                                            <td>
                                                @php
                                                    $estado = strtolower($prueba->estado ?? '');
                                                    $claseEstado = match ($estado) {
                                                        'pendiente' => 'badge-warning',
                                                        'aprobada', 'completada' => 'badge-success',
                                                        'rechazada' => 'badge-danger',
                                                        default => 'badge-secondary',
                                                    };
                                                @endphp
                                                <span
                                                    class="badge {{ $claseEstado }}">{{ ucfirst($prueba->estado ?? '-') }}</span>
                                            </td>
                                            <td>
                                                @if ($prueba->pedido_imagen_id || $prueba->pedido_laboratorio_id)
                                                    @if ($prueba->estado != 'pendiente')
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            data-toggle="modal"
                                                            data-target="#modalResultados{{ $prueba->id }}">
                                                            <i class="fa fa-eye"></i> Ver resultados
                                                        </button>
                                                    @endif
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalResultados{{ $prueba->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modalLabel{{ $prueba->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modalLabel{{ $prueba->id }}">
                                                                        Resultados de la prueba:
                                                                        {{ $prueba->tipo ?? 'N/A' }}
                                                                        @if ($prueba->pedido_laboratorio_id)
                                                                            <span
                                                                                class="badge badge-info ml-2">Laboratorio</span>
                                                                        @elseif($prueba->pedido_imagen_id)
                                                                            <span
                                                                                class="badge badge-primary ml-2">Imagen</span>
                                                                        @endif
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Cerrar">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- Mostrar imágenes para cualquier tipo de prueba --}}
                                                                    @php
                                                                        $imagenes = \App\Models\ImagenesPrueba::where(
                                                                            'prueba_id',
                                                                            $prueba->id,
                                                                        )->get();
                                                                    @endphp
                                                                    @if ($imagenes->count())
                                                                        <h6 class="text-primary mb-3">
                                                                            @if ($prueba->pedido_imagen_id)
                                                                                Imágenes de la prueba
                                                                            @elseif ($prueba->pedido_laboratorio_id)
                                                                                Resultados de laboratorio
                                                                            @else
                                                                                Imágenes de la prueba
                                                                            @endif
                                                                        </h6>
                                                                        <div class="row">
                                                                            @foreach ($imagenes as $img)
                                                                                <div
                                                                                    class="col-md-4 mb-3 text-center position-relative">
                                                                                    <img src="/{{ $img->ruta }}"
                                                                                        alt="Imagen prueba"
                                                                                        class="img-fluid rounded mb-2"
                                                                                        style="max-height:180px; cursor: pointer;"
                                                                                        onclick="window.open('/{{ $img->ruta }}', '_blank')">
                                                                                    <div class="small text-muted">
                                                                                        {{ $img->descripcion ?? 'Sin descripción' }}
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <div class="alert alert-info">
                                                                            <i class="fa fa-info-circle"></i>
                                                                            @if ($prueba->pedido_imagen_id)
                                                                                No hay imágenes asociadas a esta prueba de
                                                                                imagen.
                                                                            @elseif ($prueba->pedido_laboratorio_id)
                                                                                No hay resultados de laboratorio disponibles
                                                                                para esta prueba.
                                                                            @else
                                                                                No hay imágenes asociadas a esta prueba.
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    {{-- Mostrar archivos adicionales si existen --}}
                                                                    @if (isset($prueba->archivo) && $prueba->archivo)
                                                                        <hr>
                                                                        <h6 class="text-secondary mb-2">Archivo adicional
                                                                        </h6>
                                                                        <a href="{{ asset('ruta/a/archivos/' . $prueba->archivo) }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-outline-primary">
                                                                            <i class="fa fa-download"></i> Descargar
                                                                            archivo
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif (isset($prueba->archivo) && $prueba->archivo)
                                                    <a href="{{ asset('ruta/a/archivos/' . $prueba->archivo) }}"
                                                        target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-download"></i> Ver archivo
                                                    </a>
                                                @else
                                                    <span class="text-muted small">Sin resultados</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 mt-2">
                        <small class="text-muted">Sin pruebas asociadas a este informe</small>
                    </div>
                @endif
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
                        $medicamentos = $receta1->medicamentosRecetados
                            ->map(function ($med) {
                                return optional($med->medicamento)->nombre;
                            })
                            ->filter()
                            ->implode(', ');
                    @endphp
                    <input type="text" value="{{ $medicamentos }}" class="form-control"
                        placeholder="Medicamento/s recetados">

                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" value="{{ $receta->fecha_emision }}" class="form-control"
                        placeholder="Fecha">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" value="{{ $receta->nombre_completo }}" class="form-control"
                        placeholder="Médico que recetó">
                </div>
                <div class="col-md-3 mb-2">
                    <a href="/profesional/cita/informe-consulta/{{ $receta->idInforme }}/receta"
                        class="btn btn-dark w-100">Ver receta</a>
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
