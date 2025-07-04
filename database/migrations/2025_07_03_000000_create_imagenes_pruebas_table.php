<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('imagenes_pruebas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prueba_id');
            $table->string('ruta');
            $table->string('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('prueba_id')->references('id')->on('pruebas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes_pruebas');
    }
};
