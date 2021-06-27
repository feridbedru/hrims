<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('time_period');
            $table->string('start_date',10);
            $table->string('end_date',10);
            $table->foreignId('evaluation_type_id')->constrained('evaluation_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_category_id')->constrained('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('organization_units_id')->constrained('organization_units')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('self');
            $table->integer('peer');
            $table->integer('team_leader');
            $table->integer('unit_leader');
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
        Schema::drop('evaluations');
    }
}
