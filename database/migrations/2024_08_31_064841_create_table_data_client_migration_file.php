<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataClientMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_client', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->string('name')->nullable(); 
			$table->date('birthdate')->nullable(); 
			$table->string('mobile')->nullable(); 
			$table->string('email')->nullable(); 
			$table->string('aadhar_no')->nullable(); 
			$table->string('pan_no')->nullable(); 
			$table->string('dmat_co_name')->nullable(); 
			$table->string('dmat_account')->nullable(); 
			$table->string('bank_name')->nullable(); 
			$table->string('bank_account')->nullable(); 
			$table->string('bank_branch')->nullable(); 
			$table->string('ifsc_code')->nullable(); 
			$table->float('balance', 10 , 3)->nullable(); 
			$table->float('profit_loss', 10 , 3)->nullable(); 
			$table->string('address')->nullable(); 
			$table->string('dmat_user_name')->nullable(); 
			$table->string('dmat_password')->nullable(); 
			$table->integer('is_huf')->nullable(); 
			$table->integer('status')->nullable(); 
			$table->date('start_date')->nullable(); 
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
        Schema::dropIfExists('data_client');
    }
}