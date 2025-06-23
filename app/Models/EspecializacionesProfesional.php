<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecializacionesProfesional extends Model
{
    //
    protected $table = "especializaciones";

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function subespecialidad()
    {
        return $this->belongsTo(Especialidad::class,'sub_especialidad_id');
    }
}
