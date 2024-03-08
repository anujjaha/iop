<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGeneralCodesMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_codes', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('user_id')->nullable(); 
			$table->integer('account_id')->nullable()->default("1"); 
			$table->string('title')->nullable(); 
			$table->string('name')->nullable(); 
			$table->string('primary_contact')->nullable(); 
			$table->string('email')->nullable(); 
			$table->string('address')->nullable(); 
			$table->string('city')->nullable(); 
			$table->string('state')->nullable(); 
			$table->string('pincode')->nullable(); 
			$table->string('website')->nullable(); 
			$table->longText('gmap')->nullable(); 
			$table->longText('notes')->nullable(); 
			$table->integer('status')->nullable()->default("1"); 
			$table->string('web_qr')->nullable(); 
			$table->string('email_qr')->nullable(); 
			$table->string('gmap_qr')->nullable(); 
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
        Schema::dropIfExists('general_codes');
    }
}