<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->foreignId('job_type_id')->constrained('job_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('initial');
            $table->integer('maximum')->nullable();
            $table->integer('male')->nullable();
            $table->integer('female');
            $table->boolean('includes_offdays')->nullable();
            $table->boolean('is_transferable')->nullable();
            $table->integer('pre_post')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::drop('leave_types');
    }
}
