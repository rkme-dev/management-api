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
        Schema::create('check_payments', function (Blueprint $table) {
            $table->id();
            $table->string('bank')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('check_type')->nullable();
            $table->string('check_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_payments');
    }
};
