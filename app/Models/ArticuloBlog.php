<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticuloBlog extends Model
{
    protected $table = 'articulos_blog';

    protected $fillable = [
        'titulo',
        'slug',
        'resumen',
        'contenido',
        'imagen_destacada',
        'estado',
        'categoria_id',
        'autor_id',
        'fecha_publicacion',
        'seo',
        'vistas',
        'destacado',
        'permite_comentarios'
    ];

    protected $casts = [
        'seo' => 'array',
        'fecha_publicacion' => 'datetime',
        'destacado' => 'boolean',
        'permite_comentarios' => 'boolean',
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(CategoriaBlog::class, 'categoria_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function etiquetas()
    {
        return $this->belongsToMany(EtiquetaBlog::class, 'articulo_etiqueta', 'articulo_id', 'etiqueta_id');
    }

    // Mutadores
    public function setTituloAttribute($value)
    {
        $this->attributes['titulo'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessors
    public function getResumenCortoAttribute()
    {
        return Str::limit($this->resumen, 100);
    }

    public function getTiempoLecturaAttribute()
    {
        $palabras = str_word_count(strip_tags($this->contenido));
        $minutos = max(1, round($palabras / 200)); // 200 palabras por minuto
        return $minutos;
    }

    // Scopes
    public function scopePublicado($query)
    {
        return $query->where('estado', 'publicado')
                    ->where('fecha_publicacion', '<=', now());
    }

    public function scopeDestacado($query)
    {
        return $query->where('destacado', true);
    }

    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where(function($q) use ($termino) {
            $q->where('titulo', 'like', "%{$termino}%")
              ->orWhere('resumen', 'like', "%{$termino}%")
              ->orWhere('contenido', 'like', "%{$termino}%");
        });
    }

    // Métodos auxiliares
    public function incrementarVistas()
    {
        $this->increment('vistas');
    }

    public function estaPublicado()
    {
        return $this->estado === 'publicado' &&
               $this->fecha_publicacion <= now();
    }
}
