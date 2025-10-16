<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataPaidInterestMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_paid_interest', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('title')->nullable(); 
			$table->float('amount', 10 , 3)->nullable(); 
			$table->integer('pay_mode')->nullable(); 
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
        Schema::dropIfExists('data_paid_interest');
    }
}