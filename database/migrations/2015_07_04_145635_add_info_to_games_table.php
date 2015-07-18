<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('full_name')->after('name');
            $table->string('short_desc');
            $table->string('what_youll_need');
            $table->text('long_desc');
            $table->text('variations');
            $table->boolean('writing');
            $table->boolean('stageimprov');
            $table->boolean('drawing');
            $table->boolean('standup');
            $table->boolean('music');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
}
