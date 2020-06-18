<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
            $table->bigInteger('subcategory_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->text('product_details');
            $table->string('product_color');
            $table->string('product_size');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->tinyInteger('main_slider')->nullable();
            $table->tinyInteger('hot_deal')->nullable();
            $table->tinyInteger('best_rated')->nullable();
            $table->tinyInteger('mid_slider')->nullable();
            $table->tinyInteger('hot_new')->nullable();
            $table->tinyInteger('buyone_getone')->nullable();
            $table->tinyInteger('trend')->nullable();
            $table->string('image_one');
            $table->string('image_two');
            $table->string('image_three');
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
