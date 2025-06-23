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
        Schema::create('detalle_cita', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cita_id')->constrained('citas')->onDelete('cascade');
            $table->foreignId('metodo_pago_id')->nullable()->constrained('metodos_pagos')->onDelete('set null');

            $table->enum('estado_pago', ['pendiente', 'pagado', 'cancelado'])->default('pendiente');
            $table->date('fecha_pago')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_cita');
    }
};
