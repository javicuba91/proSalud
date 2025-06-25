<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoriaBlog extends Model
{
    protected $table = 'categorias_blog';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function articulos()
    {
        return $this->hasMany(ArticuloBlog::class, 'categoria_id');
    }

    // Mutadores
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scopes
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }
}
