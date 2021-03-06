<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDisastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disasters', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->date('occured_on');
            $table->foreignId('cause')->constrained('disaster_causes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('severity')->constrained('disaster_severities')->onUpdate('cascade')->onDelete('cascade');
            $table->text('description');
            $table->string('attachment');
            $table->boolean('is_mass');
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
        Schema::drop('employee_disasters');
    }
}
