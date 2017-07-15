<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cart_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamp('delivery_at')->nullable();
            $table->enum('insured', ['yes', 'no'])->default('no');

            $table->timestamps();

            $table->foreign('cart_id')
                  ->references('id')->on('carts')
                  ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_details');
    }
}
