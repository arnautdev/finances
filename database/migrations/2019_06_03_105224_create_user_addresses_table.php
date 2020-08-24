<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('userId')->index();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('country')->index()->nullable();
            $table->string('city')->index()->nullable();
            $table->string('postcode')->nullable();
            $table->text('address')->nullable();

//            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
