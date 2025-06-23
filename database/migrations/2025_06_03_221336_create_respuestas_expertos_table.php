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
        Schema::create('respuestas_expertos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preguntas_expertos_id')->nullable()->constrained('preguntas_expertos')->onDelete('set null');
            $table->text('respuesta');
            $table->foreignId('profesional_id')->nullable()->constrained('profesionales')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_expertos');
    }
};
