<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataStockDetailsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_stock_details', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('code')->nullable(); 
			$table->string('title')->nullable(); 
			$table->string('external_link')->nullable(); 
			$table->float('cmp', 10 , 3)->nullable(); 
			$table->datetime('cmp_at')->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->integer('is_nse')->nullable()->default("1"); 
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
        Schema::dropIfExists('data_stock_details');
    }
}