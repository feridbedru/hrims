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
            $table->bigIncrements('id');
            $table->string('en_name')->nullable();
            $table->string('am_name');
            $table->foreignId('title')->nullable()->constrained('titles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sex')->constrained('sexes')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('photo')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('organization_unit')->constrained('organization_units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_position')->constrained('job_positions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('employment_id')->nullable();
            $table->foreignId('status')->constrained('employee_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('approve_requests')->nullable();
            $table->boolean('has_delegate')->nullable();
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
        Schema::drop('employees');
    }
}
