<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_dr_payments', function (Blueprint $table) {
            $table->smallInteger('is_applied')->nullable()->default(0)->after('amount_to_pay');
        });
    }

    public function down(): void
    {
        Schema::table('sales_dr_payments', function (Blueprint $table) {
            $table->dropColumn('is_applied');
        });
    }
};
