<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial Médico - {{ $paciente->nombre_completo }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .subsection-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background: #f5f5f5;
            font-weight: bold;
        }

        .field-group {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .field-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .field-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            padding-right: 10px;
            vertical-align: top;
        }

        .field-value {
            display: table-cell;
            width: 70%;
            vertical-align: top;
            word-wrap: break-word;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-primary {
            background: #cce5ff;
            color: #004085;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
        }

        .patient-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            float: right;
            margin-left: 15px;
        }

        .prueba-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 3px;
            margin: 3px;
            display: block;
            margin-bottom: 5px;
        }

        .image-container {
            margin: 10px 0;
            clear: both;
        }

        .image-item {
            display: inline-block;
            vertical-align: top;
            margin: 5px;
            text-align: center;
            width: 110px;
        }

        .image-description {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        .logo-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="logo-table">
            <tr>
                <td style="text-align: left; width: 20%;">
                    @if (file_exists(public_path('imagenes/logo.png')))
                        <img src="{{ public_path('imagenes/logo.png') }}" class="logo">
                    @endif
                </td>
                <td style="text-align: center; width: 60%;">
                    <h1 style="margin: 0; font-size: 24px;">HISTORIAL MÉDICO</h1>
                    <p style="margin: 5px 0; font-size: 14px;">{{ $paciente->nombre_completo }}</p>
                    <p style="margin: 0; font-size: 12px; color: #666;">Generado el {{ date('d/m/Y H:i') }}</p>
                </td>
                <td style="text-align: right; width: 20%;">
                    @if ($paciente->foto && file_exists(public_path($paciente->foto)))
                        <img src="{{ public_path($paciente->foto) }}" alt="Foto Perfil" class="patient-photo">
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Datos del Paciente -->
    <div class="section">
        <div class="section-title">Datos Personales</div>
        <div class="field-group">
            <div class="field-row">
                <div class="field-label">Nombre completo:</div>
                <div class="field-value">{{ $paciente->nombre_completo }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Fecha de nacimiento:</div>
                <div class="field-value">{{ date('d/m/Y', strtotime($paciente->fecha_nacimiento)) }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Género:</div>
                <div class="field-value">{{ $paciente->genero }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Estado civil:</div>
                <div class="field-value">{{ $paciente->estado_civil }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Nacionalidad:</div>
                <div class="field-value">{{ $paciente->nacionalidad }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Teléfono:</div>
                <div class="field-value">{{ $paciente->celular }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Email:</div>
                <div class="field-value">{{ $paciente->email }}</div>
            </div>
            <div class="field-row">
                <div class="field-label">Dirección:</div>
                <div class="field-value">{{ $paciente->direccion }}</div>
            </div>
        </div>
    </div>

    <!-- Consideraciones Médicas -->
    @if ($paciente->antecedentes && $paciente->antecedentes->count() > 0)
        <div class="section">
            <div class="section-title">Consideraciones Médicas</div>
            @foreach ($paciente->antecedentes as $antecedente)
                <div class="field-group">
                    <div class="field-row">
                        <div class="field-label">Alergias:</div>
                        <div class="field-value">{{ $antecedente->alergias ?: 'No especificadas' }}</div>
                    </div>
                    <div class="field-row">
                        <div class="field-label">Condiciones médicas preexistentes:</div>
                        <div class="field-value">{{ $antecedente->condiciones_medicas ?: 'No especificadas' }}</div>
                    </div>
                    <div class="field-row">
                        <div class="field-label">Medicamentos habituales:</div>
                        <div class="field-value">{{ $antecedente->medicamentos ?: 'No especificados' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Seguros de Salud -->
    @if ($paciente->segurosMedicos && $paciente->segurosMedicos->count() > 0)
        <div class="section">
            <div class="section-title">Seguros de Salud</div>
            <div class="row">
                @foreach ($paciente->segurosMedicos as $seguro)
                     <div class="col"  style="color: #0066cc; font-weight: bold;">{{ $seguro->nombre }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Contactos de Emergencia -->
    @if ($paciente->contactos_emergencia && $paciente->contactos_emergencia->count() > 0)
        <div class="section">
            <div class="section-title">Contactos de Emergencia</div>
            @foreach ($paciente->contactos_emergencia as $contacto)
                <div class="field-group">
                    <div class="field-row">
                        <div class="field-label">Nombre:</div>
                        <div class="field-value">{{ $contacto->nombre }}</div>
                    </div>
                    <div class="field-row">
                        <div class="field-label">Relación:</div>
                        <div class="field-value">{{ $contacto->relacion }}</div>
                    </div>
                    <div class="field-row">
                        <div class="field-label">Teléfono:</div>
                        <div class="field-value">{{ $contacto->telefono }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Informes de Consulta -->
    @if ($informes && $informes->count() > 0)
        <div class="section">
            <div class="section-title">Informes de Consulta</div>
            @foreach ($informes as $informe)
                <div class="field-group">
                    <div class="subsection-title">Consulta del {{ date('d/m/Y', strtotime($informe->created_at)) }}
                    </div>

                    <div>
                        <strong>Motivo:</strong>
                        <div >{{ $informe->motivo_consulta ?: 'No especificado' }}</div>
                    </div>

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
                        <div style="margin-top: 15px;">
                            <div class="subsection-title">Pruebas Asociadas:</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Categoría</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todasLasPruebas as $prueba)
                                        <tr>
                                            <td>{{ $prueba->tipo ?? '-' }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($prueba->created_at)) }}</td>
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
                                        </tr>

                                        {{-- Mostrar imágenes de la prueba --}}
                                        @php
                                            $imagenes = \App\Models\ImagenesPrueba::where(
                                                'prueba_id',
                                                $prueba->id,
                                            )->get();
                                        @endphp
                                        @if ($imagenes->count() > 0)
                                            <tr>
                                                <td colspan="5">
                                                    <div style="margin: 10px 0; clear: both;">
                                                        <strong>Resultados/Imágenes:</strong>
                                                        <div class="image-container">
                                                            @foreach ($imagenes as $img)
                                                                @if (file_exists(public_path($img->ruta)))
                                                                    <div class="image-item">
                                                                        <img src="{{ public_path($img->ruta) }}"
                                                                            class="prueba-image"
                                                                            alt="Imagen de prueba">
                                                                        <div class="image-description">
                                                                            {{ $img->descripcion ?? 'Sin descripción' }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Recetas -->
    @if ($recetas && $recetas->count() > 0)
        <div class="section">
            <div class="section-title">Recetas</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Medicamentos</th>
                        <th>Fecha</th>
                        <th>Médico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recetas as $receta)
                        @php
                            $receta1 = \App\Models\Receta::find($receta->id);
                            $medicamentos = $receta1->medicamentosRecetados
                                ->map(function ($med) {
                                    return optional($med->medicamento)->nombre;
                                })
                                ->filter()
                                ->implode(', ');
                        @endphp
                        <tr>
                            <td>{{ $medicamentos ?: 'No especificados' }}</td>
                            <td>{{ date('d/m/Y', strtotime($receta->fecha_emision)) }}</td>
                            <td>{{ $receta->nombre_completo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #666;">
        <p>Este documento fue generado automáticamente el {{ date('d/m/Y H:i:s') }}</p>
        <p>Historial médico de {{ $paciente->nombre_completo }}</p>
    </div>
</body>

</html>
