<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_links', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('shop_id')->unsigned();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
			$table->text('link');
			$table->text('title');
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
        Schema::dropIfExists('part_links');
    }
}
