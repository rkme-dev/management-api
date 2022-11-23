<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales_drs', function (Blueprint $table) {
            $table->boolean('has_collection')->nullable()->default(false);
        });
    }

    public function down()
    {
        Schema::table('sales_drs', function (Blueprint $table) {
            $table->dropColumn('has_collection');
        });
    }
};
