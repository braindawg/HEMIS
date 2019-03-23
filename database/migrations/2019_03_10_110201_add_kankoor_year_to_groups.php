<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKankoorYearToGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {

            $table->integer('kankor_year')->after('name')->nullable();
        });
        

        \DB::table('groups')->whereNull('kankor_year')->update(['kankor_year' => 1397 ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            
            $table->dropColumn('kankor_year');
        });
    }
}
