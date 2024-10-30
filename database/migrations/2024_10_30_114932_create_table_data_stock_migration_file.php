<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataStockMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_stock', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->string('title')->nullable(); 
			$table->string('code')->nullable(); 
			$table->integer('cost')->nullable(); 
			$table->integer('qty')->nullable(); 
			$table->integer('cmp')->nullable(); 
			$table->string('external_link')->nullable(); 
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
        Schema::dropIfExists('data_stock');
    }
}