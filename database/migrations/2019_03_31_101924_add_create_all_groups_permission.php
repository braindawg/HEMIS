<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreateAllGroupsPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table("permissions")->insert(['guard_name' => 'web', 'name' => 'create-all-groups', 'title' => 'ایجاد گروه ها به شکل عمومی']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table("permissions")->where('name', 'create-all-groups')->delete();
    }
}
