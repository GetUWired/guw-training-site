<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemSetPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_set', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('set_id')->unsigned();
            $table->foreign('set_id')->references('id')->on('sets');
            $table->integer('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->unique(array('set_id', 'problem_id'));
            $table->integer('order');
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
        Schema::dropIfExists('problem_set');
    }
}
