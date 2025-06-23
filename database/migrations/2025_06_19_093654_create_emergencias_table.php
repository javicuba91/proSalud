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
        Schema::create('emergencias', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Farmacia 24 horas', 'Ambulancia 24 horas']);
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('ciudad_id');
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergencias');
    }
};
