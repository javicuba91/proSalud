<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSanitariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos los IDs de las categorías profesionales
        $odontologiaId = DB::table('categoria_profesionales')->where('nombre', 'Dentisas')->value('id');
        $psicologiaId = DB::table('categoria_profesionales')->where('nombre', 'Psicólogos')->value('id');

        // Verificamos que las categorías existan
        if (!$odontologiaId || !$psicologiaId) {
            throw new \Exception('Las categorías "Dentisas" y "Psicólogos" deben existir en la tabla categoria_profesionales');
        }

        // Especialidades de Dentisas
        $especialidadesOdontologia = [
            [
                'nombre' => 'Odontología General',
                'descripcion' => 'Diagnóstico, tratamiento y prevención de enfermedades orales comunes',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ortodoncia y Ortopedia Dentofacial',
                'descripcion' => 'Corrección de la posición de los dientes y estructuras maxilofaciales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Endodoncia',
                'descripcion' => 'Tratamiento de la pulpa dental y tejidos periapicales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Periodoncia',
                'descripcion' => 'Tratamiento de enfermedades de las encías y estructuras de soporte dental',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cirugía Oral y Maxilofacial',
                'descripcion' => 'Cirugía de la cavidad oral, maxilares y estructuras faciales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Odontopediatría',
                'descripcion' => 'Atención dental especializada para niños y adolescentes',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Prostodoncia',
                'descripcion' => 'Rehabilitación oral mediante prótesis dentales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Radiología Oral y Maxilofacial',
                'descripcion' => 'Diagnóstico por imágenes de estructuras orales y maxilofaciales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Patología Oral y Maxilofacial',
                'descripcion' => 'Diagnóstico de enfermedades de la cavidad oral y estructuras relacionadas',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Odontología Estética o Cosmética',
                'descripcion' => 'Mejora de la apariencia y estética dental',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Implantología Oral',
                'descripcion' => 'Colocación y rehabilitación de implantes dentales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Medicina Oral',
                'descripcion' => 'Diagnóstico y tratamiento médico de enfermedades orales',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Odontogeriatría',
                'descripcion' => 'Atención dental especializada para adultos mayores',
                'categoria_id' => $odontologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Especialidades de Psicología
        $especialidadesPsicologia = [
            [
                'nombre' => 'Psicología Clínica',
                'descripcion' => 'Evaluación, diagnóstico y tratamiento de trastornos mentales',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología de la Salud',
                'descripcion' => 'Aplicación de principios psicológicos en el ámbito de la salud',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Educativa',
                'descripcion' => 'Aplicación de principios psicológicos en el contexto educativo',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología del Desarrollo',
                'descripcion' => 'Estudio del desarrollo humano a lo largo del ciclo vital',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Organizacional / Laboral',
                'descripcion' => 'Aplicación de principios psicológicos en el ámbito laboral',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Social',
                'descripcion' => 'Estudio del comportamiento humano en contextos sociales',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Forense / Jurídica',
                'descripcion' => 'Aplicación de la psicología en el ámbito legal y judicial',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Neuropsicología',
                'descripcion' => 'Estudio de la relación entre el cerebro y el comportamiento',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Infantil / Adolescente',
                'descripcion' => 'Atención psicológica especializada para niños y adolescentes',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicogerontología',
                'descripcion' => 'Atención psicológica especializada para adultos mayores',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología del Deporte',
                'descripcion' => 'Aplicación de principios psicológicos en el ámbito deportivo',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Comunitaria',
                'descripcion' => 'Intervención psicológica a nivel comunitario y social',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Ambiental',
                'descripcion' => 'Estudio de la interacción entre las personas y su entorno',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Experimental',
                'descripcion' => 'Investigación experimental en procesos psicológicos',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicometría',
                'descripcion' => 'Medición y evaluación de procesos psicológicos',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Psicología Humanitaria y de Emergencias',
                'descripcion' => 'Atención psicológica en situaciones de crisis y emergencias',
                'categoria_id' => $psicologiaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar las especialidades en la base de datos
        DB::table('especialidades_sanitarios')->insert(array_merge($especialidadesOdontologia, $especialidadesPsicologia));

        $this->command->info('Especialidades sanitarias insertadas correctamente');
    }
}
