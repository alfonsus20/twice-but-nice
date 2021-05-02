<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailableColumnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description')->require();
            $table->string('product_name')->require();
            $table->unsignedBigInteger('category_id')->require();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('color_id')->require();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('size_id')->require();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->integer('price')->require();
            $table->boolean('available')->require()->default(false);
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
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
