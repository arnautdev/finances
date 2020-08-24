<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('socialId')->nullable();
            $table->string('socialSource')->default('Rest api');

            $table->string('firstname', 500);
            $table->string('lastname', 500);
            $table->string('email', 50)->unique();
            $table->string('phone')->nullable();
            $table->string('language', 10)->default('bg');
            $table->string('randPassword')->nullable();
            $table->string('password', 300);
            $table->rememberToken();

            $table->enum('userPersonalDataAgreement', ['yes', 'no'])->default('no');
            $table->enum('userMarketingDataAgreement', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
