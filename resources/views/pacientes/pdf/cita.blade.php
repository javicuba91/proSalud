<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Cita</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .section { margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .table th, .table td { border: 1px solid #ccc; padding: 6px; }
        .table th { background: #f0f0f0; }
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
    </style>
</head>
<body>

     <table class="logo-table">
        <tr>
            <td>
                <img src="{{ public_path('imagenes/logo.png') }}" class="logo">
            </td>
            <td>
                <img src="{{ public_path($profesional->logo) }}" class="logo">
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="title">Datos de la Cita</div>
        <table class="table">
            <tr><th>ID</th><td>{{ $cita->id }}</td></tr>
            <tr><th>Estado</th><td>{{ ucfirst($cita->estado) }}</td></tr>
            <tr><th>Fecha y Hora</th><td>{{ date("d-m-Y H:i:s", strtotime($cita->fecha_hora)) }}</td></tr>
            <tr><th>Motivo</th><td>{{ $cita->motivo }}</td></tr>
            <tr><th>Modalidad</th><td>{{ ucfirst($cita->modalidad) }}</td></tr>
        </table>
    </div>
    <div class="section">
        <div class="title">Paciente</div>
        <table class="table">
            <tr><th>Nombre</th><td>{{ $paciente->nombre_completo }}</td></tr>
            <tr><th>Cédula</th><td>{{ $paciente->cedula }}</td></tr>
        </table>
    </div>
    <div class="section">
        <div class="title">Profesional</div>
        <table class="table">
            <tr><th>Nombre</th><td>{{ $profesional->nombre_completo }}</td></tr>
        </table>
    </div>
    @if($receta)
    <div class="section">
        <div class="title">Receta</div>
        <table class="table">
            <tr><th>Fecha de Emisión</th><td>{{ date("d-m-Y H:i:s", strtotime($receta->fecha_emision)) }}</td></tr>
        </table>
        <div class="title" style="font-size:16px;">Medicamentos Recetados</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Dosis</th>
                    <th>Presentación</th>
                    <th>Vía</th>
                    <th>Intervalo</th>
                    <th>Duración</th>
                </tr>
            </thead>
            <tbody>
            @foreach($receta->medicamentosRecetados as $med)
                <tr>
                    <td>{{ $med->medicamento->nombre ?? 'Medicamento' }}</td>
                    <td>{{ $med->dosis }}</td>
                    <td>{{ optional(App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id))->nombre }}</td>
                    <td>{{ optional(App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id))->nombre }}</td>
                    <td>{{ optional(App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id))->nombre }}</td>
                    <td>{{ $med->duracion }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</body>
</html>
