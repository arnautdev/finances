<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();

            $table->enum('isActive', ['yes', 'no'])->default('no');
            $table->dateTime('publishDate')->nullable();
            $table->string('videoUrl', 500)->nullable();
            $table->string('slug', 200)->unique();
        });

        Schema::create('news_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale', 4)->index();
            $table->bigInteger('news_id')->unsigned();

            $table->string('title', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            // add foreign keys
            $table->unique(['news_id', 'locale']);
            $table->foreign('news_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_i18ns');
        Schema::dropIfExists('news');
    }
}
