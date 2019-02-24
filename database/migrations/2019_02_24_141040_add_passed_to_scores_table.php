<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPassedToScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {            
            $table->double('total', 5, 2)->after('final')->nullable();
            $table->boolean('passed')->after('chance_three')->default(0);
        });

        \DB::transaction(function () {
            \DB::statement('UPDATE scores SET total = IF(classwork is not null, classwork, 0) + IF(homework is not null, homework, 0) + IF(midterm is not null, midterm, 0) + IF(final is not null, final, 0)');

            \DB::statement('UPDATE scores SET passed = 1 WHERE total >= 55');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('passed');
        });
    }
}
