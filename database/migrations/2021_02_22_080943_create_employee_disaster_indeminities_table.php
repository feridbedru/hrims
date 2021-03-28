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
            $table->bigIncrements('id');
            $table->foreignId('disaster')->constrained('employee_disasters')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title', 50);
            $table->longText('description');
            $table->float('cost',8,2)->nullable();
            $table->string('file',50)->nullable();
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
        Schema::drop('employee_disaster_indeminities');
    }
}
