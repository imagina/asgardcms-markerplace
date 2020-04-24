<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceLevelTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__leveltype_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->integer('level_type_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['level_type_id', 'locale']);
            $table->foreign('level_type_id')->references('id')->on('marketplace__leveltypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace__leveltype_translations', function (Blueprint $table) {
            $table->dropForeign(['level_type_id']);
        });
        Schema::dropIfExists('marketplace__leveltype_translations');
    }
}
