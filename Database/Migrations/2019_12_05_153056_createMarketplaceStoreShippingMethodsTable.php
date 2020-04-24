<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceStoreShippingMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('marketplace__store_shipping_methods', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        // Your fields
        $table->integer('store_id')->unsigned();
        $table->foreign('store_id')->references('id')->on('marketplace__stores')->onDelete('cascade');
        $table->integer('shipping_method_id')->unsigned();
        $table->foreign('shipping_method_id')->references('id')->on('icommerce__shipping_methods')->onDelete('cascade');
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
      Schema::dropIfExists('marketplace__store_shipping_methods');
    }
}
