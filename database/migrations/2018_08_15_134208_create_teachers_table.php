<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('father_name');
            $table->string('grandfather_name')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('province');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('degree')->nullable();
            $table->integer('university_id');
            $table->integer('department_id');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
