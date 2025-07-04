@extends('adminlte::page')

@section('title', 'Elaboración receta digital')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <h1>Elaboración receta digital</h1>
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

    <!-- Datos de la receta -->
    <form action="{{ route('profesionales.receta.update', $receta->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h5>Datos de la receta</h5>
        @php
            use Illuminate\Support\Str;
            use SimpleSoftwareIO\QrCode\Facades\QrCode;

            // Valor de QR: el existente o uno aleatorio
            $qrValue = $receta->qr ?? Str::upper(Str::random(8));

            // Si quieres que el enlace codificado sea la URL de detalle:
            //$urlDetalle = route('recetas.show', ['id' => $receta->id, 'qr' => $qrValue]);

        @endphp

        <div class="row mb-3 border p-2">
            @if ($receta->qr)
                <div class="col-md-12 text-left mb-3">
                    {{-- Mostrar el QR --}}
                    {!! QrCode::size(150)->generate($receta->qr) !!}
                </div>
            @endif

            <div class="col-md-6 mb-2">
                <label class="form-label">Código QR</label>
                <input type="text" class="form-control" name="qr" value="{{ old('qr', $qrValue) }}"
                    placeholder="Código QR" />
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Fecha de emisión</label>
                <input type="datetime-local" class="form-control" name="fecha_emision"
                    value="{{ old('fecha_emision', \Carbon\Carbon::parse($receta->fecha_emision)->format('Y-m-d\TH:i')) }}" />
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Diagnóstico / Motivo</label>
                <textarea class="form-control" name="diagnostico" rows="2" placeholder="Diagnóstico o motivo de la prescripción">{{ old('diagnostico', $receta->diagnostico) }}</textarea>
            </div>
        </div>


        <!-- Indicaciones médicas -->
        <h5>Indicaciones médicas</h5>
        <div class="mb-3">
            <textarea class="form-control" name="comentarios" rows="2" placeholder="Comentarios">{{ $receta->comentarios }}</textarea>
        </div>
        <label for="recetas">Adjuntar archivos de imagen o PDF de recetas anteriores </label>
        <div class="mb-4">
            <input id="recetas" name="ruta_archivo[]" type="file" class="form-control" accept="image/*,application/pdf" multiple onchange="previewFiles(this)">

            <!-- Mostrar archivos existentes -->
            @if($receta->recetas_anteriores && $receta->recetas_anteriores->count() > 0)
            <div class="mt-3">
                <h6>Archivos ya subidos:</h6>
                <div class="row">
                    @foreach($receta->recetas_anteriores as $index => $archivo)
                    <div class="col-md-4 mb-2">
                        <div class="border p-2 rounded">
                            @if(Str::endsWith(strtolower($archivo->ruta_archivo), ['.jpg','.jpeg','.png','.gif']))
                            <img src="{{ asset($archivo->ruta_archivo) }}" class="img-thumbnail w-100" style="max-height: 150px; object-fit: cover;">
                            @else
                            <div class="text-center p-3">
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                <p class="mt-2 mb-0">PDF</p>
                            </div>
                            @endif
                            <div class="mt-2">
                                <a href="{{ asset($archivo->ruta_archivo) }}" target="_blank" class="btn btn-sm btn-info w-100">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <button type="button" class="btn btn-sm btn-danger w-100 mt-1" onclick="eliminarArchivo({{ $archivo->id }})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Contenedor para preview de nuevos archivos -->
            <div class="mt-2" id="preview-container"></div>
        </div>

        <script>
            function previewFiles(input) {
                const preview = document.getElementById('preview-container');
                preview.innerHTML = '';

                if (input.files && input.files.length > 0) {
                    const previewTitle = document.createElement('h6');
                    previewTitle.textContent = 'Archivos seleccionados:';
                    preview.appendChild(previewTitle);

                    const row = document.createElement('div');
                    row.className = 'row';

                    for (let i = 0; i < input.files.length; i++) {
                        const file = input.files[i];
                        const col = document.createElement('div');
                        col.className = 'col-md-4 mb-2';

                        const fileDiv = document.createElement('div');
                        fileDiv.className = 'border p-2 rounded';

                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                fileDiv.innerHTML = `
                                    <img src="${e.target.result}" class="img-thumbnail w-100" style="max-height: 150px; object-fit: cover;">
                                    <p class="mt-2 mb-0 text-center small">${file.name}</p>
                                `;
                            }
                            reader.readAsDataURL(file);
                        } else if (file.type === 'application/pdf') {
                            fileDiv.innerHTML = `
                                <div class="text-center p-3">
                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    <p class="mt-2 mb-0 small">${file.name}</p>
                                </div>
                            `;
                        }

                        col.appendChild(fileDiv);
                        row.appendChild(col);
                    }

                    preview.appendChild(row);
                }
            }

            function eliminarArchivo(archivoId) {
                if (confirm('¿Estás seguro de que quieres eliminar este archivo?')) {
                    fetch(`/profesional/receta/archivo/${archivoId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Error al eliminar el archivo');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al eliminar el archivo');
                    });
                }
            }
        </script>
        <div class="row mb-3">
            <div class="col-lg"><button type="submit" class="btn btn-dark w-100">Guardar receta</button></div>
            <div class="col-lg"><button class="btn btn-dark w-100">Enviar al paciente</button></div>
            <div class="col-lg"><button type="button" data-toggle="modal" data-target="#modalReceta"
                    class="btn btn-dark w-100">Imprimir</button></div>
            <div class="col-lg">
                <a href="{{ route('profesional.receta.exportarPDF', $receta->id) }}" class="btn btn-dark w-100">
                    Exportar en PDF
                </a>
            </div>
        </div>
    </form>

    <!-- Medicamentos recetados -->
    <div class="row align-items-center mb-3">
        <div class="col">
            <h5 class="mb-0">Medicamentos recetados</h5>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-primary float-end" data-toggle="modal" data-target="#modalMedicamento">
                <i class="fa fa-plus"></i> Añadir Medicamento
            </a>
        </div>
    </div>

    <div class="row border p-3">
        <div class="col-lg-12">
            @foreach ($receta->medicamentosRecetados as $med)
                <div class="border rounded p-3 mb-2 position-relative">
                    <strong>{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
                    Dosis: {{ $med->dosis }}<br>
                    Presentación:
                    {{ App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id)->nombre }}<br>
                    Vía de Administración:
                    {{ App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id)->nombre }}<br>
                    Intervalo: {{ App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id)->nombre }}<br>
                    Duración: {{ $med->duracion }}

                    <form method="POST" action="{{ route('profesionales.medicamentos_recetas.destroy', $med->id) }}"
                        class="position-absolute" style="top: 10px; right: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('¿Estás seguro de eliminar este medicamento?')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalReceta" tabindex="-1" aria-labelledby="modalRecetaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable"> <!-- scroll si el contenido es largo -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRecetaLabel">Vista previa Receta Médica</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="modalRecetaContent"
                    style="font-family: DejaVu Sans, sans-serif; font-size:12px; color:#333;">
                    <!-- Aquí va tu contenido -->
                    <h2>Receta Médica</h2>

                    <table class="logo-table" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align:center; vertical-align:middle;">
                                <img src="{{ asset('imagenes/logo.png') }}"
                                    style="width:100px; height:100px; object-fit:contain; border:1px solid #ccc; padding:5px; border-radius:5px;">
                            </td>
                            <td style="text-align:center; vertical-align:middle;">
                                <img src="{{ asset($receta->informeConsulta->cita->profesional->logo) }}"
                                    style="width:100px; height:100px; object-fit:contain; border:1px solid #ccc; padding:5px; border-radius:5px;">
                            </td>
                        </tr>
                    </table>

                    <table class="info-table" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
                        <tr>
                            <td style="font-weight:bold; color:#000; width: 30%;">Paciente:</td>
                            <td>{{ $receta->informeConsulta->cita->paciente->nombre_completo }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Cédula:</td>
                            <td>{{ $receta->informeConsulta->cita->paciente->cedula }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Fecha nacimiento:</td>
                            <td>{{ $receta->informeConsulta->cita->paciente->fecha_nacimiento }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Médico:</td>
                            <td>{{ $receta->informeConsulta->cita->profesional->nombre_completo }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Colegiado:</td>
                            <td>{{ $receta->informeConsulta->cita->profesional->num_colegiado }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Fecha emisión:</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($receta->fecha_emision)) }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Diagnóstico:</td>
                            <td>{{ $receta->diagnostico }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; color:#000;">Comentarios:</td>
                            <td>{{ $receta->comentarios }}</td>
                        </tr>
                    </table>

                    <h3>Medicamentos</h3>
                    @foreach ($receta->medicamentosRecetados as $med)
                        <div
                            style="padding:10px; border-radius:6px; background:#f0f8ff; margin-bottom:10px; color:#0056b3; font-size:13px;">
                            <strong>{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
                            Dosis: {{ $med->dosis }}<br>
                            Presentación:
                            {{ App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id)->nombre }}<br>
                            Vía:
                            {{ App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id)->nombre }}<br>
                            Intervalo:
                            {{ App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id)->nombre }}<br>
                            Duración: {{ $med->duracion }}
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="imprimirContenidoModal()">Imprimir
                        Receta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Añadir Medicamento -->
    <div class="modal fade" id="modalMedicamento" tabindex="-1" aria-labelledby="modalMedicamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('profesionales.medicamentos_recetas.guardarMedicamentosReceta') }}">
                @csrf
                <input type="hidden" name="receta_id" value="{{ $receta->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMedicamentoLabel">Añadir Medicamento</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="medicamento_id" class="form-control">
                                    <option value="">Seleccione medicamento</option>
                                    @foreach ($medicamentos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="presentacion_medicamentos_id" class="form-control">
                                    <option value="">Seleccione presentación</option>
                                    @foreach ($presentaciones as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4"><input name="dosis" type="text" class="form-control"
                                    placeholder="Dosis"></div>
                            <div class="col-md-4 mt-2">
                                <select name="via_administracion_medicamentos_id" class="form-control">
                                    <option value="">Seleccione vía</option>
                                    @foreach ($vias as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <select name="intervalo_medicamentos_id" class="form-control">
                                    <option value="">Seleccione intervalo</option>
                                    @foreach ($intervalos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-2"><input name="duracion" type="text" class="form-control"
                                    placeholder="Duración del tratamiento"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        function imprimirContenidoModal() {
            const contenido = document.getElementById('modalRecetaContent').innerHTML;
            const ventana = window.open('', '_blank', 'width=800,height=600');
            ventana.document.write(`
        <html>
          <head>
            <title>Imprimir Receta Médica</title>
            <style>
              body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
                color: #333;
                margin: 20px;
              }
              h2, h3 {
                color: #0056b3;
                text-align: center;
                margin-bottom: 10px;
              }
              table {
                width: 100%;
                margin-bottom: 20px;
                border-collapse: collapse;
              }
              td {
                padding: 6px 4px;
                vertical-align: top;
              }
              .label {
                font-weight: bold;
                color: #000;
                width: 30%;
              }
              .border {
                border: 1px solid #0056b3;
                padding: 10px;
                border-radius: 6px;
                background-color: #f0f8ff;
                margin-bottom: 10px;
              }
              .border strong {
                color: #0056b3;
                font-size: 13px;
              }
              .qr {
                text-align: center;
                margin-top: 20px;
              }
              img {
                max-width: 100%;
              }
            </style>
          </head>
          <body>
            ${contenido}
          </body>
        </html>
      `);
            ventana.document.close();
            ventana.focus();
            ventana.print();
            ventana.close();
        }
    </script>

@endsection
