<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('manage_stock')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('backorders')->nullable();
            $table->string('weight')->nullable();
            $table->string('purchase_note')->nullable();
            $table->string('catalog_visibility')->nullable();
            $table->string('out_stock_threshold')->nullable();
            $table->string('stock_status')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
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
        Schema::dropIfExists('app_products');
    }
}
