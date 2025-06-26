<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleHorarioVideollamada extends Model
{
    protected $table = "detalle_horarios_videollamada";

    protected $fillable = [
        'horario_id',
        'hora_desde',
        'hora_hasta',
        'bloqueado',
    ];

    public function horario()
    {
        return $this->belongsTo(HorarioVideollamada::class, 'horario_id');
    }
}
