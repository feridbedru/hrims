<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_certifications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->string('name', 255);
            $table->string('issued_on');
            $table->string('certification_number')->nullable();
            $table->integer('category')->unsigned()->index();
            $table->string('verification_link')->nullable();
            $table->integer('vendor')->unsigned()->nullable()->index();
            $table->string('attachment')->nullable();
            $table->string('expires_on')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->index();
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
        Schema::drop('employee_certifications');
    }
}