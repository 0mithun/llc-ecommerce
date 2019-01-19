<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 128)->unique();
            $table->string('phone_number', 32)->unique();
            $table->string('password', 128);
            $table->integer('reward_point')->default(0);
            $table->date('email_verified_at')->nullable();
            $table->string('email_verified_token',80)->nullable();
            $table->string('facebook_id',32)->nullable();
            $table->string('google_id',32)->nullable();
            $table->rememberToken();

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
}
