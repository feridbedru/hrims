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
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('level')->unsigned()->index();
            $table->integer('institute')->unsigned()->index();
            $table->integer('field')->unsigned()->index();
            $table->integer('gpa_scale')->unsigned()->index();
            $table->string('gpa');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('file');
            $table->boolean('has_coc')->nullable();
            $table->date('coc_issued_date')->nullable();
            $table->string('coc_file')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->unsigned()->index();
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
        Schema::drop('employee_educations');
    }
}
