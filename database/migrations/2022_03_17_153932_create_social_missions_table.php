<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_missions', function (Blueprint $table) {
            $table->id();

            $table->string('main_title',1000);
            $table->string('main_image',600);

            $table->text('1_title');
            $table->text('1_text');

            $table->text('2_title');
            $table->text('2_text');

            $table->string('1_image', 600);

            $table->text('3_title');
            $table->text('3_text');

            $table->string('2_image', 600);

            $table->text('4_title');
            $table->text('4_text');

            $table->string('3_image', 600);

            $table->text('5_title');
            $table->text('5_text');

            $table->string('4_image', 600);

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
        Schema::dropIfExists('social_missions');
    }
}
