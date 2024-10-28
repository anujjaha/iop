<?php

use App\Models\Main\Main;
use App\Models\IpoAssignments\IpoAssignments;
use App\Models\Fees\Fees;
use App\Models\Loss\Loss;

/**
 * Global helpers file with misc functions.
 */
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (!function_exists('hasher')) {
    /**
     * Hasher Function.
     */
    function hasher()
    {
        return app('hasher');
    }
}

if (!function_exists('history')) {
    /**
     * Access the history facade anywhere.
     */
    function history()
    {
        return true;
        return app('history');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory = $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if ($filename != '.' && $filename != '..' && is_dir($directory . $filename)) {
                array_push($directory_list, $directory . $filename . '/');
            }
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory . '*.php') as $filename) {
                require $filename;
            }
        }
    }
}

if (!function_exists('getRtlCss')) {

    /**
     * The path being passed is generated by Laravel Mix manifest file
     * The webpack plugin takes the css filenames and appends rtl before the .css extension
     * So we take the original and place that in and send back the path.
     *
     * @param $path
     *
     * @return string
     */
    function getRtlCss($path)
    {
        $path = explode('/', $path);
        $filename = end($path);
        array_pop($path);
        $filename = rtrim($filename, '.css');

        return implode('/', $path) . '/' . $filename . '.rtl.css';
    }
}


if (!function_exists('getTaxAmount')) {

    function getTaxAmount($cost)
    {
        return (getTaxPercentage() * $cost / 100);
    }
}

if (!function_exists('getTaxPercentage')) {

    function getTaxPercentage()
    {
        return 0.1;
    }
}

if (!function_exists('getBrokerAmount')) {

    function getBrokerAmount($cost)
    {
        $brokerageCost = (getBrokerPercentage() * $cost / 100);

        return  $brokerageCost > 20 ? 20 : $brokerageCost;
    }
}

if (!function_exists('getBrokerPercentage')) {

    function getBrokerPercentage()
    {
        return env('BROKERAGE_PERCENT') ?? 0;
    }
}

if (!function_exists('getXchangeAmount')) {

    function getXchangeAmount($cost)
    {
        return (getXchangePercentage() * $cost / 100);
    }
}

if (!function_exists('getXchangePercentage')) {

    function getXchangePercentage()
    {
        return env('TRANSACTION_PERCENT') ?? 0;
    }
}

if (!function_exists('getGSTAmount')) {

    function getGSTAmount($cost)
    {
        return (getGSTPercentage() * $cost / 100);
    }
}

if (!function_exists('getGSTPercentage')) {

    function getGSTPercentage()
    {
        return env('GST_PERCENT') ?? 0;
    }
}

if (!function_exists('getCTTAmount')) {

    function getCTTAmount($cost)
    {
        return (getCTTPercentage() * $cost / 100);
    }
}

if (!function_exists('getCTTPercentage')) {

    function getCTTPercentage()
    {
        return env('CTT_PERCENT') ?? 0;
    }
}

if (!function_exists('getSebiAmount')) {

    function getSebiAmount($cost)
    {
        return (getSebiPercentage() * $cost / 100);
    }
}

if (!function_exists('getSebiPercentage')) {

    function getSebiPercentage()
    {
        return 0.01;
    }
}

if (!function_exists('getStampAmount')) {

    function getStampAmount($cost)
    {
        return (getStampPercentage() * $cost / 100);
    }
}

if (!function_exists('getStampPercentage')) {

    function getStampPercentage()
    {
        return env('STAMP_PERCENT') ?? 0;
    }
}


if (!function_exists('getCommissionAmount')) {

    function getCommissionAmount($cost)
    {
        return (getCommissionPercentage() * $cost / 100);
    }
}

if (!function_exists('getCommissionPercentage')) {

    function getCommissionPercentage()
    {
        return env('COMMISSION_PERCENT') ?? 0;
    }
}

if (!function_exists('getMarginAmount')) {

    function getMarginAmount($cost, $futureMonth)
    {
        return (getMarginPercentage($futureMonth) * $cost / 100);
    }
}

if (!function_exists('getMarginPercentage')) {

    function getMarginPercentage($futureMonth)
    {
        return config('access.marginPercentage')[$futureMonth] ?? 0;
    }
}

if (!function_exists('getNextPrice')) {

    function getNextPrice($totalCost, $extraCost, $isBuy = 1)
    {
        if ($isBuy) {
            return $totalCost + ($extraCost * 2) + 540;
        }

        return $totalCost - ($extraCost * 2) - 540;
    }
}

if (!function_exists('str_plural')) {

    function str_plural($value)
    {
        return \Str::plural($value);
        return $value;
    }
}

if (!function_exists('camel_case')) {

    function camel_case($value)
    {
        return \Str::camel($value);
    }
}

if (!function_exists('mainBalance')) {

    function mainBalance()
    {
        return Main::first()->balance;
    }
}

