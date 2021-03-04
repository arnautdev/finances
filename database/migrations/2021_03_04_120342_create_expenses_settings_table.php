<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE `expenses`
RENAME TO  `expenses_settings` ;
SQL;
        \Illuminate\Support\Facades\DB::statement($sql);
//        Schema::create('expenses_settings', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_settings');
    }
}
