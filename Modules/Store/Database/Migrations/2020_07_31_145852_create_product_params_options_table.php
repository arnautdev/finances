<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductParamsOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_params_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('productParamId')->unsigned();
            $table->string('optionKey', 100)->index();

            $table->foreign('productParamId')->references('id')->on('product_params');
        });

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        Schema::create('product_params_options_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('productParamsOptionId')->unsigned();

            $table->string('locale', 4)->index();
            $table->string('title', 100);

            $table->unique(['productParamsOptionId', 'locale']);
            $table->foreign('productParamsOptionId')->references('id')->on('product_params_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_params_options_i18ns');
        Schema::dropIfExists('product_params_options');
    }
}
