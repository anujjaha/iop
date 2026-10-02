<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataFixDepositesMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_fix_deposites', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->string('fd_ref_no')->nullable(); 
			$table->float('amount', 10 , 3)->nullable(); 
			$table->date('start_date')->nullable(); 
			$table->date('end_date')->nullable(); 
			$table->float('rate_of_int', 10 , 3)->nullable(); 
			$table->float('expected_monthly_int', 10 , 3)->nullable(); 
			$table->string('bank_name')->nullable(); 
			$table->string('payout_type')->nullable(); 
			$table->string('title')->nullable(); 
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
        Schema::dropIfExists('data_fix_deposites');
    }
}