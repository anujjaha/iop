<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataIpoassignmentsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ipoassignments', function (Blueprint $table) {
			$table->integer('id')->nullable(); 
			$table->integer('client_id')->nullable(); 
			$table->integer('ipo_id')->nullable(); 
			$table->integer('status')->nullable(); 
			$table->float('profit_loss', 10 , 3)->nullable(); 
			$table->date('applied_date')->nullable(); 
			$table->date('revoked_date')->nullable(); 
			$table->date('alloted_date')->nullable(); 
			$table->date('refund_date')->nullable(); 
			$table->float('opening_rate', 10 , 3)->nullable(); 
			$table->float('sell_price', 10 , 3)->nullable(); 
			$table->date('sell_date')->nullable(); 
			$table->date('return_date')->nullable(); 
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
        Schema::dropIfExists('data_ipoassignments');
    }
}