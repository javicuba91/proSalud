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
        Schema::table('proveedores', function (Blueprint $table) {
            if (!Schema::hasColumn('proveedores', 'propietario_id')) {
                $table->unsignedBigInteger('propietario_id')->nullable();
                $table->foreign('propietario_id')->references('id')->on('propietarios')->onDelete('set null');
            }
            // Eliminado seguros_id, la relación de seguros es muchos a muchos usando la tabla pivote seguros_proveedores
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropForeign(['propietario_id']);
            $table->dropForeign(['seguros_id']);
            $table->dropColumn(['propietario_id', 'seguros_id']);
        });
    }
};
