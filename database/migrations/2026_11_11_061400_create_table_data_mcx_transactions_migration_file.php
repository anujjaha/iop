<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataMcxTransactionsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mcx_transactions', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->string('mcx_code')->nullable(); 
			$table->integer('qty')->nullable(); 
			$table->integer('buy_price')->nullable(); 
			$table->integer('sell_price')->nullable(); 
			$table->integer('additional_bcost')->nullable(); 
			$table->integer('additional_scost')->nullable(); 
			$table->integer('additional_total')->nullable(); 
			$table->string('trade_type')->nullable(); 
			$table->date('trade_date')->nullable(); 
			$table->date('settle_date')->nullable(); 
			$table->integer('profit_loss')->nullable(); 
			$table->integer('net_profit_loss')->nullable(); 
			$table->integer('is_settle')->nullable(); 
			$table->string('tmonth')->nullable(); 
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
        Schema::dropIfExists('data_mcx_transactions');
    }
}