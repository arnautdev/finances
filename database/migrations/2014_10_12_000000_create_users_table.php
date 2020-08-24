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
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('socialId')->nullable();
            $table->string('socialSource')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->enum('language', ['en', 'bg'])->default('bg');
            $table->string('timezone')->nullable();
            $table->string('randPassword')->nullable();
            $table->string('password');
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
