<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeConsulta extends Model
{
    protected $table = "informes_consultas";

    // App\Models\InformeConsulta.php

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

}
