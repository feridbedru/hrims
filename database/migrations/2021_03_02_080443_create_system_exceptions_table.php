<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemExceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_exceptions', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('function')->nullable();
            $table->string('path')->nullable();
            $table->json('request')->nullable();
            $table->json('message')->nullable();
            $table->integer('status')->nullable();
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
        Schema::drop('system_exceptions');
    }
}
