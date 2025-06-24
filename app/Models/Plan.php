<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = "planes";
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'caracteristicas',
    ];
    public function profesionales()
{
    return $this->hasMany(Profesional::class);
}

}
