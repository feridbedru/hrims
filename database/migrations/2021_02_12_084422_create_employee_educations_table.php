<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_educations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('level')->constrained('education_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('institute')->constrained('educational_institutes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('field')->constrained('educational_fields')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('gpa_scale')->constrained('gpa_scales')->onUpdate('cascade')->onDelete('cascade');
            $table->string('gpa');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('file');
            $table->boolean('has_coc')->nullable();
            $table->date('coc_issued_date')->nullable();
            $table->string('coc_file')->nullable();
            $table->integer('status');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('approved_at')->nullable();
            $table->text('note')->nullable();
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
        Schema::drop('employee_educations');
    }
}
