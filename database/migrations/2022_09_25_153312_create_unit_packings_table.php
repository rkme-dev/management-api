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
        Schema::create('unit_packings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('product_unit_packing', function (Blueprint $table) {
            $table->id();
            $table->string('packing');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('unit_packing_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('unit_packing_id')->references('id')->on('unit_packings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_unit_packing');
        Schema::dropIfExists('unit_packings');
    }
};
