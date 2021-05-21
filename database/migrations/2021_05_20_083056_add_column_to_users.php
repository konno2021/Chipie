<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('inn_id')->unsigned()->index()->nullable();
            $table->string('address');
            $table->string('tel');
            $table->date('birthday');
            $table->boolean('is_admin')->default(false);
            $table->dateTime('deleted_at')->nullable();

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('inn_id');
            $table->dropColumn('address');
            $table->dropColumn('tel');
            $table->dropColumn('birthday');
            $table->dropColumn('is_admin');
            $table->dropColumn('deleted_at');
        });
    }
}
