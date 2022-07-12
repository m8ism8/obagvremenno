<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeManyCategoriesToProductsTable extends Migration
{
    private const PIVOT_TABLE_NAME = 'ref_complete_products';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('complete_id');
        });

        Schema::create(self::PIVOT_TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('complete_category_id')
                ->constrained('complete_categories')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
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
        Schema::dropIfExists(self::PIVOT_TABLE_NAME);
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('complete_id')
                ->nullable();
        });
    }
}
