<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\PreguntasExpertosSeeder;

class CrearPreguntasEjemplo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crear-preguntas-ejemplo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear preguntas de ejemplo para el sistema de expertos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creando preguntas de ejemplo...');

        $seeder = new PreguntasExpertosSeeder();
        $seeder->run();

        $this->info('✅ Preguntas de ejemplo creadas exitosamente!');
        $this->line('Los profesionales ahora pueden ver y responder preguntas en su panel.');

        return 0;
    }
}
