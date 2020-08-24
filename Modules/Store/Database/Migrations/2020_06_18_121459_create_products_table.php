<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->enum('status', ['inSale', 'outOfSaleShowPrice', 'outOfSaleHidePrice'])->default('inSale');
            $table->enum('isActive', ['yes', 'no'])->default('no');
            $table->enum('inPromo', ['yes', 'no'])->default('no');
            $table->enum('isNew', ['yes', 'no'])->default('no');

            $table->integer('price')->default(0);
            $table->integer('promoPrice')->default(0);
            $table->integer('gettingPrice')->default(0);
            $table->string('slug', 500);

            $table->integer('addedByUserId')->unsigned();

            /// add foreign key
            $table->foreign('addedByUserId')->references('id')->on('users');
            $table->index(['slug', 'status']);
        });


        /// create internationalization table
        Schema::create('product_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('productId')->unsigned();
            $table->string('locale', 4)->index();

            $table->string('title', 500);
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->unique(['productId', 'locale']);
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
        Schema::dropIfExists('product_i18ns');
        Schema::dropIfExists('products');
    }
}
