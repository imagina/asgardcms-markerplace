<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LevelBenefits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('marketplace__level_benefits', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id')->unsigned();
          $table->integer('benefit_id')->unsigned();
          $table->integer('level_id')->unsigned();
          $table->foreign('benefit_id')->references('id')->on('marketplace__benefits')->onDelete('cascade');
          $table->foreign('level_id')->references('id')->on('marketplace__levels')->onDelete('cascade');
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
      Schema::table('marketplace__level_benefits', function (Blueprint $table) {
          $table->dropForeign(['benefit_id']);
          $table->dropForeign(['level_id']);
      });

      Schema::dropIfExists('marketplace__level_benefits');
    }
}
