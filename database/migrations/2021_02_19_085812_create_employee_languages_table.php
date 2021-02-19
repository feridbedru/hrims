<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_languages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('language')->unsigned()->index();
            $table->integer('reading')->unsigned()->index();
            $table->integer('writing')->unsigned()->index();
            $table->integer('listening')->unsigned()->index();
            $table->integer('speaking')->unsigned()->index();
            $table->boolean('is_prefered')->nullable();
            $table->integer('created_by')->unsigned()->nullable()->index();
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
        Schema::drop('employee_languages');
    }
}
