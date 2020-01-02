<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_carts', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('item_id');
	        $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
	        $table->unsignedInteger('cart_id');
	        $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
        Schema::dropIfExists('items_carts');
    }
}
