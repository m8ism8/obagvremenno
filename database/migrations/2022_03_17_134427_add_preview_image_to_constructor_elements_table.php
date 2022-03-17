<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreviewImageToConstructorElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('constructor_elements', function (Blueprint $table) {
            $table->renameColumn('image', 'images');
            $table->string('preview_image',600);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constructor_elements', function (Blueprint $table) {
            $table->renameColumn('images', 'image');
            $table->dropColumn('preview_image');
        });
    }
}
