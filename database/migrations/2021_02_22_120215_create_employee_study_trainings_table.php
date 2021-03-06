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
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type')->constrained('commitment_fors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('institution')->constrained('educational_institutes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('level')->constrained('education_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('field')->constrained('educational_fields')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('has_commitment')->nullable();
            $table->integer('total_commitment')->nullable();
            $table->float('amount',8,2)->nullable();
            $table->string('attachment')->nullable();
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
        Schema::drop('employee_study_trainings');
    }
}
