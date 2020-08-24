<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('productId')->unsigned();
            $table->enum('isAvailable', ['yes', 'no'])->default('yes');
            $table->string('optionKey', 100)->unique();
            $table->string('optionLabel', 500);
            $table->integer('price')->default(0);
            $table->string('catalogNumber', 500)->nullable();
            $table->string('barCode', 500)->nullable();
            $table->integer('availableCount')->default(0);

            $table->foreign('productId')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}
