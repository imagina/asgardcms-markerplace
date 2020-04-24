<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceLevelCriteriaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__levelcriteria_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->integer('level_criteria_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['level_criteria_id', 'locale']);
            // $table->foreign('level_criteria_id')->references('id')->on('marketplace__levelcriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__levelcriteria_translations', function (Blueprint $table) {
            // $table->dropForeign(['level_criteria_id']);
        });
        Schema::dropIfExists('marketplace__levelcriteria_translations');
    }
}
