<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalaryHeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_heights', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('salary_scale')->constrained('salary_scales')->onUpdate('cascade')->onDelete('cascade');
            $table->string('level');
            $table->float('initial_salary',8,2);
            $table->float('maximum_salary',8,2);
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
        Schema::drop('salary_heights');
    }
}
