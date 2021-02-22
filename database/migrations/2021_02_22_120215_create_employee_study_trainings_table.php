<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeStudyTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_study_trainings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('Type')->unsigned()->index();
            $table->integer('institution')->unsigned()->index();
            $table->integer('level')->unsigned()->index();
            $table->integer('field')->unsigned()->index();
            $table->date('start_date')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('has_commitment')->nullable();
            $table->string('total_commitment')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::drop('employee_study_trainings');
    }
}
