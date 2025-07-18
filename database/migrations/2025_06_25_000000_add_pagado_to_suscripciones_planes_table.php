<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('suscripciones_planes', function (Blueprint $table) {
            if (!Schema::hasColumn('suscripciones_planes', 'pagado')) {
                $table->boolean('pagado')->default(false)->after('plan_id');
            }
        });
    }

    public function down()
    {
        Schema::table('suscripciones_planes', function (Blueprint $table) {
            if (Schema::hasColumn('suscripciones_planes', 'pagado')) {
                $table->dropColumn('pagado');
            }
        });
    }
};
