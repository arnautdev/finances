<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goal_actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('title');
            $table->bigInteger('goalId')->unsigned();
            $table->dateTime('startDateTime')->nullable();
            $table->char('weekDays', 10);
            $table->enum('addToTodoList', ['yes', 'no'])->default('no');

            $table->foreign('goalId')->references('id')->on('goals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal_actions');
    }
}
