<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('physical_counts', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->foreignId('location_id')
                ->nullable()
                ->after('document_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('physical_counts', function (Blueprint $table) {
            $table->string('location')
                ->nullable()
                ->after('document_id');
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });
    }
};
