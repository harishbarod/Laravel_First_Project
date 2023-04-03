<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('payment');
            $table->integer('product_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->date('purchasing_date');
            $table->date('type');
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
        Schema::dropIfExists('order');
    }
}
