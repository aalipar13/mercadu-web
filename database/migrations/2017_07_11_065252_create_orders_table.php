<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->double('total', 15, 2)->default(0);
            $table->double('subtotal', 15, 2)->default(0);
            $table->double('deposit', 15, 2)->default(0);
            $table->double('discount', 15, 2)->default(0)->nullable();
            $table->double('subtotal_discount', 15, 2)->default(0)->nullable();
            $table->double('shipping', 15, 2)->default(0)->nullable();
            $table->enum('status', ['pending_payment','pending_review','processed','completed','cancelled'])->default('pending_payment');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('email', 128);
            $table->string('mobile', 32);
            $table->string('billing_address_1', 128);
            $table->string('billing_address_2', 128)->nullable();
            $table->string('billing_state', 128);
            $table->string('billing_zip_code', 64);
            $table->string('billing_city', 64);
            $table->string('billing_country', 64);
            $table->string('shipping_address_1', 128);
            $table->string('shipping_address_2', 128)->nullable();
            $table->string('shipping_state', 128);
            $table->string('shipping_zip_code', 64);
            $table->string('shipping_city', 64);
            $table->string('shipping_country', 64);
            $table->integer('payment_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
