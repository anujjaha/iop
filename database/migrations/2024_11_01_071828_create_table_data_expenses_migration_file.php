<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataExpensesMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_expenses', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('user_id')->nullable(); 
			$table->string('category')->nullable(); 
			$table->string('title')->nullable(); 
			$table->integer('amount')->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->integer('created_by')->nullable(); 
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
        Schema::dropIfExists('data_expenses');
    }
}