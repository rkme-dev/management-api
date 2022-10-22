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
        Schema::create('production_procedures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id');
            $table->string('procedure_type');
            $table->string('report_description')->nullable();
            $table->string('status');
            $table->string('total_package_output')->nullable();
            $table->string('total_output')->nullable();
            $table->string('total_rejected')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
            $table->unsignedBigInteger('released_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('line_id')->references('id')->on('lines');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('received_by')->references('id')->on('users');
            $table->foreign('released_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_procedures');
    }
};
