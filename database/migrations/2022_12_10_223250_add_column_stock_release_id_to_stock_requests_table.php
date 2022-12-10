<?php

use App\Models\StockRelease;
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
        Schema::table('stock_requests', function (Blueprint $table) {
            $table->foreignIdFor(StockRelease::class, 'stock_release_id')->nullable()->after('id');
            $table->foreign('stock_release_id')->references('id')->on('stock_releases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_requests', function (Blueprint $table) {
            $table->dropForeign('stock_requests_stock_release_id_foreign');
            $table->dropForeignIdFor(StockRelease::class, 'stock_release_id');
        });
    }
};
