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
        Schema::table('sales_dr_items', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_ticket_id')->nullable()->after('sales_dr_item_id');

            $table->foreign('trip_ticket_id')->references('id')->on('trip_tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_dr_items', function (Blueprint $table) {
            $table->dropForeign('sales_dr_items_trip_ticket_id_foreign');
            $table->dropColumn('trip_ticket_id');
        });
    }
};
