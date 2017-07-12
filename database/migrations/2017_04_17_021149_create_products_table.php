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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();
            $table->string('name', 60)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('photo', 70)->nullable();
            $table->enum('type', ['simple', 'group', 'external', 'variable']);
            $table->string('code');
            $table->integer('quantity')->nullable();
            $table->enum('should_manage_stock', ['yes', 'no']);
            $table->enum('available', ['yes', 'no']);
            $table->enum('is_sold_individually', ['yes', 'no']);

            $table->double('regular_price', 12, 2)->nullable();
            $table->double('sale_price', 12, 2)->nullable();

            $table->timestamp('sale_price_start_date_at')->nullable();
            $table->timestamp('sale_price_end_date_at')->nullable();

            $table->float('weight', 8, 2)->nullable();
            $table->float('length', 8, 2)->nullable();
            $table->float('width', 8, 2)->nullable();
            $table->float('height', 8, 2)->nullable();

            $table->string('sort_order')->nullable();
            $table->string('purchase_note')->nullable();
            $table->string('should_allow_reviews')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('store_id')
                  ->references('id')->on('stores')
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
        Schema::dropIfExists('products');
    }
}
