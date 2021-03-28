<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->text('body');
            $table->foreignId('language')->constrained('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('template_type')->constrained('template_types')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_active')->nullable();
            $table->string('code',50);
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
        Schema::drop('templates');
    }
}
