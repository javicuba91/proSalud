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
        Schema::table('suscripciones_planes_proveedores', function (Blueprint $table) {
            $table->boolean('pagado')->default(false)->after('fecha_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suscripciones_planes_proveedores', function (Blueprint $table) {
            $table->dropColumn('pagado');
        });
    }
};
