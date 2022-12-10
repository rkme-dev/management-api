<?php

use App\Models\Product;
use App\Models\StockRequest;
use App\Models\UnitPacking;
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
        Schema::create('stock_request_produce_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockRequest::class, 'stock_request_id');
            $table->foreignIdFor(UnitPacking::class, 'unit_id');
            $table->foreignIdFor(Product::class, 'product_id');
            $table->string('quantity_of_unit');
            $table->string('total_pieces');
            $table->foreign('unit_id')->references('id')->on('unit_packings');
            $table->foreign('stock_request_id')->references('id')->on('stock_requests');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('stock_request_produce_items');
    }
};
