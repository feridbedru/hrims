<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalaryHeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_heights', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('salary_scale')->unsigned()->index();
            $table->string('level');
            $table->string('initial_salary');
            $table->string('maximum_salary');
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
        Schema::drop('salary_heights');
    }
}
