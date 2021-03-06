<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_words', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('shop_id')->unsigned();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
			$table->text('title')->nullable();
			$table->text('body');
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
        Schema::dropIfExists('extra_words');
    }
}
