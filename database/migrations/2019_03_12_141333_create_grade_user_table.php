<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_user', function (Blueprint $table) {
            $table->integer('grade_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        \DB::statement("INSERT INTO grade_user (grade_id, user_id) SELECT 2 AS grade_id, id AS user_id FROM users");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_user');
    }
}
