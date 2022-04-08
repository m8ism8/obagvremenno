<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->boolean('is_sub_main')->default(false);
            $table->string('subtitle')->nullable();
            $table->text('images')->nullable();

            $table->string('second_title')->nullable();
            $table->string('second_subtitle')->nullable();
            $table->string('second_text')->nullable();
            $table->text('second_images')->nullable();

            $table->string('third_title')->nullable();
            $table->string('third_subtitle')->nullable();
            $table->string('third_text')->nullable();
            $table->text('third_images')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
}
