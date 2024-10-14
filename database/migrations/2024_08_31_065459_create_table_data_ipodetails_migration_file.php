<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataIpodetailsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_Ipodetails', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('ipo_name')->nullable(); 
			$table->date('opening_date')->nullable(); 
			$table->date('closing_date')->nullable(); 
			$table->date('listing_date')->nullable(); 
			$table->float('gmp_latest', 10 , 3)->nullable(); 
			$table->integer('lot_size')->nullable(); 
			$table->float('block_amt', 10 , 3)->nullable(); 
			$table->date('refund_date')->nullable(); 
			$table->float('listed_price', 10 , 3)->nullable(); 
			$table->string('ipo_type')->nullable(); 
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
        Schema::dropIfExists('data_Ipodetails');
    }
}