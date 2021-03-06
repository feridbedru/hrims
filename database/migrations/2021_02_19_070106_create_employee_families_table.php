<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_families', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->foreignId('sex')->constrained('sexes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('relationship')->constrained('relationships')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('photo')->nullable();
            $table->string('file')->nullable();
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
        Schema::drop('employee_families');
    }
}
