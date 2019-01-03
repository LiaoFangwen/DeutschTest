<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_records', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->integer('attemptNumber');
            $table->double('score');
            $table->unsignedInteger('testId');
            $table->foreign('testId')->references('id')->on('tests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_user_records');
    }
}
