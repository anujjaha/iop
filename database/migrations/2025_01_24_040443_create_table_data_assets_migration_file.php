<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataAssetsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_assets', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('title')->nullable(); 
			$table->string('brand')->nullable(); 
			$table->float('cost', 10 , 3)->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->integer('status')->nullable()->default("1"); 
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
        Schema::dropIfExists('data_assets');
    }
}