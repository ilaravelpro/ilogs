<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->string('model')->nullable();
            $table->bigInteger('model_id')->nullable();
            $table->string('action')->nullable();
            $table->string('endpoint', 250)->index();
            $table->string('method', 10);
            $table->mediumText('request');
            $table->mediumText('header_request');
            $table->mediumText('response');
            $table->mediumText('header_response');
            $table->string('ip')->nullable();
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('i_log_agents')->onDelete('cascade');
            $table->double('execute_time', 10, 3)->integer();
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
        Schema::dropIfExists('i_logs');
    }
}
