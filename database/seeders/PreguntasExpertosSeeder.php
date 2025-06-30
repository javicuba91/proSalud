<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreguntaExperto;
use App\Models\Especialidad;

class PreguntasExpertosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener algunas especialidades para las preguntas de ejemplo
        $cardiologia = Especialidad::where('nombre', 'like', '%cardiolog%')->first();
        $neurologia = Especialidad::where('nombre', 'like', '%neurolog%')->first();
        $ginecologia = Especialidad::where('nombre', 'like', '%ginecolog%')->first();
        $pediatria = Especialidad::where('nombre', 'like', '%pediatr%')->first();
        
        // Si no existen las especialidades, usar las primeras disponibles
        if (!$cardiologia) $cardiologia = Especialidad::first();
        if (!$neurologia) $neurologia = Especialidad::skip(1)->first();
        if (!$ginecologia) $ginecologia = Especialidad::skip(2)->first();
        if (!$pediatria) $pediatria = Especialidad::skip(3)->first();

        $preguntas = [
            [
                'especialidad_id' => $cardiologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Cuáles son los síntomas principales de un infarto y cómo puedo diferenciarlos de otros dolores en el pecho?'
            ],
            [
                'especialidad_id' => $cardiologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Es normal que mi presión arterial varíe durante el día? ¿Cuándo debería preocuparme?'
            ],
            [
                'especialidad_id' => $neurologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Las migrañas frecuentes pueden ser síntoma de algo más grave? ¿Cuándo debo consultar?'
            ],
            [
                'especialidad_id' => $neurologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => 'He notado pérdida de memoria ocasional. ¿Cuándo es normal por la edad y cuándo puede ser preocupante?'
            ],
            [
                'especialidad_id' => $ginecologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Con qué frecuencia debería realizarme un examen ginecológico? ¿Qué incluye una revisión completa?'
            ],
            [
                'especialidad_id' => $ginecologia?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Cuáles son las opciones de anticonceptivos más seguras y eficaces? ¿Cómo elegir el mejor para mí?'
            ],
            [
                'especialidad_id' => $pediatria?->id,
                'sub_especialidad_id' => null,
                'pregunta' => '¿Cuál es el calendario de vacunación recomendado para bebés? ¿Qué hacer si me retraso?'
            ],
            [
                'especialidad_id' => $pediatria?->id,
                'sub_especialidad_id' => null,
                'pregunta' => 'Mi hijo de 3 años tiene fiebre frecuente. ¿Cuándo es normal y cuándo debo preocuparme?'
            ]
        ];

        foreach ($preguntas as $pregunta) {
            if ($pregunta['especialidad_id']) {
                PreguntaExperto::create($pregunta);
            }
        }
    }
}
