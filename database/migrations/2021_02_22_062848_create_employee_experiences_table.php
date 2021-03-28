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
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type')->constrained('experience_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('organization_name',80);
            $table->text('organization_address')->nullable();
            $table->string('job_position',80);
            $table->string('level',15)->nullable();
            $table->float('salary',8,2);
            $table->foreignId('left_reason')->constrained('left_reasons')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('attachment',50);
            $table->integer('status');
            $table->text('note')->nullable();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
