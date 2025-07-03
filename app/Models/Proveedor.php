<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
        'user_id',
        'tipo',
        'nombre',
        'ciudad',
        'direccion',
        'numero_identificacion',
        'email',
        'telefono',
        'propietario_id',
        'seguros_id',
        'especializacion',
        'licencia',
        'direccion_maps',
        'imagenes',
        'imagen_corporativa',
        'informacion_adicional',
        'listado_servicios',
        'horarios',
        'clinica_edificio',
        'plan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
    public function seguros()
    {
        return $this->belongsTo(SegurosMedicos::class, 'seguros_id');
    }

    public function segurosMedicos()
    {
        return $this->belongsToMany(SegurosMedicos::class, 'seguros_proveedores', 'proveedor_id', 'seguros_id');
    }
    public function documentos()
    {
        return $this->hasMany(DocumentosProveedor::class, 'proveedor_id');
    }
    public function suscripciones()
    {
        return $this->hasOne(SuscripcionesPlanesProveedores::class, 'proveedores_id');
    }

    public function documentosAprobados()
    {
        // Si no tiene documentos, retorna false
        if ($this->documentos()->count() === 0) {
            return false;
        }
        // Si todos los documentos están aprobados
        return $this->documentos()->where('estado', '!=', 'aprobado')->count() === 0;
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}
