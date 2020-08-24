<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoOptimizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_optimizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('model', 500);
            $table->integer('itemId')->unsigned();

            $table->unique(['model', 'itemId']);
        });

        Schema::create('seo_optimization_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale', 4);
            $table->bigInteger('seoOptimizationId')->unsigned();

            $table->string('meta_title', 500);
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->foreign('seoOptimizationId')->references('id')->on('seo_optimizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_optimization_i18ns');
        Schema::dropIfExists('seo_optimizations');
    }
}
