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
        Schema::create('detalle_horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('horario_id');
            $table->time('hora_desde');
            $table->time('hora_hasta');
            $table->boolean('bloqueado')->default(false);
            $table->unsignedBigInteger('consultorio_id')->nullable();
            $table->timestamps();

            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_horarios');
    }
};
