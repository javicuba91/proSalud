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
        Schema::create('articulo_etiqueta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('articulo_id')->constrained('articulos_blog')->onDelete('cascade');
            $table->foreignId('etiqueta_id')->constrained('etiquetas_blog')->onDelete('cascade');
            $table->timestamps();

            // Evitar duplicados
            $table->unique(['articulo_id', 'etiqueta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo_etiqueta');
    }
};
