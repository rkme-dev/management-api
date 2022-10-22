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
            $table->smallInteger('is_linked')->nullable()->default(0)->after('trip_ticket_id');
        });

        Schema::table('sales_drs', function (Blueprint $table) {
            $table->smallInteger('is_linked')->nullable()->default(0)->after('qr_code');
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
            $table->dropColumn('is_linked');
        });

        Schema::table('sales_drs', function (Blueprint $table) {
            $table->dropColumn('is_linked');
        });
    }
};
