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
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        return;
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'product_id') === true) {
                $table->dropForeign('order_items_product_id_foreign');
                $table->dropIndex('order_items_product_id_index');
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('order_items', 'supplier_id2022_07_09_182328_add_order_items_index') === true) {
                $table->dropForeign('order_items_supplier_id_foreign');
                $table->dropIndex('order_items_supplier_id_index');
                $table->dropColumn('supplier_id');
            }
        });

        Schema::dropIfExists('order_items');
    }
};
