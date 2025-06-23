<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";

    protected $fillable = [
        'paciente_id',
        'profesional_id',
        'fecha_hora',
        'modalidad',
        'motivo',
        'consultorio_id',
        'url_meet',
        'codigo_qr',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(ConsultorioProfesional::class);
    }

    public function informeConsulta()
    {
        return $this->hasOne(InformeConsulta::class);
    }

    public function detalleCita()
    {
        return $this->hasOne(DetalleCita::class);
    }

    public function especializacion()
    {
        return $this->belongsTo(EspecializacionesProfesional::class,'especializacion_id');
    }
}
