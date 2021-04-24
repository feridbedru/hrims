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
            $table->string('name', 50);
            $table->string('issued_on',10);
            $table->string('certification_number',40)->nullable();
            $table->foreignId('category')->constrained('skill_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('verification_link',40)->nullable();
            $table->foreignId('vendor')->nullable()->constrained('certification_vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->string('attachment',50)->nullable();
            $table->string('expires_on',10)->nullable();
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
