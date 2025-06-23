<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    //
    protected $table = "detalle_cita";

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }


    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }
}
