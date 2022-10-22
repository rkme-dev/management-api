<?php

use App\Enums\UserStatusesEnum;
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
        if (Schema::hasTable('users') === true) {
            return;
        }

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('status')->default(UserStatusesEnum::PENDING->value);
            $table->string('password');
            $table->string('gender');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('employment_type')->nullable();
            $table->string('designation')->nullable();
            $table->string('profile_url')->nullable();
            $table->string('valid_id_url')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('sss')->nullable();
            $table->string('tin')->nullable();
            $table->string('number')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('date_hired')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
};
