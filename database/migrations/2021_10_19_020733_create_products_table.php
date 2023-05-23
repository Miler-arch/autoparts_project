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
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->string('codigo')->unique();
            $table->integer('stock')->default(0);
            $table->string('image');
            $table->decimal('price',12,2);
            $table->enum('status', ['ACTIVE', 'DEACTIVATED'])->default('ACTIVE');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('medida_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('provider_id');

            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('medida_id')->references('id')->on('medidas');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('provider_id')->references('id')->on('providers');
     
          

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
