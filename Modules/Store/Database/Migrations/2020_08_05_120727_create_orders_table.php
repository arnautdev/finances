<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('userAddressId')->unsigned();
            $table->integer('processedByUserId')->unsigned();
            $table->string('status', 10)->index();
            $table->integer('price');
            $table->string('currency', 5);
            $table->string('paymentMethod', 10)->index();
            $table->string('additionalOrderInfo', 500)->nullable();


            /// add foreign keys
            $table->foreign('userId')->references('id')->on('clients');
            $table->foreign('userAddressId')->references('id')->on('user_addresses');
            $table->foreign('processedByUserId')->references('id')->on('users');
        });

        DB::update("ALTER TABLE orders AUTO_INCREMENT = 1000000001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
