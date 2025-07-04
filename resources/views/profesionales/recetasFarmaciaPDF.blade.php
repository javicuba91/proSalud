<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h2,
        h3 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .logo-table td {
            text-align: center;
            vertical-align: middle;
        }

        .logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .info-table td {
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

        .qr img {
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h2>Receta Médica</h2>

    <table class="logo-table">
        <tr>
            <td>
                <img src="{{ public_path('imagenes/logo.png') }}" class="logo">
            </td>
            <td>
                <img src="{{ public_path($receta->informeConsulta->cita->profesional->logo) }}" class="logo">
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td class="label">Paciente:</td>
            <td>{{ $receta->informeConsulta->cita->paciente->nombre_completo }}</td>
        </tr>
        <tr>
            <td class="label">Cédula:</td>
            <td>{{ $receta->informeConsulta->cita->paciente->cedula }}</td>
        </tr>
        <tr>
            <td class="label">Fecha nacimiento:</td>
            <td>{{ $receta->informeConsulta->cita->paciente->fecha_nacimiento }}</td>
        </tr>
        <tr>
            <td class="label">Médico:</td>
            <td>{{ $receta->informeConsulta->cita->profesional->nombre_completo }}</td>
        </tr>
        <tr>
            <td class="label">Colegiado:</td>
            <td>{{ $receta->informeConsulta->cita->profesional->num_colegiado }}</td>
        </tr>
        <tr>
            <td class="label">Fecha emisión:</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($receta->fecha_emision)) }}</td>
        </tr>
        <tr>
            <td class="label">Diagnóstico:</td>
            <td>{{ $receta->diagnostico }}</td>
        </tr>
        <tr>
            <td class="label">Comentarios:</td>
            <td>{{ $receta->comentarios }}</td>
        </tr>
        <tr>
            <td class="label">Sello:</td>
            <td>
                @if ($receta->informeConsulta->cita->profesional->sello)
                    <img src="{{ public_path($receta->informeConsulta->cita->profesional->sello) }}"
                        class="logo">
                @else
                    No disponible
                @endif
            </td>
            <td class="label">Firma:</td>
            <td>
                @if ($receta->informeConsulta->cita->profesional->firma)
                    <img src="{{ public_path($receta->informeConsulta->cita->profesional->firma) }}"
                        class="logo">
                @else
                    No disponible
                @endif
            </td>
        </tr>

    </table>

    <h3>Medicamentos</h3>
    @foreach ($receta->medicamentosRecetados as $med)
        <div class="border">
            <strong>{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
            Dosis: {{ $med->dosis }}<br>
            Presentación:
            {{ App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id)->nombre }}<br>
            Vía:
            {{ App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id)->nombre }}<br>
            Intervalo: {{ App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id)->nombre }}<br>
            Duración: {{ $med->duracion }}
        </div>
    @endforeach

    @if ($receta->qr)
        <div class="qr">
            {!! QrCode::size(100)->generate($receta->qr) !!}
        </div>
    @endif
</body>

</html>
