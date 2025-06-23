<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->unsignedBigInteger('especializacion_id')
                  ->nullable();

            $table->foreign('especializacion_id')
                  ->references('id')->on('especializaciones')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['especializacion_id']);
            $table->dropColumn('especializacion_id');
        });
    }
};
