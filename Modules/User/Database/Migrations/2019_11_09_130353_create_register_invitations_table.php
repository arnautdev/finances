<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_invitations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('hash');
            $table->integer('userId')->unsigned();
            $table->enum('status', ['new', 'accepted'])->default('new');

            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_invitations');
    }
}
