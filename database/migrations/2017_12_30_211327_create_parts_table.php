<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id');
			$table->string('models');
			$table->string('category');
			$table->string('avito_category')->nullable();
			$table->string('titleOfAd');
			$table->integer('price');
			$table->string('parsed_engine');
			$table->string('number');
			$table->string('link');
			$table->integer('price_main');
			$table->string('image');
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
        Schema::dropIfExists('parts');
    }
}
