<?php

use App\Models\BouncedDeposit;
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
        Schema::table('check_payments', function (Blueprint $table) {
            $table->foreignIdFor(BouncedDeposit::class, 'bounced_deposit_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_payments', function (Blueprint $table) {
            $table->dropColumn('bounced_deposit_id');
        });
    }
};
