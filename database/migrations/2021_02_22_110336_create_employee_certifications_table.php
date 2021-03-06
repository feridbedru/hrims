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
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->date('issued_on');
            $table->string('certification_number')->nullable();
            $table->foreignId('category')->constrained('skill_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('verification_link')->nullable();
            $table->foreignId('vendor')->nullable()->constrained('certification_vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->string('attachment')->nullable();
            $table->date('expires_on')->nullable();
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
        Schema::drop('employee_certifications');
    }
}
