<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContentsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) 
        {
			$table->bigIncrements('id'); 
			$table->integer('user_id')->nullable(); 
			$table->integer('account_id')->nullable()->default("1"); 
			$table->integer('category_id')->nullable()->default("1"); 
			$table->integer('temp_id')->nullable()->default("1"); 
			$table->string('slug')->nullable()->default("255"); 
			$table->string('company_name')->nullable()->default("255"); 
			$table->string('owner_1')->nullable()->default("255"); 
			$table->string('owner_2')->nullable()->default("255"); 
			$table->string('contact_primary')->nullable()->default("15"); 
			$table->string('contact_secondary')->nullable()->default("15"); 
			$table->string('email')->nullable()->default("255"); 
			$table->string('website')->nullable()->default("255"); 
			$table->longText('address')->nullable(); 
			$table->string('city')->nullable()->default("100"); 
			$table->string('state')->nullable()->default("100"); 
			$table->string('pincode')->nullable()->default("15"); 
			$table->string('logo')->nullable()->default("100"); 
			$table->string('image')->nullable()->default("100"); 
			$table->string('file_pdf')->nullable()->default("100"); 
			$table->string('qr_1')->nullable()->default("100"); 
			$table->string('qr_2')->nullable()->default("100"); 
			$table->string('qr_3')->nullable()->default("100"); 
			$table->integer('created_by')->nullable(); 
			$table->integer('status')->nullable()->default("1"); 
			$table->datetime('created_at')->nullable(); 
			$table->datetime('updated_at')->nullable(); 
			$table->datetime('deleted_at')->nullable(); 
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}