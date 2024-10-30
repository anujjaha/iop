<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataStockTransactionMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_stock_transaction', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('stock_id')->nullable(); 
			$table->integer('client_id')->nullable(); 
			$table->integer('buy_price')->nullable(); 
			$table->integer('sell_price')->nullable(); 
			$table->integer('qty')->nullable(); 
			$table->integer('profit_loss')->nullable(); 
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
        Schema::dropIfExists('data_stock_transaction');
    }
}