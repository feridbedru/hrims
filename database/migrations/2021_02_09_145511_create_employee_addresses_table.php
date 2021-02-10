<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_addresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('address_type_id')->unsigned()->index();
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->integer('woreda_id')->unsigned()->nullable()->index();
            $table->string('status')->nullable();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('approved_by')->unsigned()->nullable()->index();
            $table->dateTime('approved_at')->nullable();
            $table->string('note', 1000)->nullable();
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
        Schema::drop('employee_addresses');
    }
}
