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
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
			$table->string('category_id')->nullable();
			$table->integer('shop_id')->unsigned();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
			$table->boolean('visibility')->default(true);
			$table->string('image')->default(0);
			$table->text('description')->nullable();
			$table->text('models')->nullable();
			$table->integer('price')->nullable();
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
