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
        Schema::table('sales_drs', function (Blueprint $table) {
            $table->string('remaining_balance')->nullable()->after('amount');
        });

        $salesDrs = \App\Models\SalesDr::all();

        foreach ($salesDrs as $salesDr) {
            $salesDr->setAttribute('remaining_balance', $salesDr->getAttribute('amount'));
            $salesDr->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_drs', function (Blueprint $table) {
            $table->dropColumn('remaining_balance');
        });
    }
};
