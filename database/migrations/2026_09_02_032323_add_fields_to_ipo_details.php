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
        Schema::table('data_Ipodetails', function (Blueprint $table) 
        {
            $table->integer('bhni_lot_size')->default(0)->comment('BHNI Qty');
            $table->decimal('invested_amount', 15,2)->default(0)->comment('total Invesement');
            $table->integer('paid_interest')->default(0)->comment('Interest');
            $table->integer('block_days')->default(0)->comment('Days');
            $table->integer('retail_applications')->default(0)->comment('Retail');
            $table->integer('shni_applications')->default(0)->comment('SHNI');
            $table->integer('bhni_applications')->default(0)->comment('BHNI');
            $table->decimal('loan_amount', 15,2)->default(0)->comment('Loan Total');
            $table->integer('loan_interest')->default(0)->comment('Loan Interest');
            $table->integer('risk_amount')->default(0)->comment('Risk Amount');

            $table->decimal('block_amt', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
