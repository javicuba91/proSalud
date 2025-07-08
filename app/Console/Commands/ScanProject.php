<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ScanProject extends Command
{
    protected $signature = 'scan:project';
    protected $description = 'Escanea el proyecto y lista modelos, controladores, vistas y rutas';

    public function handle()
    {
        $this->info("🔍 Escaneando proyecto Laravel...\n");

        // Modelos
        $this->sectionTitle("📦 Modelos");
        $models = File::allFiles(app_path('Models'));
        foreach ($models as $model) {
            $this->line($model->getFilename());
        }

        // Controladores
        $this->sectionTitle("🧭 Controladores");
        $controllers = File::allFiles(app_path('Http/Controllers'));
        foreach ($controllers as $controller) {
            $this->line($controller->getFilename());
        }

        // Vistas
        $this->sectionTitle("🖼️ Vistas");
        $views = File::allFiles(resource_path('views'));
        foreach ($views as $view) {
            $this->line(str_replace(resource_path('views') . '/', '', $view->getPathname()));
        }

        // Rutas
        $this->sectionTitle("🛣️ Rutas");
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return sprintf(
                "[%s] %s → %s",
                implode('|', $route->methods()),
                $route->uri(),
                $route->getActionName()
            );
        });

        foreach ($routes as $route) {
            $this->line($route);
        }

        $this->info("\n✅ Escaneo completo.");
        return Command::SUCCESS;
    }

    protected function sectionTitle($title)
    {
        $this->info("\n===============================");
        $this->info($title);
        $this->info("===============================\n");
    }
}
