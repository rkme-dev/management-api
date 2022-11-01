<?php

use App\Models\Account;
use App\Models\Document;
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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('deposit_number')->unique();
            $table->string('status');
            $table->string('amount')->nullable();
            $table->datetime('date_posted');
            $table->datetime('clearing_date');
            $table->string('remarks')->nullable();
            $table->foreignIdFor(Document::class, 'document_id');
            $table->foreignIdFor(Account::class, 'account_id');
            $table->foreignIdFor(User::class, 'created_by');
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
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
        Schema::dropIfExists('deposits');
    }
};
