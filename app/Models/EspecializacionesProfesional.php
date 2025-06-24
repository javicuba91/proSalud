<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecializacionesProfesional extends Model
{
    protected $table = "especializaciones";

    protected $fillable = [
        'profesional_id',
        'especialidad_id',
        'sub_especialidad_id'
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function subespecialidad()
    {
        return $this->belongsTo(Especialidad::class,'sub_especialidad_id');
    }
}
