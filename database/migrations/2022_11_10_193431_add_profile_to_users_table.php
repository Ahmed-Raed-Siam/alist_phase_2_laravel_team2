<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('mobile')->nullable()->after('email');
            $table->enum('gender',['male','female'])->after('mobile');
            $table->string('birth_day')->nullable()->after('gender');
            $table->string('image')->nullable()->after('birth_day');
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
            //
            $table->dropColumn('mobile');
            $table->dropColumn('gender');
            $table->dropColumn('birth_day');
            $table->dropColumn('image');

        });
    }
}
