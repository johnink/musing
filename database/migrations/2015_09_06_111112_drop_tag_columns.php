<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTagColumns extends Migration
{
    /**
     * Delete the tags columns that are no longer nessecary.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['writing','blogging','socialmedia','stageimprov','drawing','standup','music']);
        });

    Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['writing','blogging','socialmedia','stageimprov','drawing','standup','music']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('writing');
            $table->boolean('stageimprov');
            $table->boolean('drawing');
            $table->boolean('standup');
            $table->boolean('music');
            $table->boolean('blogging')->after('writing');
            $table->boolean('socialmedia')->after('blogging');
        });
        Schema::table('games', function (Blueprint $table) {
            $table->boolean('writing');
            $table->boolean('stageimprov');
            $table->boolean('drawing');
            $table->boolean('standup');
            $table->boolean('music');
            $table->boolean('blogging')->after('writing');
            $table->boolean('socialmedia')->after('blogging');
        });
    }
}
