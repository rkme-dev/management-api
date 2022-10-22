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
        Schema::table('products', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->string('sku')->nullable()->change();
            $table->string('price')->nullable()->after('slug');
            $table->unsignedBigInteger('unit_id')->nullable()->after('price');
            $table->string('brand')->nullable()->after('unit_id');
            $table->string('grouping')->nullable()->after('brand');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('unit_packings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('brand');
            $table->dropColumn('grouping');
            $table->dropForeign('products_created_by_foreign');
            $table->dropForeign('products_updated_by_foreign');
            $table->dropForeign('products_unit_id_foreign');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('unit_id');
        });
    }
};
