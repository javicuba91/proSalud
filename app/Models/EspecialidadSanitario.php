<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecialidadSanitario extends Model
{
    protected $table = "especialidades_sanitarios";

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProfesional::class, 'categoria_id');
    }
}
