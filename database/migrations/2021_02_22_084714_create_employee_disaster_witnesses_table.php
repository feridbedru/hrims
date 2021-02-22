<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDisasterWitnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disaster_witnesses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('disaster')->unsigned()->index();
            $table->string('name', 255);
            $table->string('phone')->nullable();
            $table->string('file')->nullable();
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
        Schema::drop('employee_disaster_witnesses');
    }
}
