<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('description', 1000)->nullable();
            $table->string('data', 2000);
            $table->string('topic_for');
            $table->integer('parent')->unsigned()->nullable()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->integer('created_by')->unsigned()->nullable()->index();
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
        Schema::drop('helps');
    }
}
