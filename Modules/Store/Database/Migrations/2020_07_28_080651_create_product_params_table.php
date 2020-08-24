<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('productId')->index()->default(0);
            $table->enum('isActive', ['yes', 'no'])->default('yes');
            $table->text('options')->nullable();

//            $table->foreign('productId')->references('id')->on('products');
        });

        Schema::create('product_params_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('productParamId')->unsigned();
            $table->string('locale', 4)->index();

            $table->string('title', 500);

            $table->unique(['productParamId', 'locale']);
            $table->foreign('productParamId')->references('id')->on('product_params');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_params_i18ns');
        Schema::dropIfExists('product_params');
    }
}
