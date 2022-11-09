<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('count_items', function (Blueprint $table) {
            $table->renameColumn('price', 'cost');
        });
        Schema::table('count_items', function (Blueprint $table) {
            $table->string('cost')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('count_items', function (Blueprint $table) {
            $table->renameColumn('cost', 'price');
        });
        Schema::table('count_items', function (Blueprint $table) {
            $table->string('price')
                ->nullable(false)
                ->change();
        });
    }
};
