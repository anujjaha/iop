<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserVisitsMigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_visits', function (Blueprint $table) {
				$table->bigIncrements('id'); 
			$table->integer('content_id')->nullable()->index(); 
			$table->integer('user_id')->nullable(); 
			$table->integer('actionType')->nullable()->default("1"); 
			$table->string('ip')->nullable(); 
			$table->string('user_agent')->nullable(); 
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
        Schema::dropIfExists('user_visits');
    }
}