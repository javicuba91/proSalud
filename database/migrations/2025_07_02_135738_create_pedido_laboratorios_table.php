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
        Schema::create('pedido_laboratorios', function (Blueprint $table) {
            $table->id();
            $table->string('qr')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->text('motivo')->nullable();
            $table->text('sintoma')->nullable();
            $table->text('antecedentes')->nullable();
            $table->foreignId('informe_consulta_id')->constrained('informes_consultas')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_laboratorios');
    }
};
