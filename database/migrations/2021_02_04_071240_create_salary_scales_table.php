<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalaryScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_scales', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->integer('job_category')->unsigned()->index();
            $table->string('stair_height');
            $table->string('salary_steps');
            $table->boolean('is_enabled')->nullable();
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
        Schema::drop('salary_scales');
    }
}
