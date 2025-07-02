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
            if (!Schema::hasColumn('proveedores', 'especializacion')) {
                $table->string('especializacion')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'licencia')) {
                $table->string('licencia')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'direccion_maps')) {
                $table->text('direccion_maps')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'imagenes')) {
                $table->text('imagenes')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'imagen_corporativa')) {
                $table->string('imagen_corporativa')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'informacion_adicional')) {
                $table->text('informacion_adicional')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'listado_servicios')) {
                $table->text('listado_servicios')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'horarios')) {
                $table->text('horarios')->nullable();
            }
            if (!Schema::hasColumn('proveedores', 'seguros_id')) {
                $table->unsignedBigInteger('seguros_id')->nullable();
                $table->foreign('seguros_id')->references('id')->on('seguros_medicos')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropForeign(['seguros_id']);
            $table->dropColumn([
                'especializacion',
                'licencia',
                'direccion_maps',
                'imagenes',
                'imagen_corporativa',
                'informacion_adicional',
                'listado_servicios',
                'horarios',
                'seguros_id'
            ]);
        });
    }
};
