<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('slug', 500);
            $table->enum('isActive', ['yes', 'no'])->default('no');
        });


        //////////////////////////////////////////////////////////// --- ///////////////
        Schema::create('product_category_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale', 4)->index();
            $table->bigInteger('productCategoryId')->unsigned();

            $table->string('title', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            // add foreign keys
            $table->unique(['productCategoryId', 'locale']);
            $table->foreign('productCategoryId')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_i18ns');
        Schema::dropIfExists('product_categories');
    }
}
