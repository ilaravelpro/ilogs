<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/27/21, 1:00 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateILogAgentDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_log_agent_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
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
        Schema::dropIfExists('i_log_agent_devices');
    }
}
