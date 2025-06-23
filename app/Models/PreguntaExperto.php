<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaExperto extends Model
{
    //
    protected $table = "preguntas_expertos";

    public function respuestas()
    {
        return $this->hasMany(RespuestaExperto::class);
    }
    
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
    
    public function subespecialidad()
{
    return $this->belongsTo(Especialidad::class, 'sub_especialidad_id');
}
}
