<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceThemesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__themes_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('themes_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['themes_id', 'locale']);
            $table->foreign('themes_id')->references('id')->on('marketplace__themes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__themes_translations', function (Blueprint $table) {
            $table->dropForeign(['themes_id']);
        });
        Schema::dropIfExists('marketplace__themes_translations');
    }
}
