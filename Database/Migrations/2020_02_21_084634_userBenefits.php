


<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBenefits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace__user_benefits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->integer('benefit_id')->unsigned();
	    $table->foreign('benefit_id')->references('id')->on('marketplace__benefits')->onDelete('cascade');
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
    Schema::table('marketplace__user_benefits', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['benefit_id']);
    });

    Schema::dropIfExists('marketplace__user_benefits');
    }
}
