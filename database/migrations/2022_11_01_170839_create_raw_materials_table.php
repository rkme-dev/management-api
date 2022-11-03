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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('price')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('name')->unique();
            $table->string('sku')->nullable();
            $table->string('control_no')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('grouping')->nullable();
            $table->string('unit')->nullable();
            $table->string('value')->nullable();
            $table->boolean('active');
            $table->string('type')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('unit_packings');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials');
    }
};
