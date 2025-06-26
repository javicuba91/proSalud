<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('horarios_videollamada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesional_id');
            $table->string('dia_semana')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();

            $table->foreign('profesional_id')->references('id')->on('profesionales')->onDelete('cascade');
        });

        Schema::create('detalle_horarios_videollamada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('horario_id');
            $table->time('hora_desde');
            $table->time('hora_hasta');
            $table->boolean('bloqueado')->default(false);
            $table->timestamps();

            $table->foreign('horario_id')->references('id')->on('horarios_videollamada')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_horarios_videollamada');
        Schema::dropIfExists('horarios_videollamada');
    }
};
