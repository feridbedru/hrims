<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_bank_accounts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('employee')->unsigned()->index();
            $table->integer('bank')->unsigned()->index();
            $table->integer('account_type')->unsigned()->index();
            $table->string('account_number');
            $table->string('file')->nullable();
            $table->string('status');
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
        Schema::drop('employee_bank_accounts');
    }
}
