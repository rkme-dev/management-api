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
        if (Schema::hasTable('purchase_orders') === true) {
            return;
        }

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('container_number')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('barcode')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('courier_number')->nullable();
            $table->string('description')->nullable();
            $table->string('number')->nullable();
            $table->string('total')->nullable();
            $table->string('total_amount_payable')->nullable();
            $table->string('subtotal')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('paid_amount')->nullable();
            $table->dateTime('refunded_at')->nullable();
            $table->dateTime('invoice_id')->nullable();
            $table->string('status');
            $table->string('payment_method')->nullable();
            $table->string('eta')->nullable();
            $table->string('fx_id')->nullable();
            $table->dateTime('arrived_at')->nullable();
            $table->boolean('active')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
