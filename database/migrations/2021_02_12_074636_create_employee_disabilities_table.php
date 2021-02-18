<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDisabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disabilities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('type')->unsigned()->index();
            $table->string('description', 1000)->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->index();
            $table->integer('approved_by')->unsigned()->nullable()->index();
            $table->dateTime('approved_at')->nullable();
            $table->string('note', 1000)->nullable();
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
        Schema::drop('employee_disabilities');
    }
}
