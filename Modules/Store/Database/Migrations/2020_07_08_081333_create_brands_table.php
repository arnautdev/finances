<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->enum('isActive', ['yes', 'no'])->default('no');
            $table->string('slug', 500);
        });

        Schema::create('brands_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale', 4)->index();
            $table->bigInteger('brandId')->unsigned();

            $table->string('title', 500);

            $table->unique(['brandId', 'locale']);
            $table->foreign('brandId')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands_i18ns');
        Schema::dropIfExists('brands');
    }
}
