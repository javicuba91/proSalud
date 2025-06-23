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
        Schema::create('informes_consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->onDelete('cascade');

            $table->text('motivo_consulta')->nullable();
            $table->text('antecedentes_familiares')->nullable();
            $table->text('antecedentes_personales')->nullable();
            $table->text('enfermedad_actual')->nullable();
            $table->text('exploracion_fisica')->nullable();
            $table->text('pruebas_complementarias')->nullable();
            $table->text('juicio_clinico')->nullable();
            $table->text('dibujo_dental')->nullable();
            $table->text('plan_terapeutico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes_consultas');
    }
};
