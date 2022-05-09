<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_sales', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('image')->nullable();

            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('images')->nullable();

            $table->string('second_title')->nullable();
            $table->string('second_subtitle')->nullable();
            $table->string('second_text')->nullable();
            $table->string('second_images')->nullable();

            $table->string('third_title')->nullable();
            $table->string('third_subtitle')->nullable();
            $table->string('third_text')->nullable();
            $table->string('third_images')->nullable();

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
        Schema::dropIfExists('new_sales');
    }
}
