<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSocialMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_missions', function (Blueprint $table) {
            $table->renameColumn('1_title', 'title_first');
            $table->renameColumn('1_text', 'text_first');

            $table->renameColumn('2_title', 'title_second');
            $table->renameColumn('2_text', 'text_second');

            $table->renameColumn('1_image', 'image_first');

            $table->renameColumn('3_title', 'title_third');
            $table->renameColumn('3_text', 'text_third');

            $table->renameColumn('2_image', 'image_second');

            $table->renameColumn('4_title', 'title_fourth');
            $table->renameColumn('4_text', 'text_fourth');

            $table->renameColumn('3_image', 'image_third');

            $table->renameColumn('5_title', 'title_fifth');
            $table->renameColumn('5_text', 'text_fifth');

            $table->renameColumn('4_image', 'image_fourth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_missions', function (Blueprint $table) {
            $table->renameColumn('title_first', '1_title');
            $table->renameColumn('text_first', '1_text');

            $table->renameColumn('title_second', '2_title');
            $table->renameColumn('text_second', '2_text');

            $table->renameColumn('image_first', '1_image');

            $table->renameColumn('title_third', '3_title');
            $table->renameColumn('text_third','3_text');

            $table->renameColumn('image_second', '2_image');

            $table->renameColumn('title_fourth', '4_title');
            $table->renameColumn('text_fourth', '4_text');

            $table->renameColumn('image_third', '3_image');

            $table->renameColumn('title_fifth', '5_title');
            $table->renameColumn('text_fifth', '5_text');

            $table->renameColumn('image_fourth', '4_image');
        });
    }
}
