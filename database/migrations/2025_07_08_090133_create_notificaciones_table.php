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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('mensaje');
            $table->string('tipo')->default('info'); // info, success, warning, danger
            $table->string('icono')->nullable();
            $table->string('url')->nullable();
            $table->boolean('leida')->default(false);
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('usuario_id_destino')->nullable();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usuario_id_destino')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
