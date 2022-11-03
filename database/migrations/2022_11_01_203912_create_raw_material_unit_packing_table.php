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
        Schema::create('raw_material_unit_packing', function (Blueprint $table) {
            $table->id();
            $table->string('packing');
            $table->unsignedBigInteger('raw_material_id');
            $table->unsignedBigInteger('unit_packing_id');
            $table->foreign('raw_material_id')->references('id')->on('raw_materials');
            $table->foreign('unit_packing_id')->references('id')->on('unit_packings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_material_unit_packing');
    }
};
