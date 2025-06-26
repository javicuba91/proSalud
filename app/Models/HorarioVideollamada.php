<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioVideollamada extends Model
{
    protected $table = "horarios_videollamada";

    protected $fillable = [
        'profesional_id',
        'dia_semana',
        'fecha',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleHorarioVideollamada::class, 'horario_id');
    }
}
