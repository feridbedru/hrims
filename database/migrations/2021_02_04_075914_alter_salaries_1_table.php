<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSalaries1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function(Blueprint $table)
        {
            $table->integer('salary_height')->unsigned()->index();
            $table->string('amount');
            $table->dropColumn('stair_height');
            $table->dropColumn('salary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function(Blueprint $table)
        {
            $table->dropColumn('salary_height');
            $table->dropColumn('amount');
            $table->integer('stair_height')->unsigned()->index();
            $table->string('salary');

        });
    }
}
