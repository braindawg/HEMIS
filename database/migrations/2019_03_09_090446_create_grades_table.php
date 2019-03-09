<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('name_eng', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        \DB::table('grades')->insert(['name' => 'چهارده پاس']);
        \DB::table('grades')->insert(['name' => 'لیسانس']);
        \DB::table('grades')->insert(['name' => 'ماستری']);
        \DB::table('grades')->insert(['name' => 'دوکتورا']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
