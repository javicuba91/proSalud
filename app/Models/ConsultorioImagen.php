<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultorioImagen extends Model
{
    protected $table = "consultorio_imagenes";
    
    protected $fillable = ['consultorio_id', 'imagen_path'];

    public function consultorio()
    {
        return $this->belongsTo(ConsultorioProfesional::class);
    }
}
