<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceBenefitsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__benefits_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->text('description');
            $table->integer('benefits_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['benefits_id', 'locale']);
            $table->foreign('benefits_id')->references('id')->on('marketplace__benefits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__benefits_translations', function (Blueprint $table) {
            $table->dropForeign(['benefits_id']);
        });
        Schema::dropIfExists('marketplace__benefits_translations');
    }
}
