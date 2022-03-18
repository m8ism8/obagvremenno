<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompleteIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('subcategory_id')->nullable()->change();

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $table->unsignedBigInteger('complete_id')
                    ->nullable();
            $table->foreign('complete_id')
                ->references('id')
                ->on('сomplete_subcategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
