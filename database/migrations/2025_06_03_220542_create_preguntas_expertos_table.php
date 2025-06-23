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
        Schema::create('preguntas_expertos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades')->onDelete('set null');
            $table->foreignId('sub_especialidad_id')->nullable()->constrained('especialidades')->onDelete('set null');
            $table->text('pregunta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas_expertos');
    }
};
