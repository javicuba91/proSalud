
<html>
<head>
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

        .clinical-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .clinical-info .label {
            color: #0056b3;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .clinical-info .value {
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .prueba-item {
            border: 1px solid #0056b3;
            padding: 15px;
            border-radius: 6px;
            background-color: #f0f8ff;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .prueba-item .prueba-title {
            color: #0056b3;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #0056b3;
            padding-bottom: 5px;
        }

        .prueba-detail {
            margin-bottom: 8px;
        }

        .prueba-detail .label {
            width: 25%;
            display: inline-block;
            color: #0056b3;
        }

        .prueba-detail .value {
            display: inline-block;
            width: 70%;
        }

        .priority-urgente {
            color: #dc3545;
            font-weight: bold;
        }

        .priority-programado {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Pedido de Laboratorio</h2>

    <table class="logo-table">
        <tr>
            <td>
                <img src="{{ public_path('imagenes/logo.png') }}" class="logo">
            </td>
            <td>
                <img src="{{ public_path($pedido->informeConsulta->cita->profesional->logo) }}" class="logo">
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td class="label">Paciente:</td>
            <td>{{ $pedido->informeConsulta->cita->paciente->nombre_completo }}</td>
        </tr>
        <tr>
            <td class="label">Cédula:</td>
            <td>{{ $pedido->informeConsulta->cita->paciente->cedula }}</td>
        </tr>
        <tr>
            <td class="label">Fecha nacimiento:</td>
            <td>{{ $pedido->informeConsulta->cita->paciente->fecha_nacimiento }}</td>
        </tr>
        <tr>
            <td class="label">Médico:</td>
            <td>{{ $pedido->informeConsulta->cita->profesional->nombre_completo }}</td>
        </tr>
        <tr>
            <td class="label">Colegiado:</td>
            <td>{{ $pedido->informeConsulta->cita->profesional->num_colegiado }}</td>
        </tr>
        <tr>
            <td class="label">Fecha emisión:</td>
            <td>{{ date("d-m-Y H:i:s") }}</td>
        </tr>
        @if($pedido->informeConsulta->cita->modalidad == 'presencial')
        <tr>
            <td class="label">Centro médico:</td>
            <td>{{ optional($pedido->informeConsulta->cita->consultorio)->direccion }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Contacto médico:</td>
            <td>{{ $pedido->informeConsulta->cita->profesional->email }} / {{ $pedido->informeConsulta->cita->profesional->telefono_personal }}</td>
        </tr>
    </table>

    @if($pedido->motivo || $pedido->sintoma || $pedido->antecedentes)
    <h3>Información Clínica</h3>
    <div class="clinical-info">
        @if($pedido->motivo)
        <div class="clinical-detail">
            <span class="label">Motivo:</span>
            <div class="value">{{ $pedido->motivo }}</div>
        </div>
        @endif

        @if($pedido->sintoma)
        <div class="clinical-detail">
            <span class="label">Síntomas:</span>
            <div class="value">{{ $pedido->sintoma }}</div>
        </div>
        @endif

        @if($pedido->antecedentes)
        <div class="clinical-detail">
            <span class="label">Antecedentes:</span>
            <div class="value">{{ $pedido->antecedentes }}</div>
        </div>
        @endif
    </div>
    @endif

    <h3>Pruebas de Laboratorio</h3>
    @if($pedido->pruebas && $pedido->pruebas->count() > 0)
        @foreach($pedido->pruebas as $prueba)
            <div class="prueba-item">
                <div class="prueba-title">Prueba {{ $loop->iteration }}</div>

                <div class="prueba-detail">
                    <span class="label">Tipo de análisis:</span>
                    <span class="value">{{ $prueba->tipo }}</span>
                </div>

                <div class="prueba-detail">
                    <span class="label">Muestras:</span>
                    <span class="value">{{ $prueba->muestras }}</span>
                </div>

                @if($prueba->indicaciones)
                <div class="prueba-detail">
                    <span class="label">Indicaciones:</span>
                    <span class="value">{{ $prueba->indicaciones }}</span>
                </div>
                @endif

                <div class="prueba-detail">
                    <span class="label">Prioridad:</span>
                    <span class="value priority-{{ $prueba->prioridad }}">{{ ucfirst($prueba->prioridad) }}</span>
                </div>
            </div>
        @endforeach
    @else
        <div class="border">
            <p style="text-align: center; color: #666; margin: 0;">No se han agregado pruebas de laboratorio</p>
        </div>
    @endif

    @if($pedido->qr)
        <div class="qr">
            {!! QrCode::size(100)->generate($pedido->qr) !!}
        </div>
    @endif
</body>
</html>
