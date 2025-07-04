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
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_imagen_id')->constrained('pedido_imagenes')->onDelete('cascade')->nullable();
            $table->foreignId('pedido_laboratorio_id')->constrained('pedido_laboratorios')->onDelete('cascade')->nullable();
            $table->text('tipo')->nullable();
            $table->text('indicaciones')->nullable();
            $table->text('region_anatomica')->nullable();
            $table->enum('prioridad', ['urgente', 'programado'])->default('programado');
            $table->enum('estado', ['pendiente', 'completada'])->default('pendiente');
            $table->timestamps();
        });

        Schema::create('presupuestos_pruebas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prueba_id')->constrained('pruebas')->onDelete('cascade');
            $table->double('precio')->nullable();
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade');
            $table->enum('estado', ['pendiente', 'aprobado','denegado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pruebas');
        Schema::dropIfExists('presupuestos_pruebas');
    }
};
