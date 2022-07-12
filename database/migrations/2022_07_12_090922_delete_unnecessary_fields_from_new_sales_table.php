<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUnnecessaryFieldsFromNewSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_sales', function (Blueprint $table) {
            $table->dropColumn([
                'second_title',
                'second_subtitle',
                'second_text',
                'second_images',
                'images',
                'third_title',
                'third_subtitle',
                'third_text',
                'third_images',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_sales', function (Blueprint $table) {
            //
        });
    }
}
