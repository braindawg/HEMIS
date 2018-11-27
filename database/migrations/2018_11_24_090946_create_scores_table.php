<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->tinyInteger('semester');                    

            $table->float('homework', 5,2)->nullable();
            $table->float('classwork', 5,2)->nullable();
            $table->float('midterm', 5,2)->nullable();
            $table->float('final', 5,2)->nullable();

            $table->float('chance_two', 5,2)->nullable();
            $table->float('chance_three', 5,2)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
