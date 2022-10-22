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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('actual_quantity')->after('quantity')->nullable();
            $table->string('total_box')->after('actual_quantity')->nullable();
            $table->string('pieces_per_box')->after('total_box')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('actual_quantity');
            $table->dropColumn('total_box');
            $table->dropColumn('pieces_per_box');
        });
    }
};
