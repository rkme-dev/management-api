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
        Schema::create('sales_drs', function (Blueprint $table) {
            $table->id();
            $table->string('sales_dr_number')->unique();
            $table->string('status');
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->datetime('date_posted');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('salesman_id_1')->nullable();
            $table->unsignedBigInteger('salesman_id_2')->nullable();
            $table->unsignedBigInteger('term_id')->nullable();
            $table->unsignedBigInteger('vat_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('remarks')->nullable();
            $table->string('promo_code')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('salesman_id_1')->references('id')->on('salesman_file');
            $table->foreign('salesman_id_2')->references('id')->on('salesman_file');
            $table->foreign('term_id')->references('id')->on('terms');
            $table->foreign('vat_id')->references('id')->on('vats');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_drs');
    }
};
