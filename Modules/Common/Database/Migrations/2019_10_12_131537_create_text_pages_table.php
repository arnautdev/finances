<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_pages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->string('slug', 200)->unique();
            $table->enum('isActive', ['yes', 'no'])->default('no');
        });


        Schema::create('text_page_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pageId')->unsigned();
            $table->string('locale', 4)->index();

            $table->string('title', 500);
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->unique(['pageId', 'locale']);
            $table->foreign('pageId')->references('id')->on('text_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_page_18ns');
        Schema::dropIfExists('text_pages');
    }
}
