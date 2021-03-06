<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('salary_step')->constrained('salary_steps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('salary_height')->constrained('salary_heights')->onUpdate('cascade')->onDelete('cascade');
            $table->float('amount',8,2);
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
        Schema::drop('salaries');
    }
}
