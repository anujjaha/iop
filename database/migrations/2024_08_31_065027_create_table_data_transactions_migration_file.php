<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataTransactionsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_transactions', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('master_account_id')->nullable(); 
			$table->integer('client_id')->nullable(); 
			$table->float('debit', 10 , 3)->nullable(); 
			$table->float('credit', 10 , 3)->nullable(); 
			$table->float('amount', 10 , 3)->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->date('transaction_date')->nullable(); 
			$table->integer('created_by')->nullable(); 
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
        Schema::dropIfExists('data_transactions');
    }
}