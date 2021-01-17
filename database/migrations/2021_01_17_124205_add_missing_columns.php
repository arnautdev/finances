<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('goals', 'isDone')) {
            Schema::table('goals', function (Blueprint $table) {
                $table->enum('isDone', ['yes', 'no'])->default('no');
            });
        }

        if (!Schema::hasColumn('todo_lists', 'goalActionId')) {
            Schema::table('todo_lists', function (Blueprint $table) {
                $table->bigInteger('goalActionId')->unsigned()->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
