<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHistoryMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_missions', function (Blueprint $table) {

            $table->renameColumn('1_title', 'title_first');
            $table->renameColumn('1_text', ' text_first');

            $table->renameColumn('1_image', 'image_first');

            $table->renameColumn('2_title', 'title_second');
            $table->renameColumn('2_text', 'text_second');

            $table->renameColumn('2_image', 'image_second');

            $table->renameColumn('3_text', 'text_third');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_missions', function (Blueprint $table) {
            //
        });
    }
}
