<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inn_code_id')->unsigned()->index();
            $table->string('name');
            $table->string('address')->unique();
            $table->string('tel');
            $table->string('email')->unique();
            $table->time('check_in');
            $table->time('check_out');
            $table->string('hp')->nullable();
            $table->timestamps();

            $table->foreign('inn_code_id')->references('id')->on('inn_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inns');
    }
}
