<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaExperto extends Model
{
    //
    protected $table = "preguntas_expertos";

    protected $fillable = [
        'especialidad_id',
        'sub_especialidad_id',
        'pregunta',
        'categoria_id',

    ];

    public function respuestas()
    {
        return $this->hasMany(RespuestaExperto::class, 'preguntas_expertos_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function subespecialidad()
    {
        return $this->belongsTo(Especialidad::class, 'sub_especialidad_id');
    }
    public function categoria()
    {
        return $this->belongsTo(CategoriaProfesional::class, 'categoria_id');
    }
}
