<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToNoticeboardViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('noticeboard_view')) {
            Schema::rename('noticeboard_view', 'noticeboard_visits');
        }
    
        Schema::table('noticeboard_visits', function (Blueprint $table) {
            $table->string('visitable_type')->before('user_id');
            $table->renameColumn('user_id', 'visitable_id');
        });

        \DB::query('SET FOREIGN_KEY_CHECKS=0');
        \DB::query('ALTER TABLE `hemis`.`noticeboard_visits` DROP FOREIGN KEY noticeboard_view_announcement_id_foreign');
        \DB::query('ALTER TABLE `hemis`.`noticeboard_visits` DROP FOREIGN KEY noticeboard_view_user_id_foreign');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noticeboard_visits', function (Blueprint $table) {
            //
        });
    }
}
