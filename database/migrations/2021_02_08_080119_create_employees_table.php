<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('en_name')->nullable();
            $table->string('am_name');
            $table->integer('title')->unsigned()->nullable()->index();
            $table->integer('sex')->unsigned()->index();
            $table->date('date_of_birth');
            $table->string('photo')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('organization_unit')->unsigned()->index();
            $table->integer('job_position')->unsigned()->index();
            $table->string('employment_id')->nullable()->index();
            $table->integer('status')->unsigned()->nullable()->index();
            $table->integer('approve_requests')->nullable();
            $table->boolean('has_delegate')->nullable();
            $table->integer('created_by')->unsigned()->index();
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
        Schema::drop('employees');
    }
}
