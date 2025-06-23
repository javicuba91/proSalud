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
        Schema::table('especializaciones', function (Blueprint $table) {
            $table->decimal('precio_presencial', 8, 2)
                  ->default(0);
            $table->decimal('precio_videoconsulta', 8, 2)
                  ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('especializaciones', function (Blueprint $table) {
            $table->dropColumn(['precio_presencial', 'precio_videoconsulta']);
        });
    }
};
