<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChanceFourToScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->float('chance_four', 5,2)->nullable()->after('chance_three');
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
            $table->dropColumn('chance_four');
        });
    }
}
