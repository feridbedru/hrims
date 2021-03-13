<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeAdditionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_additional_infos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->string('place_of_birth')->nullable();
            $table->string('other_phone_number')->nullable();
            $table->foreignId('nationality')->nullable()->constrained('nationalities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('religion')->nullable()->constrained('religions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('blood_group')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('pension')->nullable();
            $table->foreignId('marital_status')->nullable()->constrained('marital_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('employee_additional_infos');
    }
}
