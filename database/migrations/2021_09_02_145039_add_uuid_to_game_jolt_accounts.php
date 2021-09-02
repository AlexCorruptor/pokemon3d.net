<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidToGameJoltAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_jolt_accounts', function (Blueprint $table) {
            $table->dropPrimary('id');
        });
        // These needs to be run at two seperate times
        Schema::table('game_jolt_accounts', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->primary()->first();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_jolt_accounts', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->change();
            $table->dropColumn('uuid');
        });
    }
}