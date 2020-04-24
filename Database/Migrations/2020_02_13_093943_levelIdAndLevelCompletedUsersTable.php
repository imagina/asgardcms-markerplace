<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LevelIdAndLevelCompletedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->integer('level_id')->unsigned()->nullable();
          // $table->foreign('level_id')->references('id')->on('marketplace__levels')->onDelete('cascade');
          $table->boolean('level_completed')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
