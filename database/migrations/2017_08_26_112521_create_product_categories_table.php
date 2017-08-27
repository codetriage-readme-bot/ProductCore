<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('product_categories_xref', function (Blueprint $table){
            $table->string('product_type');
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_categories_xref', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_categories_xref');
    }
}
