<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataSimCardsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sim_cards', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('device_id')->nullable(); 
			$table->integer('plan_id')->nullable(); 
			$table->string('company')->nullable(); 
			$table->string('mobile_number')->nullable(); 
			$table->integer('cost')->nullable(); 
			$table->date('purchase_date')->nullable(); 
			$table->integer('status')->nullable(); 
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
        Schema::dropIfExists('data_sim_cards');
    }
}