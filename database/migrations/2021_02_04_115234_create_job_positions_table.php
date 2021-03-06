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
            $table->bigIncrements('id');
            $table->foreignId('organization_unit')->constrained('organization_units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_category')->constrained('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_type')->constrained('job_types')->onUpdate('cascade')->onDelete('cascade');
            $table->text('job_description')->nullable();
            $table->string('position_code');
            $table->string('position_id');
            $table->foreignId('job_title_category')->constrained('job_title_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('salary')->constrained('salaries')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status');
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
