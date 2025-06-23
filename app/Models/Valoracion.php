<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = "valoraciones";

    protected $fillable = [
        'paciente_id',
        'profesional_id',
        'fecha',
        'modalidad',
        'puntuacion',
        'comentario',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
