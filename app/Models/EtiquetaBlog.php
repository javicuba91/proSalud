<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EtiquetaBlog extends Model
{
    protected $table = 'etiquetas_blog';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'color'
    ];

    // Relaciones
    public function articulos()
    {
        return $this->belongsToMany(ArticuloBlog::class, 'articulo_etiqueta', 'etiqueta_id', 'articulo_id');
    }

    // Mutadores
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Métodos auxiliares
    public function conteoArticulos()
    {
        return $this->articulos()->publicado()->count();
    }
}
