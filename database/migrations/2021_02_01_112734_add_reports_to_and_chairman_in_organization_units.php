<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsToAndChairmanInOrganizationUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organization_units', function (Blueprint $table) {
            $table->integer('reports_to_id')->unsigned()->nullable()->index();
            $table->integer('chairman_id')->unsigned()->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_units', function (Blueprint $table) {
            //
        });
    }
}
