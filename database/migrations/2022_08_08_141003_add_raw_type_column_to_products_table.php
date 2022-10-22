<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('products', 'raw_material_type') === true) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            $table->string('raw_material_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'raw_material_type') === false) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('raw_material_type');
        });
    }
};
