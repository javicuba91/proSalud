<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosProveedor extends Model
{
    protected $table = "documentos_proveedores";
    protected $fillable = [
        'proveedor_id',
        'tipo',
        'archivo',
        'nombre',
        'estado'
    ];
}
