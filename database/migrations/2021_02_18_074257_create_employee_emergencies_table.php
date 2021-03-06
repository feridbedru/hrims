<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_emergencies', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('phone_number')->nullable();
            $table->foreignId('relationship')->constrained('relationships')->onUpdate('cascade')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('other_phone')->nullable();
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
        Schema::drop('employee_emergencies');
    }
}
