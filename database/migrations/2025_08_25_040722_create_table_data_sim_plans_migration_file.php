<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataSimPlansMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sim_plans', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('sim_id')->nullable(); 
			$table->string('title')->nullable(); 
			$table->integer('cost')->nullable(); 
			$table->date('recharge_date')->nullable(); 
			$table->date('expire_date')->nullable(); 
			$table->string('current_plan')->nullable(); 
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
        Schema::dropIfExists('data_sim_plans');
    }
}