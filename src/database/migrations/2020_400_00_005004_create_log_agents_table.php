<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/27/21, 1:00 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->bigInteger('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('log_agent_devices')->onDelete('cascade');
            $table->bigInteger('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('log_agent_platforms')->onDelete('cascade');
            $table->bigInteger('browser_id')->unsigned();
            $table->foreign('browser_id')->references('id')->on('log_agent_browsers')->onDelete('cascade');
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
        Schema::dropIfExists('log_agents');
    }
}
