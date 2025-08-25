<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataMobileDevicesMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mobile_devices', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('title')->nullable(); 
			$table->string('company')->nullable(); 
			$table->integer('cost')->nullable(); 
			$table->date('purchase_date')->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->integer('is_smart')->nullable(); 
			$table->integer('status')->nullable(); 
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
        Schema::dropIfExists('data_mobile_devices');
    }
}