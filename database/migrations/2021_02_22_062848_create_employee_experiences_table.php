<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_experiences', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('type')->unsigned()->index();
            $table->string('organization_name');
            $table->string('organization_address')->nullable();
            $table->string('job_position');
            $table->string('level')->nullable();
            $table->string('salary');
            $table->integer('left_reason')->unsigned()->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('attachment');
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
        Schema::drop('employee_experiences');
    }
}
