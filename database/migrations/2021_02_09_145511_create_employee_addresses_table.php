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
            $table->bigIncrements('id');
            $table->foreignId('employee')->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type')->constrained('address_types')->onUpdate('cascade')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->string('house_number')->nullable();
            $table->foreignId('woreda')->nullable()->constrained('woredas')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('approved_at')->nullable();
            $table->text('note')->nullable();
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
