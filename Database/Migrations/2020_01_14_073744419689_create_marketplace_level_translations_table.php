<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceLevelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__level_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->text('description');
            $table->integer('level_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['level_id', 'locale']);
            $table->foreign('level_id')->references('id')->on('marketplace__levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__level_translations', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
        });
        Schema::dropIfExists('marketplace__level_translations');
    }
}
