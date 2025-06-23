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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informe_consulta_id')->constrained('informes_consultas')->onDelete('cascade');
            $table->string('qr');
            $table->datetime('fecha_emision');
            $table->text(column: 'diagnostico');
            $table->text(column: 'comentarios')->nullable();
            $table->string(column: 'ruta_firma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
