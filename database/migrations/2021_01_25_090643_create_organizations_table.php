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
            $table->string('en_name');
            $table->string('am_name')->nullable();
            $table->text('motto')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('logo')->nullable();
            $table->string('header')->nullable();
            $table->string('footer')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('po_box')->nullable();
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
