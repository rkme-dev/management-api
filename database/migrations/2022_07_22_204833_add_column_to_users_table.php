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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('email');
            $table->unsignedBigInteger('access_level_id')->nullable()->after('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('access_level_id')->references('id')->on('access_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'department_id') === true) {
                $table->dropForeign('users_department_id_foreign');
                $table->dropColumn('department_id');
            }

            if (Schema::hasColumn('users', 'access_level_id') === true) {
                $table->dropForeign('users_access_level_id_foreign');
                $table->dropColumn('access_level_id');
            }

        });
    }
};
