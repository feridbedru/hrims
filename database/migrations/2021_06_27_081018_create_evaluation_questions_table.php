<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_questions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->foreignId('evaluation_id')->constrained('evaluations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('criteria');
            $table->integer('weight');
            $table->integer('order');
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
        Schema::drop('evaluation_questions');
    }
}
