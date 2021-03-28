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
            $table->bigIncrements('id');
            $table->string('en_name',50)->nullable();
            $table->string('en_acronym',20)->nullable();
            $table->string('am_name',50)->nullable();
            $table->string('am_acronym',20)->nullable();
            $table->foreignId('parent')->nullable()->constrained('organization_units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_category')->constrained('job_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location')->constrained('organization_locations')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_root_unit')->nullable();
            $table->boolean('is_category')->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('email_address',50)->nullable();
            $table->string('web_page',50)->nullable();
            $table->foreignId('reports_to')->nullable()->constrained('organization_units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('chairman')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
