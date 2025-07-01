<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultorioProfesional extends Model
{
    protected $table = "consultorios";

    public function imagenes()
    {
        return $this->hasMany(ConsultorioImagen::class);
    }
}
