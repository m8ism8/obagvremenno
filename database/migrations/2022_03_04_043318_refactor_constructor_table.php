<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorConstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('constructors', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->text('square_image')->after('description');
            $table->text('wide_image')->after('description');
            $table->text('template_image')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constructors', function (Blueprint $table) {
            $table->dropColumn('square_image');
            $table->dropColumn('wide_image');
            $table->dropColumn('template_image');
            $table->text('image')->after('description');
        });
    }
}
