<?php

use App\Enums\CheckStatusEnums;
use App\Models\Deposit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('check_payments', function (Blueprint $table) {
            $table->string('status')->nullable()->default(CheckStatusEnums::UNCOLLECTED->value);
            $table->foreignIdFor(Deposit::class, 'deposit_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('check_payments', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeignIdFor('deposit_id');
        });
    }
};
