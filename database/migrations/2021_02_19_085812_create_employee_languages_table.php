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
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('language')->constrained('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('reading')->constrained('language_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('writing')->constrained('language_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('listening')->constrained('language_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('speaking')->constrained('language_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_prefered')->nullable();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
