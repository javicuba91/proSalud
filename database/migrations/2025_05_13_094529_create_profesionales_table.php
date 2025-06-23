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
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('logo')->nullable();
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['Hombre', 'Mujer', 'Otro'])->nullable();
            $table->string('telefono_personal')->nullable();
            $table->string('telefono_profesional')->nullable();
            $table->string('cedula_identidad')->nullable();
            $table->string('email')->unique();
            $table->string('idiomas')->nullable();
            $table->text('descripcion_profesional')->nullable();
            $table->integer('anios_experiencia')->nullable();
            $table->string('licencia_medica')->nullable(); // archivo
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('contrasena');
            $table->string('numero_cuenta')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};
