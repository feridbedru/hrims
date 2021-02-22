<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDisasterIndeminitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disaster_indeminities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('disaster')->unsigned()->index();
            $table->string('title', 255);
            $table->string('description', 1000);
            $table->string('cost')->nullable();
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
        Schema::drop('employee_disaster_indeminities');
    }
}
