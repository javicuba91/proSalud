<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = "metodos_pagos";

    protected $fillable = ['nombre'];

    public function profesionales()
    {
        return $this->belongsToMany(Profesional::class, 'metodo_pago_profesional');
    }
}
