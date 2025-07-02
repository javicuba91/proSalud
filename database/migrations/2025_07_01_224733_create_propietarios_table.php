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
        Schema::create('propietarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['Hombre', 'Mujer', 'Otro'])->nullable();
            $table->string('telefono_personal', 20)->nullable();
            $table->string('cedula_identidad', 30)->nullable();
            $table->string('telefono_profesional', 20)->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietarios');
    }
};
