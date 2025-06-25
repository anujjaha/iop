<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_client', function (Blueprint $table) {
            // $table->string('crn_no')->nullable()->after('status');
            // $table->string('crn_pwd')->nullable()->after('crn_no');
            // $table->string('aadhar_mobile')->nullable()->after('crn_pwd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_client', function (Blueprint $table) {
            //
        });
    }
};
