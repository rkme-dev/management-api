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
        Schema::create('trip_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('trip_ticket_number');
            $table->string('status');
            $table->timestamp('date_posted');
            $table->string('area');
            $table->string('driver');
            $table->string('assistant')->nullable();
            $table->string('truck')->nullable();
            $table->string('plate_number');
            $table->unsignedBigInteger('document_id');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_tickets');
    }
};
