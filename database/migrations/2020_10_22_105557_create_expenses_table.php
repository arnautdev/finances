<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('categoryId')->unsigned();

            $table->string('title', 100);
            $table->enum('expenseType', ['monthly', 'dynamic'])->default('dynamic');
            $table->integer('amount')->default(0);
            $table->enum('dynamicAmount', ['yes', 'no'])->default('no');


            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
