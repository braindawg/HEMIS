<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAttachmentsFieldsName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachments', function(Blueprint $table) {
            $table->renameColumn('model_record_id', 'attachable_id');
            $table->renameColumn('model', 'attachable_type');
        });
    }


    public function down()
    {

    }

}
