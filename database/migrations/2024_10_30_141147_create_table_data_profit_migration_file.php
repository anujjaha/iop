<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataProfitMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_profit', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->integer('profit_amount')->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->datetime('executed_on')->nullable(); 
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
        Schema::dropIfExists('data_profit');
    }
}