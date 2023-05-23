<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_from_id');
            $table->unsignedBigInteger('product_id');
            $table->string('quantity')->nullable(false);
            $table->unsignedBigInteger('warehouse_to_id');
            $table->timestamps();

            $table->foreign('warehouse_from_id')->references('id')->on('warehouses')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('warehouse_to_id')->references('id')->on('warehouses')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_products');
    }
}
