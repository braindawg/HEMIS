<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexOnStudentsAndGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function ($table) {
            $table->index('kankor_year');
            $table->index('department_id');
        });

        Schema::table('groups', function ($table) {
            $table->index('kankor_year');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function ($table) {
            $table->dropIndex('students_kankor_year_index');
            $table->dropIndex('students_department_id_index');
        });

        Schema::table('groups', function ($table) {
            $table->dropIndex('groups_kankor_year_index');
            $table->dropIndex('groups_department_id_index');
        });
    }
}
