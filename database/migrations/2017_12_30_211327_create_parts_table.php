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
			$table->text('models');
			$table->text('translation');
			$table->string('category');
			$table->integer('user_id');
			$table->integer('store_id')->nullable();
			$table->boolean('visibility')->default(true);
			$table->string('avito_category')->nullable();
			$table->text('description');
			$table->text('main_description')->nullable();
			$table->text('part_description')->nullable();
			$table->text('additional_description_1')->nullable();
			$table->text('additional_description_2')->nullable();
			$table->text('additional_description_3')->nullable();
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
