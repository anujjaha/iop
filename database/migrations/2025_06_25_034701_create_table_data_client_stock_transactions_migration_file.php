<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataClientStockTransactionsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_client_stock_transactions', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->integer('stock_id')->nullable(); 
			$table->float('buy_cost', 10 , 3)->nullable(); 
			$table->integer('buy_qty')->nullable(); 
			$table->date('buy_date')->nullable(); 
			$table->float('sell_cost', 10 , 3)->nullable(); 
			$table->integer('sell_qty')->nullable(); 
			$table->date('sell_date')->nullable(); 
			$table->float('total_transaction_value', 10 , 3)->nullable(); 
			$table->float('net_value', 10 , 3)->nullable(); 
			$table->float('tax', 10 , 3)->nullable(); 
			$table->float('brokerage_percentage', 10 , 3)->nullable(); 
			$table->float('brokerage_cost', 10 , 3)->nullable(); 
			$table->float('net_profit', 10 , 3)->nullable(); 
			$table->float('net_loss', 10 , 3)->nullable(); 
			$table->integer('is_profit')->nullable(); 
			$table->integer('is_loss')->nullable(); 
			$table->longText('notes')->nullable(); 
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
        Schema::dropIfExists('data_client_stock_transactions');
    }
}