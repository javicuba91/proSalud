<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoAdminProfesional extends Model
{
    protected $table = "contactos_admin";

    protected $fillable = [
        'profesional_id', 'motivo', 'descripcion', 'estado'
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }
}
