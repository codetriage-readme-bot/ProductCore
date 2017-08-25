<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        if (DB::getDriverName() == 'sqlite') {
            $off = 'PRAGMA foreign_keys = OFF';
            $on = 'PRAGMA foreign_keys = ON';
        }
        else {
            $off = 'SET FOREIGN_KEY_CHECKS = 0';
            $on = 'SET FOREIGN_KEY_CHECKS = 1';
        }

        DB::statement($off);
        Schema::dropIfExists('products');
        DB::statement($on);
    }
}
