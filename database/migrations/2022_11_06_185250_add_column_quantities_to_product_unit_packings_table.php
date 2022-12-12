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
        Schema::table('product_unit_packing', function (Blueprint $table) {
            $table->string('actual_balance')->nullable();
            $table->string('reserved_balance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_unit_packing', function (Blueprint $table) {
            $table->removeColumn('actual_balance');
            $table->removeColumn('reserved_balance');
        });
    }
};
