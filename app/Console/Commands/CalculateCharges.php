<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClientDetail\ClientDetail;
use App\Models\IpoAssignments\IpoAssignments;

class CalculateCharges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate-charge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // [42,47]
        $assignments = IpoAssignments::with(['client', 'ipo'])
            ->get();
        foreach($assignments as $assignment)
        {
            if($assignment->sell_price != null)
            {
                $totalInvested =  $assignment->share_qty * $assignment->ipo->price_band;
                $totalTransactionValue = $assignment->share_qty * $assignment->sell_price;
                $brokerage = round($totalTransactionValue / 100 * .3 ) + 1;
                $stt = round($totalTransactionValue / 100 * .1 );
                $gst = ( $brokerage  ) / 100 * 18;
                $finalProfit = $totalTransactionValue - $totalInvested- $brokerage - $stt - $gst;

                $assignment->brokerage_plan = 0.3;
                $assignment->brokerage_amount = $brokerage;
                $assignment->brokerage_stt = $stt;
                $assignment->gst_value = $gst;
                $assignment->final_net_pl = $finalProfit;
                $assignment->save();
            }
        }

        return Command::SUCCESS;
    }
}
