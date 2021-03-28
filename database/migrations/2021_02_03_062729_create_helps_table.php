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
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->longText('data');
            $table->string('topic_for',50);
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
