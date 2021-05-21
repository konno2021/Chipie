<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inn_id')->unsigned()->index();
            $table->string('plan_name');
            $table->integer('price');
            $table->string('description');
            $table->integer('room');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->timestamps();

            $table->foreign('inn_id')->references('id')->on('inns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
