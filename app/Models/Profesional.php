<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table = "profesionales";

    protected $fillable = ['plan_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function titulosUniversitarios()
    {
        return $this->hasMany(TituloUniversitario::class);
    }

    public function especializaciones()
    {
        return $this->hasMany(EspecializacionesProfesional::class);
    }

    public function formacionesAdicionales()
    {
        return $this->hasMany(FormacionAdicional::class);
    }

    public function experienciasLaborales()
    {
        return $this->hasMany(ExperienciaLaboral::class);
    }

    public function consultorios()
    {
        return $this->hasMany(ConsultorioProfesional::class);
    }

    public function segurosMedicos()
    {
        return $this->belongsToMany(SegurosMedicos::class, 'profesional_seguro', 'profesional_id', 'seguro_id');
    }


    public function horarios()
    {
        return $this->hasMany(HorarioProfesional::class);
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoProfesional::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function suscripciones()
    {
        return $this->hasMany(SuscripcionPlan::class);
    }

    public function suscripcion()
    {
        return $this->hasOne(SuscripcionPlan::class)->latestOfMany();
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function contactos()
    {
        return $this->hasMany(ContactoAdminProfesional::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function metodosPago()
    {
        return $this->belongsToMany(MetodoPago::class, 'metodo_pago_profesional');
    }

}
