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
            $table->bigIncrements('id');
            $table->foreignId('disaster')->constrained('employee_disasters')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('phone')->nullable();
            $table->string('file')->nullable();
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
        Schema::drop('employee_disaster_witnesses');
    }
}
