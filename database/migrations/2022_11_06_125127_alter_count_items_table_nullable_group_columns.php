<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('count_items', function (Blueprint $table) {
            $table->string('group_1')->nullable()->change();
            $table->string('group_2')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('count_items', function (Blueprint $table) {
            $table->string('group_1')->nullable(false)->change();
            $table->string('group_2')->nullable(false)->change();
        });
    }
};
