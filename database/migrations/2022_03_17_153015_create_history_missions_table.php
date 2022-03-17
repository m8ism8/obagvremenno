<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_missions', function (Blueprint $table) {
            $table->id();

            $table->string('main_title',1000);
            $table->string('main_image',600);

            $table->text('1_title');
            $table->text('1_text');

            $table->string('1_image', 600);

            $table->text('2_title');
            $table->text('2_text');

            $table->string('2_image', 600);

            $table->text('3_text');

            $table->text('images');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_missions');
    }
}
