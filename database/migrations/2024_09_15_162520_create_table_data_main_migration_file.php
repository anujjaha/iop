<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataMainMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_main', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('name')->nullable(); 
			$table->string('bank')->nullable(); 
			$table->string('branch')->nullable(); 
			$table->string('account_number')->nullable(); 
			$table->string('ifsc')->nullable(); 
			$table->float('balance', 10 , 3)->nullable(); 
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
        Schema::dropIfExists('data_main');
    }
}