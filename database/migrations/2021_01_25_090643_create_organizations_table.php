<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('en_name',50);
            $table->string('am_name',50)->nullable();
            $table->string('abbreviation',50)->nullable();
            $table->text('motto')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('logo',50)->nullable();
            $table->string('header',50)->nullable();
            $table->string('footer',50)->nullable();
            $table->text('address')->nullable();
            $table->string('website',30)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('fax_number',20)->nullable();
            $table->string('po_box',20)->nullable();
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
        Schema::drop('organizations');
    }
}
