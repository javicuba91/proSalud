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
        Schema::create('consultorio_imagenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultorio_id');
            $table->string('imagen_path');
            $table->timestamps();
        
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultorio_imagenes');
    }
};
