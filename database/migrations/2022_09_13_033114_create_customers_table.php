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
        if (Schema::hasTable('customers') === true) {
            return;
        }

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('address')->nullable()->default(null);
            $table->string('delivery_address')->nullable()->default(null);
            $table->string('email')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('tin')->nullable();
            $table->string('credit_limit')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_bad_account')->default(false);
            $table->unsignedBigInteger('salesman_id_1')->nullable();
            $table->unsignedBigInteger('salesman_id_2')->nullable();
            $table->string('area')->nullable();
            $table->unsignedBigInteger('term_id')->nullable();
            $table->unsignedBigInteger('vat_id')->nullable();
            $table->string('type');
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();



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
        Schema::dropIfExists('customers');
    }
};
