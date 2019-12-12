<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceStoreCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('marketplace__store_category', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        // Your fields
        $table->integer('store_id')->unsigned();
        $table->foreign('store_id')->references('id')->on('marketplace__stores')->onDelete('cascade');

        $table->integer('category_store_id')->unsigned();
        $table->foreign('category_store_id')->references('id')->on('marketplace__categorystores')->onDelete('cascade');
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
        Schema::dropIfExists('marketplace__store_category');
    }
}
