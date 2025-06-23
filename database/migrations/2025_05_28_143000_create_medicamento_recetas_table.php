<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicamentos_recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receta_id')->constrained('recetas')->onDelete('cascade');
            $table->foreignId('medicamento_id')->constrained('medicamentos')->onDelete('cascade');
            $table->foreignId('presentacion_medicamentos_id')->constrained('presentacion_medicamentos')->onDelete('cascade');
            $table->string('dosis');
            $table->foreignId('via_administracion_medicamentos_id')->constrained('via_administracion_medicamentos')->onDelete('cascade');
            $table->foreignId('intervalo_medicamentos_id')->constrained('intervalo_medicamentos')->onDelete('cascade');
            $table->string('duracion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_recetas');
    }
};
