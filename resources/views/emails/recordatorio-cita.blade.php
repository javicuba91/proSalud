<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .cita-info {
            background-color: white;
            padding: 20px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img width="250" src="{{ asset("imagenes/logo.png") }}" alt="">
        <h1>ProSalud</h1>
        <h2>Recordatorio de Cita</h2>
    </div>

    <div class="content">
        <p>Estimado/a <strong>{{ $paciente->nombre_completo}}</strong>,</p>

        <p>Le recordamos que tiene una cita médica programada con los siguientes detalles:</p>

        <div class="cita-info">
            <h3>Detalles de la Cita</h3>
            <p><strong>Fecha y Hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y H:i') }}</p>
            <p><strong>Profesional:</strong> {{ $profesional->nombre_completo ?? 'No disponible' }}</p>
            <p><strong>Modalidad:</strong> {{ ucfirst($cita->modalidad) }}</p>
            @if($cita->motivo)
                <p><strong>Motivo:</strong> {{ $cita->motivo }}</p>
            @endif
            @if($consultorio && $cita->modalidad == 'presencial')
                <p><strong>Consultorio:</strong> {{ $consultorio->direccion }}</p>
            @endif
            @if($qrCodeData)
                <p><strong>Código de Cita:</strong></p>
                <div style="text-align: center; margin: 10px 0;">
                    <img src="data:image/png;base64,{{ $qrCodeData }}" alt="Código QR de la cita" style="max-width: 150px; height: auto;">
                </div>
            @endif
        </div>

        <p>Por favor, llegue con 15 minutos de anticipación a su cita.</p>

        <p>Si necesita reprogramar o cancelar su cita, por favor contacte con nosotros lo antes posible.</p>

        <p>¡Esperamos verle pronto!</p>

        <p>Atentamente,<br>
        <strong>Equipo ProSalud</strong></p>
    </div>

    <div class="footer">
        <p>Este es un mensaje automático, por favor no responda a este correo.</p>
    </div>
</body>
</html>
