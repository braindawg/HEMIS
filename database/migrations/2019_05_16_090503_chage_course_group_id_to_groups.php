<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChageCourseGroupIdToGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {            
            $table->renameColumn('group_id', 'groups');            
        });
        
        Schema::table('courses', function (Blueprint $table) {
            $table->string('groups', 200)->change();                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('groups', 'group_id');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->change();                    
        });
    }
}
