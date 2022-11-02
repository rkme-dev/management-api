<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('count_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physical_count_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('brand');
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('group_1');
            $table->string('group_2');
            $table->string('unit');
            $table->string('quantity');
            $table->string('price');
            $table->string('total_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('count_items');
    }
};
