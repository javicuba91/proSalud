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
        Schema::create('articulos_blog', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('resumen');
            $table->longText('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->enum('estado', ['borrador', 'publicado', 'archivado'])->default('borrador');
            $table->foreignId('categoria_id')->constrained('categorias_blog')->onDelete('cascade');
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('fecha_publicacion')->nullable();
            $table->json('seo')->nullable(); // Para meta título, descripción, keywords
            $table->integer('vistas')->default(0);
            $table->boolean('destacado')->default(false);
            $table->boolean('permite_comentarios')->default(true);
            $table->timestamps();

            // Índices
            $table->index(['estado', 'fecha_publicacion']);
            $table->index('slug');
            $table->index('destacado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos_blog');
    }
};
