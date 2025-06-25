<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoProfesional extends Model
{
        protected $table = "documentos_profesional";

        protected $fillable = ['profesional_id', 'nombre', 'tipo', 'archivo', 'estado'];

        public function profesional()
        {
                return $this->belongsTo(Profesional::class);
        }
}
