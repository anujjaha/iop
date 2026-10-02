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
        Schema::table('data_ipoassignments', function (Blueprint $table) 
        {
            $table->float('brokerage_plan')->default(0)->comment('Brokerage Percentage or Flat');
            $table->float('brokerage_amount')->default(0)->comment('Brokerage Value');
            $table->float('brokerage_stt')->default(0)->comment('STT Value');
            $table->float('gst_value')->default(0)->comment('GST Value');
            $table->float('final_net_pl')->default(0)->comment('NET P L');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
