<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValoracionProveedor extends Model
{
    protected $table = "valoraciones_proveedores";

    protected $fillable = [
        'paciente_id',
        'proveedor_id',
        'fecha',
        'modalidad',
        'puntuacion',
        'comentario',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
