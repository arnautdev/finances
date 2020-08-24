<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextPageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('pageId')->unsigned();
            $table->string('slug', 200)->unique();
            $table->enum('isActive', ['yes', 'no'])->default('no');
            $table->integer('ord')->default(0);

            /// add foreign key to text-page table
            $table->foreign('pageId')->references('id')->on('text_pages');
        });

        Schema::create('text_page_section_i18ns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pageSectionId')->unsigned();
            $table->string('locale', 4)->index();

            $table->string('title', 500);
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->unique(['pageSectionId', 'locale']);
            $table->foreign('pageSectionId')->references('id')->on('text_page_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_page_section_i18ns');
        Schema::dropIfExists('text_page_sections');
    }
}
