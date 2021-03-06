<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalaryStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_steps', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('salary_scale')->constrained('salary_scales')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('step');
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
        Schema::drop('salary_steps');
    }
}
