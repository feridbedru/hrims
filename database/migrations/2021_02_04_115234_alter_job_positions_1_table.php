<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterJobPositions1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_positions', function(Blueprint $table)
        {
            $table->integer('job_title_category')->unsigned()->index();
            $table->dropColumn('job_title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_positions', function(Blueprint $table)
        {
            $table->dropColumn('job_title_category');
            $table->integer('job_title')->unsigned()->index();

        });
    }
}
