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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->string('amount');
            $table->string('currency')->nullable();
            $table->string('paid_to')->nullable();
            $table->string('conversion_rate')->nullable();
            $table->string('peso_conversion')->nullable();
            $table->string('usd_conversion')->nullable();
            $table->string('fx_id')->nullable();
            $table->string('dp_percentage')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('orderable_type');
            $table->unsignedBigInteger('orderable_id');

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
        Schema::dropIfExists('payment_logs');
    }
};
