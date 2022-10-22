<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->renameColumn('bank_details', 'bank_name');
            $table->renameColumn('account_no', 'bank_account_no');
            $table->string('bank_account_address')->nullable()->after('account_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->renameColumn('bank_name', 'bank_details');
            $table->renameColumn('bank_account_no', 'account_no');
            $table->dropColumn('bank_account_address');
        });
    }
};
