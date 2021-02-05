<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateILogAgentBrowsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_log_agent_browsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family', 50);
            $table->string('major', 20)->nullable();
            $table->string('minor', 20)->nullable();
            $table->string('patch', 20)->nullable();
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
        Schema::dropIfExists('i_log_agent_browsers');
    }
}