if (!function_exists('blockBalance')) {

    function blockBalance()
    {
        $ipoAssigned = IpoAssignments::where('status', 1)->with('ipo')->get();
        $blockedAmount = 0;
        foreach($ipoAssigned as $ipo)
        {
            $blockedAmount = $blockedAmount + $ipo->share_qty * $ipo->ipo->price_band;
        }

        return $blockedAmount;
    }
}


if (!function_exists('profitOrLoss')) {

    function profitOrLoss()
    {
        return IpoAssignments::sum('profit_loss');
    }
}



function getTableHtml($ipos, $clients = [])
{
    $html = '<table class="table table-border">
        <tr>
            <td>Applied</td>
            <td>Assign</td>
            <td>Name</td>
            <td>GMP</td>
            <td>Shares</td>
            <td>Total Block</td>
            <td>Retails Required</td>
            <td>SHIN Required</td>
            <td>Closing Date</td>
            <td>Type</td>
        </tr>';
    $total          = 0;
    $totalblock     = 0;
    $totalHni       = 0;
    foreach($ipos as $ipo)
    {
        $assingedCount  = 0;
        $blockedAmount  = 0;
        if(count($ipo->assignments))
        {
            $assignedIpos = IpoAssignments::where([
                'ipo_id'    => $ipo->id,
                'status'    => 1
            ])->get();

            foreach($assignedIpos as $assignedIpo)
            {
                $blockedAmount += $assignedIpo->share_qty * $ipo->price_band;
            }

            $assingedCount = $assignedIpos->count();
        }
        $requiredAmount = (count($clients) - $assingedCount )* ($ipo->price_band * $ipo->min_lot_size);
        $requiredHNIAmount = (count($clients) - $assingedCount )* ($ipo->price_band * $ipo->max_lot_size);
        $total += $requiredAmount;
        $totalblock += $blockedAmount; 
        $totalHni += $requiredHNIAmount;
        $externalLink = '';
        if($ipo->external_link)
        {
            $externalLink = '<a target="_blank" class="btn btn-xs" href="'.$ipo->external_link.'"><i class="fa fa-eye"></i></a>';
        }

        $html .= '
        <tr>
            <td> <a onclick="showAppliedClientList('.$ipo->id.');" href="javascript:void(0);" class="btn btn-xs btn-warning">'. $assingedCount . '</a> / <a onclick="showEligibleClientList('.$ipo->id.');" href="javascript:void(0);" class="btn btn-xs btn-success">' .  count($clients) .'</a></td>
            <td> <a target="_blank" href="'. route('admin.ipoassignments.create', ['id'=>$ipo->id]) .'" class="btn btn-xs btn-primary">Assign</a></td>
            <td><a target="_blank" href="'. route('admin.ipodetails.show', $ipo->id) .'">'. $ipo->ipo_name . '</a>'.$externalLink.'
            </td>
            <td>'. $ipo->gmp_latest . '</td>
            <td>'. $ipo->lot_size . '</td>
            <td>'. $blockedAmount . '</td>
            <td>'. $requiredAmount . '</td>
            <td>'. $requiredHNIAmount . '</td>
            <td>'. $ipo->closing_date . '</td>
            <td>'. getIpotype($ipo->ipo_type) . '</td>
        </tr>';
    }
    $html .= '<tr><td colspan="5"></td><td>'.$totalblock.'</td><td>'.$total.'</td><td>'. $totalHni .'</td><td colspan="2"></td></tr>';
    $html .= '</table>';

    return $html;
}



if (!function_exists('getIpotype')) {

    function getIpotype($type)
    {
        switch($type)
        {
            case 1:
                return 'NSE';
                break;

            case 2:
                return 'SME';
                break;

            default:
                return 'N/A';
                break;
        }
    }
}

if (!function_exists('getIpoAllotedStatusInt')) {

    function getIpoAllotedStatusInt()
    {
        return 3;
    }
}

if (!function_exists('getAssignmentLiveStatus')) {

    function getAssignmentLiveStatus($status = 0)
    {
        $status = (int)$status;
        switch($status)
        {
            case 1:
                return 'Assigned';
                break;

            case 2:
                return 'Revoked';
                break;

            case 3:
                return 'Alloted';
                break;
                
            case 5:
                return 'Settled';
                break;
                
            default:
                return 'N/A';
            break;
        }
    }
}

if (!function_exists('getTaxRate')) {

    function getTaxRate()
    {
        return 20;
    }
}


if (!function_exists('showDateTime')) {

    function showDateTime($dateTime = null)
    {
        return date('d M Y', strtotime($dateTime));
    }
}

if (!function_exists('totalPaidFees')) {

    function totalPaidFees($clientId = null)
    {
        if($clientId)
        {
            return Fees::where('client_id', $clientId)->sum('fee_amount');
        }

        return Fees::sum('fee_amount');
    }
}

if (!function_exists('totalLoss')) {

    function totalLoss($clientId = null)
    {
        if($clientId)
        {
            return Loss::where('client_id', $clientId)->sum('loss_amount');
        }

        return Loss::sum('loss_amount');
    }
}

