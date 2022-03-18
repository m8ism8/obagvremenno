<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompleteCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_categories', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('image',600);

            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('complete_categories');
    }
}
