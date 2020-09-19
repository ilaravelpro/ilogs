<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/17/20, 5:59 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateILogAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_log_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->bigInteger('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('i_log_agent_devices')->onDelete('cascade');
            $table->bigInteger('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('i_log_agent_platforms')->onDelete('cascade');
            $table->bigInteger('browser_id')->unsigned();
            $table->foreign('browser_id')->references('id')->on('i_log_agent_browsers')->onDelete('cascade');
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
        Schema::dropIfExists('i_log_agents');
    }
}
