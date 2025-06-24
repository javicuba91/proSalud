<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespuestaExperto extends Model
{
    //
    protected $table = "respuestas_expertos";

    protected $fillable = [
        'preguntas_expertos_id',
        'respuesta',
        'profesional_id'
    ];

    public function pregunta()
    {
        return $this->belongsTo(PreguntaExperto::class, 'preguntas_expertos_id');
    }
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'profesional_id');
    }
}
