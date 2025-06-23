<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentacionMedicamento extends Model
{
    //
    protected $table = "presentacion_medicamentos";

    protected $fillable = ['nombre'];
}
