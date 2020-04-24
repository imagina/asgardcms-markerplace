<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceLevelCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__levelcriterias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->integer('type')->default(0);
            $table->string('relation_name')->nullable();
            $table->string('operator')->nullable();
            $table->integer('level_type_id')->unsigned();
            $table->foreign('level_type_id')->references('id')->on("marketplace__leveltypes")->onDelete('restrict');
            $table->text('options')->nullable();
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
        Schema::dropIfExists('marketplace__levelcriterias');
    }
}
