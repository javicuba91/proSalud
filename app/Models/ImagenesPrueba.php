<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenesPrueba extends Model
{
    protected $table = 'imagenes_pruebas';
    protected $fillable = [
        'prueba_id',
        'ruta',
        'descripcion',
    ];
    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }
}
