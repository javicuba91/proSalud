<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleHorario extends Model
{
    //
    protected $table = "detalle_horarios";

    protected $fillable = [
        'horario_id',
        'hora_desde',
        'hora_hasta',
        'bloqueado',
        'consultorio_id',
    ];
    public function horario()
    {
        return $this->belongsTo(HorarioProfesional::class, 'horario_id');
    }

    public function consultorio()
    {
        return $this->belongsTo(ConsultorioProfesional::class);
    }
}
