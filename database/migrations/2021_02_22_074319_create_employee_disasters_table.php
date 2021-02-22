<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDisastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disasters', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->date('occured_on');
            $table->integer('cause')->unsigned()->index();
            $table->integer('severity')->unsigned()->index();
            $table->string('description', 1000);
            $table->string('attachment');
            $table->boolean('is_mass');
            $table->string('status')->nullable();
            $table->string('note', 1000)->nullable();
            $table->integer('created_by')->unsigned()->nullable()->index();
            $table->integer('approved_by')->unsigned()->nullable()->index();
            $table->dateTime('approved_at')->nullable();
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
        Schema::drop('employee_disasters');
    }
}
