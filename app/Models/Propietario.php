<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $table = "propietarios";

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'genero',
        'telefono_personal',
        'cedula_identidad',
        'telefono_profesional',
        'email',
        'proveedor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }
}
