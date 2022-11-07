<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('physical_counts', function (Blueprint $table) {
            $table->dropColumn('account_title');
            $table->foreignId('account_id')
                ->nullable()
                ->after('location_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('physical_counts', function (Blueprint $table) {
            $table->string('account_title')
                ->nullable()
                ->after('count_date');
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
    }
};
