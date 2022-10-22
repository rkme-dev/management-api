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
        Schema::table('sales_drs', function (Blueprint $table) {
            $table->string('address')->nullable();
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->string('address')->nullable();
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('sales_drs', ['address']);
        Schema::dropColumns('sales_orders', ['address']);
        Schema::dropColumns('collections', ['address']);
    }
};
