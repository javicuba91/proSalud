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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
        
            // Relaciones
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('profesional_id')->constrained('profesionales')->onDelete('cascade');
        
            // Información principal
            $table->dateTime('fecha_hora');
            $table->string('codigo_qr')->unique();
            $table->enum('modalidad', ['presencial', 'videoconsulta']);
            $table->string('motivo')->nullable();
        
            // Información del consultorio (si aplica)
            $table->foreignId('consultorio_id')->nullable()->constrained('consultorios')->nullOnDelete();
            
            // Información de la url del Meet que se genera
            $table->string('url_meet')->nullable();

            // Estado de la cita
            $table->enum('estado', ['pendiente', 'aceptada', 'cancelada', 'completada'])->default('pendiente');
        
            // Recordatorios e historial
            $table->boolean('recordatorio_enviado')->default(false);
            $table->boolean('informe_creado')->default(false);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
