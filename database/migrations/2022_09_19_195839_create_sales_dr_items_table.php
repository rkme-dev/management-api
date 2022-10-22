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
        Schema::create('sales_dr_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_dr_id');
            $table->unsignedBigInteger('sales_order_item_id');
            $table->unsignedBigInteger('sales_dr_item_id');
            $table->timestamps();

            $table->foreign('sales_dr_id')->references('id')->on('sales_drs');
            $table->foreign('sales_order_item_id')->references('id')->on('order_items');
            $table->foreign('sales_dr_item_id')->references('id')->on('order_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_dr_items');
    }
};
