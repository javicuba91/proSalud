<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    //

    protected $table = "especialidades";

    protected $fillable = [
        'nombre',
        'descripcion',
        'padre_id',
    ];

    public function preguntasExpertos()
    {
        return $this->hasMany(PreguntaExperto::class);
    }

    public function preguntasExpertosComoSub()
    {
        return $this->hasMany(PreguntaExperto::class, 'sub_especialidad_id');
    }

    public function especializacionesProfesional()
    {
        return $this->hasMany(EspecializacionesProfesional::class);
    }

    public function padre()
    {
        return $this->belongsTo(Especialidad::class, 'padre_id');
    }

    public function hijos()
    {
        return $this->hasMany(Especialidad::class, 'padre_id');
    }
}
