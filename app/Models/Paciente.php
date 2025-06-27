<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = "pacientes";

    protected $fillable = [
        'user_id',
        'nombre_completo',
        'fecha_nacimiento',
        'genero',
        'estado_civil',
        'nacionalidad',
        'celular',
        'email',
        'direccion',
        'cedula',
        'grupo_sanguineo',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antecedentes()
    {
        return $this->hasMany(Antecedente::class);
    }

    public function contactos_emergencia()
    {
        return $this->hasMany(ContactosEmergencia::class);
    }

    public function segurosMedicos()
    {
        return $this->belongsToMany(SegurosMedicos::class, 'paciente_seguro', 'paciente_id', 'seguro_id');
    }

    public function citas() {
        return $this->hasMany(Cita::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

}
