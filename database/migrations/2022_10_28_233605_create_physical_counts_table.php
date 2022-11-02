<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physical_counts', function (Blueprint $table) {
            $table->id();
            $table->date('date_posted');
            $table->foreignId('document_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('location');
            $table->string('group_1')
                ->nullable();
            $table->string('group_2')
                ->nullable();
            $table->string('remarks')
                ->nullable();
            $table->string('count_by');
            $table->date('count_date');
            $table->string('account_title');
            $table->string('status');
            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physical_counts');
    }
};
