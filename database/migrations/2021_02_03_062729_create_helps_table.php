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
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('description', 1000)->nullable();
            $table->longText('data');
            $table->string('topic_for');
            $table->foreignId('parent')->nullable()->constrained('helps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('language')->constrained('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
