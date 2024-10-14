<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataCompanyLossMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_company_loss', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('client_id')->nullable(); 
			$table->float('loss_amount', 10 , 3)->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->date('executed_on')->nullable(); 
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
        Schema::dropIfExists('data_company_loss');
    }
}