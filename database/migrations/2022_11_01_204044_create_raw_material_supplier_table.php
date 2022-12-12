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
        if (! Schema::hasTable('raw_material_supplier')) {
            Schema::create('raw_material_supplier', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('raw_material_id');
                $table->unsignedBigInteger('supplier_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_material_supplier');
    }
};
