<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceCategoryStoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__categorystore_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->string('slug')->index();
            $table->text('description');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('translatable_options')->nullable();
            $table->integer('categorystore_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['categorystore_id', 'locale'],'marketplace__category_translations_category_locale_unique');
            $table->foreign('categorystore_id')->references('id')->on('marketplace__categorystores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__categorystore_translations', function (Blueprint $table) {
            $table->dropForeign(['categorystore_id']);
        });
        Schema::dropIfExists('marketplace__categorystore_translations');
    }
}
