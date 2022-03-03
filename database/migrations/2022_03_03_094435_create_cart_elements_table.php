<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_elements', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('constructor_element_id')->nullable();
            $table->integer('certificate_id')->nullable();
            $table->foreignId('cart_id')->constrained();
            $table->integer('quantity');
            $table->integer('price');
            $table->string('title');
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
        Schema::dropIfExists('cart_elements');
    }
}
