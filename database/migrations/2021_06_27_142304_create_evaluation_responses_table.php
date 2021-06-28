<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_responses', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->foreignId('evaluation_id')->constrained('evaluations')->onUpdate('cascade')->onDelete('cascade');
            $table->text('result');
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('evaluated_by')->unsigned()->index();
            $table->dateTime('evaluated_at');
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
        Schema::drop('evaluation_responses');
    }
}
