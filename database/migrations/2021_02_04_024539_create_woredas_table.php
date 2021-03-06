<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWoredasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woredas', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name', 255);
            $table->foreignId('zone')->constrained('zones')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('woredas');
    }
}
