<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeConsulta extends Model
{
    protected $table = "informes_consultas";

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }

}
