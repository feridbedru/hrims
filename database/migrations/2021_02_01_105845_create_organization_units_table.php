<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_units', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('en_name')->nullable();
            $table->string('en_acronym')->nullable();
            $table->string('am_name')->nullable();
            $table->string('am_acronym')->nullable();
            $table->integer('parent_id')->unsigned()->nullable()->index();
            $table->integer('job_category_id')->unsigned()->nullable()->index();
            $table->integer('organization_location_id')->unsigned()->nullable()->index();
            $table->boolean('is_root_unit')->nullable();
            $table->boolean('is_category')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('web_page')->nullable();
            $table->integer('reports_to_id')->unsigned()->nullable()->index();
            $table->integer('chairman_id')->unsigned()->nullable()->index();
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
        Schema::drop('organization_units');
    }
}
