<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_unit')->unsigned()->index();
            $table->integer('job_category')->unsigned()->index();
            $table->integer('job_type')->unsigned()->index();
            $table->text('job_description')->nullable();
            $table->string('position_code');
            $table->string('position_id');
            $table->integer('salary')->unsigned()->index();
            $table->integer('status');
            $table->integer('job_title_category')->unsigned()->index();
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
        Schema::drop('job_positions');
    }
}
