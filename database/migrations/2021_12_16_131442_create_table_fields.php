<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('master_table_id')->nullable();
            $table->string('field_name')->nullable();
            $table->string('field_type')->nullable();
            $table->integer('is_nullable')->default(1);
            $table->integer('is_primary_field')->default(0);
            $table->integer('is_index_field')->default(0);
            $table->integer('is_unique_field')->default(0);
            $table->integer('is_soft_delete')->default(0);
            $table->string('default_value')->nullable();
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
        Schema::dropIfExists('table_fields');
    }
}
