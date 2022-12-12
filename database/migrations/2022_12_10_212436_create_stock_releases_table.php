<?php

use App\Models\Document;
use App\Models\Location;
use App\Models\User;
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
        Schema::create('stock_releases', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->timestamp('date');
            $table->foreignIdFor(Document::class, 'document_id');
            $table->foreignIdFor(Location::class, 'location_id');
            $table->foreignIdFor(User::class, 'created_by');
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->foreignIdFor(User::class, 'posted_by')->nullable();
            $table->string('process_type');
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('posted_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_releases');
    }
};
