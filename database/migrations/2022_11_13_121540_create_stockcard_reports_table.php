<?php

use App\Models\Product;
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
        Schema::create('stockcard_reports', function (Blueprint $table) {
            $table->id();
            $table->morphs('morphable');
            $table->foreignIdFor(Product::class, 'product_id');
            $table->timestamp('date');
            $table->string('event')->nullable();
            $table->string('document')->nullable();
            $table->string('document_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->nullable();
            $table->string('quantity_in')->nullable();
            $table->string('quantity_out')->nullable();
            $table->string('balance')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockcard_reports');
    }
};
