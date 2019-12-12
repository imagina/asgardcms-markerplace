<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__stores', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('neighborhood_id')->unsigned()->nullable();
            $table->text('address');
            $table->text('city')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->text('schedules')->default('')->nullable();
            $table->integer('province_id')->default(0)->unsigned();
            $table->integer('status')->default(0)->unsigned();
            $table->text('social')->nullable();
            $table->text('options')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('theme_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->foreign('theme_id')->references('id')->on('marketplace__themes')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__stores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['store_id']);
            $table->dropForeign(['theme_id']);
        });
        Schema::dropIfExists('marketplace__stores');
    }
}
