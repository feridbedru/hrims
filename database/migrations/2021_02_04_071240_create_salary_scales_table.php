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
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('description');
            $table->foreignId('job_category')->constrained('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('stair_height');
            $table->integer('salary_steps');
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
