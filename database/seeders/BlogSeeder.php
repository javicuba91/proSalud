<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaBlog;
use App\Models\EtiquetaBlog;
use App\Models\ArticuloBlog;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear categorías del blog
        $categorias = [
            [
                'nombre' => 'Salud General',
                'descripcion' => 'Artículos sobre salud general y bienestar',
                'color' => '#007bff',
                'activo' => true
            ],
            [
                'nombre' => 'Nutrición',
                'descripcion' => 'Consejos y guías sobre nutrición y alimentación saludable',
                'color' => '#28a745',
                'activo' => true
            ],
            [
                'nombre' => 'Medicina Preventiva',
                'descripcion' => 'Información sobre prevención de enfermedades',
                'color' => '#ffc107',
                'activo' => true
            ],
            [
                'nombre' => 'Tecnología Médica',
                'descripcion' => 'Avances en tecnología aplicada a la medicina',
                'color' => '#6f42c1',
                'activo' => true
            ],
            [
                'nombre' => 'Noticias',
                'descripcion' => 'Noticias y actualizaciones del sector salud',
                'color' => '#dc3545',
                'activo' => true
            ]
        ];

        foreach ($categorias as $categoria) {
            CategoriaBlog::create($categoria);
        }

        // Crear etiquetas del blog
        $etiquetas = [
            ['nombre' => 'Consejos', 'descripcion' => 'Consejos prácticos de salud', 'color' => '#17a2b8'],
            ['nombre' => 'Investigación', 'descripcion' => 'Estudios e investigaciones médicas', 'color' => '#6610f2'],
            ['nombre' => 'Ejercicio', 'descripcion' => 'Actividad física y ejercicio', 'color' => '#e83e8c'],
            ['nombre' => 'Alimentación', 'descripcion' => 'Dieta y alimentación saludable', 'color' => '#fd7e14'],
            ['nombre' => 'Mental', 'descripcion' => 'Salud mental y bienestar emocional', 'color' => '#20c997'],
            ['nombre' => 'Prevención', 'descripcion' => 'Medidas preventivas de salud', 'color' => '#ffc107'],
            ['nombre' => 'Tratamiento', 'descripcion' => 'Tratamientos y terapias médicas', 'color' => '#dc3545'],
            ['nombre' => 'Innovación', 'descripcion' => 'Innovaciones en el campo médico', 'color' => '#6f42c1']
        ];

        foreach ($etiquetas as $etiqueta) {
            EtiquetaBlog::create($etiqueta);
        }

        // Obtener un usuario admin para ser el autor (si existe)
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            // Si no hay admin, usar el primer usuario disponible
            $admin = User::first();
        }

        if ($admin) {
            // Crear artículos de ejemplo
            $articulos = [
                [
                    'titulo' => '10 Consejos para Mantener una Vida Saludable',
                    'resumen' => 'Descubre los mejores consejos para mantener un estilo de vida saludable y mejorar tu bienestar general.',
                    'contenido' => '<p>Mantener una vida saludable es fundamental para nuestro bienestar físico y mental. En este artículo, te compartimos 10 consejos esenciales que te ayudarán a mejorar tu calidad de vida.</p><h3>1. Alimentación Balanceada</h3><p>Una dieta equilibrada es la base de una buena salud. Incluye frutas, verduras, proteínas magras y granos integrales en tus comidas diarias.</p><h3>2. Ejercicio Regular</h3><p>Realiza al menos 30 minutos de actividad física moderada la mayoría de los días de la semana.</p><p>Continúa leyendo para descubrir los 8 consejos restantes que transformarán tu vida...</p>',
                    'categoria_id' => 1,
                    'autor_id' => $admin->id,
                    'estado' => 'publicado',
                    'fecha_publicacion' => now()->subDays(5),
                    'destacado' => true,
                    'vistas' => 150,
                    'seo' => [
                        'title' => '10 Consejos para una Vida Saludable | ProSalud',
                        'description' => 'Aprende los mejores consejos para mantener un estilo de vida saludable. Guía completa de bienestar y salud.',
                        'keywords' => 'vida saludable, consejos salud, bienestar, alimentación, ejercicio'
                    ]
                ],
                [
                    'titulo' => 'La Importancia de la Nutrición en el Rendimiento Deportivo',
                    'resumen' => 'Conoce cómo una nutrición adecuada puede mejorar significativamente tu rendimiento deportivo y tiempo de recuperación.',
                    'contenido' => '<p>La nutrición juega un papel crucial en el rendimiento deportivo. Los atletas y personas activas necesitan una alimentación específica para optimizar su rendimiento.</p><h3>Macronutrientes Esenciales</h3><p>Los carbohidratos proporcionan la energía necesaria para el ejercicio intenso, mientras que las proteínas son fundamentales para la reparación muscular.</p><h3>Hidratación</h3><p>Mantener una hidratación adecuada es crucial para el rendimiento óptimo.</p>',
                    'categoria_id' => 2,
                    'autor_id' => $admin->id,
                    'estado' => 'publicado',
                    'fecha_publicacion' => now()->subDays(3),
                    'destacado' => false,
                    'vistas' => 89,
                    'seo' => [
                        'title' => 'Nutrición Deportiva | Guía Completa',
                        'description' => 'Descubre cómo la nutrición adecuada mejora el rendimiento deportivo. Consejos de expertos en nutrición.',
                        'keywords' => 'nutrición deportiva, rendimiento, alimentación deportistas, proteínas, carbohidratos'
                    ]
                ],
                [
                    'titulo' => 'Telemedicina: El Futuro de la Atención Médica',
                    'resumen' => 'Explora cómo la telemedicina está revolucionando la forma en que recibimos atención médica, especialmente en tiempos post-pandemia.',
                    'contenido' => '<p>La telemedicina ha experimentado un crecimiento exponencial, transformando la manera en que médicos y pacientes interactúan.</p><h3>Ventajas de la Telemedicina</h3><ul><li>Acceso remoto a especialistas</li><li>Reducción de tiempos de espera</li><li>Menor exposición a enfermedades contagiosas</li><li>Ahorro en costos de transporte</li></ul><h3>Desafíos y Consideraciones</h3><p>A pesar de sus beneficios, la telemedicina también presenta ciertos desafíos que deben ser considerados.</p>',
                    'categoria_id' => 4,
                    'autor_id' => $admin->id,
                    'estado' => 'publicado',
                    'fecha_publicacion' => now()->subDays(1),
                    'destacado' => true,
                    'vistas' => 234,
                    'seo' => [
                        'title' => 'Telemedicina: Revolución en Salud Digital',
                        'description' => 'Conoce cómo la telemedicina está cambiando la atención médica. Beneficios y desafíos de la salud digital.',
                        'keywords' => 'telemedicina, salud digital, consulta online, tecnología médica'
                    ]
                ]
            ];

            foreach ($articulos as $articuloData) {
                $articulo = ArticuloBlog::create($articuloData);

                // Asignar etiquetas aleatorias a cada artículo
                $etiquetasAleatorias = EtiquetaBlog::inRandomOrder()->take(rand(2, 4))->pluck('id');
                $articulo->etiquetas()->sync($etiquetasAleatorias);
            }
        }
    }
}
