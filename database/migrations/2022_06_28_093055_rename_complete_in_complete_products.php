<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCompleteInCompleteProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complete_products', function (Blueprint $table) {
            $table->renameColumn('complete_id', 'complete_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complete_products', function (Blueprint $table) {
            $table->renameColumn('complete_category_id', 'complete_id');
        });
    }
}
