<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaProfesionalesTable extends Migration
{
    public function up()
    {
        Schema::create('categoria_profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::table('profesionales', function (Blueprint $table) {
            $table->foreignId('categoria_id')->nullable()->constrained('categoria_profesionales')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('profesionales', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });

        Schema::dropIfExists('categoria_profesionales');
    }
}
