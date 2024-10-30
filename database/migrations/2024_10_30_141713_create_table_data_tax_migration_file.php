<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataTaxMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tax', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->integer('ipo_id')->nullable(); 
			$table->integer('total_amount')->nullable(); 
			$table->integer('tax_amount')->nullable(); 
			$table->integer('profit_amount')->nullable(); 
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
        Schema::dropIfExists('data_tax');
    }
}