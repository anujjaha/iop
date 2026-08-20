@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')

@section('page-header')
<h1>CLIENT INFO: {!! $item->getFullName() !!}</h1>
@endsection

@section('content')

@php
    $stockStats = getStockTransactionDetails($item->id);
    $months = [
            'aug-2024' => 'Aug-2024',
            'sep-2024' => 'Sep-2024',
            'oct-2024' => 'Oct-2024',
            'nov-2024' => 'Nov-2024',
            'dec-2024' => 'Dec-2024',
            'jan-2025' => 'Jan-2025',
            'feb-2025' => 'Feb-2025',
            'mar-2025' => 'Mar-2025',
            'apr-2025' => 'Apr-2025',
            'may-2025' => 'May-2025',
            'june-2025' => 'Jun-2025',
            'july-2025' => 'July-2025',
            'aug-2025' => 'Aug-2025',
            'sep-2025' => 'Sep-2025',
            'oct-2025' => 'Oct-2025',
            'nov-2025' => 'Nov-2025',
            'dec-2025' => 'Dec-2025',
            'jan-2026' => 'Jan-2026',
            'feb-2026' => 'Feb-2026',
            'mar-2026' => 'Mar-2026',
            'apr-2026' => 'Apr-2026',
            'may-2026' => 'May-2026',
            'june-2026' => 'Jun-2026',
            'july-2026' => 'Jul-2026',
        ];
        $clientNetPl = 0;
@endphp
{{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Client</h3>
        <div class="card-tools pull-right">
            @if($eligibleIpos && count($eligibleIpos) && $item->balance > 15000)
                <a href="javascript:void(0)" onclick="assignIpo({!! $item->id !!})" class="btn btn-xs btn-success">Assign</a>
            @endif

            <a href="javascript:void(0)" onclick="addBalance({!! $item->id !!}, `{!!  $item->name !!}`)" class="btn btn-xs btn-primary">Add Balance</a>

            <a href="javascript:void(0)" onclick="addFee({!! $item->id !!}, `{!!  $item->name !!}`)" class="btn btn-xs btn-primary">Add Fee</a>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span class="info-box-number">{!! $item->balance !!}</span>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">P & L</span>
                        <span class="info-box-number">{!! $item->assignedIpos->sum('profit_loss') !!}</span>
                    </div>
                </div>
            </div> -->

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TAX</span>
                        <span class="info-box-number">{!! $item->assignedIpos->sum('tax_amount') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Net P & L</span>
                        <span class="info-box-number">{!! $item->assignedIpos->sum('final_net_pl') !!}</span>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Applied Ipos</span>
                        <span class="info-box-number">
                            {!! count($item->assignedIpos->whereNotNull('profit_loss')) !!}
                            /
                            {!! count($item->assignedIpos->whereNull('profit_loss')) !!}
                        </span>
                    </div>
                </div>
            </div>-->
            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Fees</span>
                        <span class="info-box-number">
                            {!! $fees->sum('fee_amount') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Current Invested</span>
                        <span class="info-box-number">{!!  getCurrentInvestment($item->id) !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock P & L</span>
                        <span class="info-box-number">{!! $stockStats['netValue'] !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock TAX</span>
                        <span class="info-box-number">{!! $stockStats['tax'] !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stock Net P & L</span>
                        <span class="info-box-number">{!! $stockStats['profit'] !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Trades</span>
                        <span class="info-box-number">
                            {!! $stockStats['trades'] !!}
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">% Profit / Loss</span>
                        <span class="info-box-number">
                            {!! $stockStats['percentage'] !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        Basic Details
                    </div>
                    <div class="col-lg-2 text-right pull-right">
                        <a target="_blank" href="{!! getAadharCardLink($item->id) !!}" class="btn btn-xs btn-success">Aadhar</a>
                        <a  target="_blank" href="{!! getPanCardLink($item->id) !!}" class="btn btn-xs btn-warning">PAN</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-3 control-label">Name :</label>
                        <div class="col-lg-9">
                            {!! $item->name !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="mobile" class="col-lg-3 control-label">Mobile :</label>
                        <div class="col-lg-9">
                            {!! $item->mobile !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="email" class="col-lg-3 control-label">Email :</label>
                        <div class="col-lg-9">
                            {!! $item->email !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="aadhar_no" class="col-lg-3 control-label">Aadhar No. :</label>
                        <div class="col-lg-9">
                            {!! $item->aadhar_no !!}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group row row">
                    <label for="pan" class="col-lg-3 control-label">PAN:</label>
                        <div class="col-lg-9">
                            {!! $item->pan_no !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="dmat_co_name" class="col-lg-3 control-label">DMAT Co. Name:</label>
                        <div class="col-lg-9">
                           {!! $item->dmat_co_name !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="dmat_account" class="col-lg-3 control-label">Dmat Account:</label>
                        <div class="col-lg-9">
                            {!! $item->dmat_account !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row row">
                        <label for="bank_name" class="col-lg-3 control-label">Bank Name:</label>
                        <div class="col-lg-9">
                            {!! $item->bank_name !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="otTotalPay" class="col-lg-3 control-label">Bank Account:</label>
                        <div class="col-lg-9">
                            {!! $item->bank_account !!}
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="otTotalPay" class="col-lg-3 control-label">Notes:</label>
                        <div class="col-lg-9">
                            {!! $item->notes !!}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
                
    </div>
</div>

<div class="col-md-12">
<div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                IPO
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Date</td>
                    <td>Name</td>
                    <td>Buy</td>
                    <td>Qty</td>
                    <td>Invested</td>
                    <td>@</td>
                    <td>P/L</td>
                    <td>Brokerage</td>
                    <td>STT</td>
                    <td>GST</td>
                    <td>Net PL</td>
                </tr>

                @foreach($item->assignedIpos as $ipo)
                    @php
                    $buyPrice = $ipo->ipo->block_amt / $ipo->ipo->lot_size;
                    if($ipo->status == 2)
                    {
                        continue;
                    }
                    $ldate = date('d M Y', strtotime($ipo->ipo->listing_date));
                    $totalInvested =  $ipo->share_qty * $ipo->ipo->price_band;
                    $clientNetPl += $ipo->final_net_pl;
                    /*if($ipo->sell_price != null)
                    {
                        $totalInvested =  $ipo->share_qty * $ipo->ipo->price_band;
                        $totalTransactionValue = $ipo->share_qty * $ipo->sell_price;
                        $brokerage = round($totalTransactionValue / 100 * .3 ) + 1;
                        $stt = round($totalTransactionValue / 100 * .1 );
                        $gst = ( $brokerage  ) / 100 * 18;
                        $finalProfit = $totalTransactionValue - $totalInvested- $brokerage - $stt - $gst;
                    }
                    else
                    {

                        $totalInvested =  $ipo->share_qty * $ipo->ipo->price_band;
                        $finalProfit = $gst = $stt = $brokerage = $totalTransactionValue = '';
                    }*/
                    @endphp
                    <tr>
                        <td>{!! $ldate !!}</td>
                        <td>
                            @php
                                $txtClass = '';
                                if($ipo->status == 2)
                                {
                                    $txtClass = 'text-warning';
                                }

                                if($ipo->status == 1)
                                {
                                    $txtClass = 'text-primary';
                                }

                                if(!in_array($ipo->status, [1,2]))
                                {
                                    $txtClass = 'text-success';
                                }

                            @endphp
                            <span class="font-weight-bold {!! $txtClass  !!}">
                                {!! $ipo->ipo->ipo_name !!}
                            </span>
                        </td>
                        
                        <td>{!! $buyPrice !!}</td>
                        <td>{!! $ipo->share_qty !!}</td>
                        <td>{!! $totalInvested !!}</td>
                        <td>{!! $ipo->sell_price !!}</td>
                        <td>    
                            @if($ipo->profit_loss > 0)
                                <span class="font-weight-bold text-success">
                                    {!! $ipo->profit_loss !!}
                                </span>
                            @elseif($ipo->profit_loss < 0)
                                <span class="text-danger">
                                    {!! $ipo->profit_loss !!}
                                </span>
                            @else
                                <span class="text-warning">
                                    {!! $ipo->profit_loss !!}
                                </span>
                            @endif
                            </td>
                        <td>{!! $ipo->brokerage_amount !!}</td>
                        <td>{!! $ipo->brokerage_stt   !!}</td>
                        <td>{!! $ipo->gst_value  !!}</td>
                        <td align="right">{!! $ipo->final_net_pl  !!}</td>
                    </tr>
                @endforeach
                <tfoot>
                    <td colspan="10"></td>
                    <td align="right">{!! $clientNetPl !!}</td>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<!-- 
<div class="col-md-12">
<div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                Stock List
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Title</td>
                    <td>Code</td>
                    <td>QTY</td>
                    <td>CMP</td>
                    <td>INFO</td>
                    <td>Notes</td>
                </tr>
                @php
                    $sr = 1;
                @endphp
                @foreach($item->stockList as $stock)
                    <tr>
                        <td>{!! $sr++; !!}</td>
                        <td>{!! $stock->title !!}</td>
                        <td>{!! $stock->code !!}</td>
                        <td>{!! $stock->qty !!}</td>
                        <td>{!! $stock->cmp !!}</td>
                        <td>
                            <a href="{!! $stock->external_link !!}" target="_blank" class="btn btn-xs btn-warning">
                                {!! $stock->qty * $stock->cmp !!}
                            </a>
                        </td>
                        <td>{!! $stock->notes !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div> -->

<div class="col-md-12">
<div class="card card-primary">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    Stock List
                </div>
                
                <div class="col-lg-2 text-right pull-right">
                    <a onclick="addNewStock()" href="javascript:void(0)" class="btn btn-xs btn-success">Add New</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Date</td>
                    <td>Title</td>
                    <td>Code</td>
                    <td>QTY</td>
                    <td>Buy Price</td>
                    <td>CMP</td>
                    <td>Investment</td>
                    <td>Current Value</td>
                    <td>Profit</td>
                    <td>Notes</td>
                    <td>Action</td>
                </tr>
                @php
                    $sr = 1;
                @endphp
                @foreach($myStocks as $stock)
                    @php
                        $invested = $stock->buy_qty * $stock->buy_cost;
                        $currentValue = $stock->buy_qty * $stock->stockDetail->cmp;
                        $profit = $currentValue - $invested;
                    @endphp
                    <tr>
                        <td>{!! $sr++; !!}</td>
                        <td>{!! date('d M Y', strtotime($stock->buy_date)) !!}</td>
                        <td>{!! $stock->stockDetail->title !!}</td>
                        <td><a href="{!! $stock->stockDetail->external_link !!}" target="_blank" class="btn btn-xs btn-warning">{!! $stock->stockDetail->code !!}</a></td>
                        <td>{!! $stock->buy_qty     !!}</td>
                        <td>{!! $stock->buy_cost !!}</td>
                        <td>{!! $stock->stockDetail->cmp !!}</td>
                        <td>{!! $invested !!}</td>
                        <td>{!! $currentValue !!}</td>
                        <td><span class="text-strong text-{!! $profit > 0 ? 'success' : 'danger'!!}">{!! $profit !!}</span></td>
                        <td>{!! $stock->notes !!}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-sm" onclick="settleTrade({!! $stock->id !!}, '{!! $stock->stockDetail->title !!}')">Settle</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>


<div class="col-md-12">
<div class="card card-primary">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    Stock Transactions
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Buy Date</td>
                    <td>Sell Date</td>
                    <td>Days</td>
                    <td>Title</td>
                    <td>Code</td>
                    <td>Buy / Sell Qty</td>
                    <td>Buy / Sell Price</td>
                    <td>Investment</td>
                    <td>Net Profit / Loss</td>
                    <td>Profit %</td>
                    <td>Tax</td>
                </tr>
                @php
                    $sr = 1;
                @endphp
                @foreach($stockTransactions as $stockTransaction)
                    @php
                        $invested = $stockTransaction->buy_qty * $stockTransaction->buy_cost;
                        $profitP = ($stockTransaction->net_profit * 100 ) /$invested;
                        $truncated = floor($profitP * 100) / 100;
                        
                    @endphp
                    <tr>
                        <td>{!! $sr++; !!}</td>
                        <td>{!! date('d M Y', strtotime($stockTransaction->buy_date))  !!}</td>
                        <td>{!! date('d M Y', strtotime($stockTransaction->sell_date))  !!}</td>
                        <td>{!! getDaysBetweenDates($stockTransaction->buy_date, $stockTransaction->sell_date) !!}</td>
                        <td>{!! $stockTransaction->stockDetail->title !!}</td>
                        <td><a href="{!! $stockTransaction->stockDetail->external_link !!}" target="_blank" class="btn btn-xs btn-warning">{!! $stockTransaction->stockDetail->code !!}</a></td>
                        <td>{!! $stockTransaction->buy_qty !!} / {!! $stockTransaction->sell_qty !!}</td>
                        <td>{!! $stockTransaction->buy_cost !!} / {!! $stockTransaction->sell_cost !!}</td>
                        <td>{!! $invested !!}</td>
                        <td>
                            @if($stockTransaction->is_profit == 1)
                                <span class="text-bold text-success">
                                    {!! $stockTransaction->net_profit !!}
                                </span>
                            @else
                                <span class="text-bold text-danger">
                                    {!! $stockTransaction->net_loss !!}
                                </span>
                            @endif
                        </td>
                        <td>{!! number_format($truncated, 2) !!} %</td>
                        <td>{!! $stockTransaction->tax !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                All Transactions
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Date</td>
                    <td>DEBIT</td>
                    <td>Credit</td>
                    <td>Notes</td>
                </tr>
                @foreach($item->transactions as $transaction)
                    <tr>
                        <td>{!! $transaction->id !!}</td>
                        <td>{!! $transaction->created_at !!}</td>
                        <td>{!! $transaction->debit ? $transaction->amount : '' !!}</td>
                        <td>{!! $transaction->credit ? $transaction->amount : '' !!}</td>
                        <td>{!! $transaction->notes !!}</td>
                    </tr>
                @endforeach
            </table>         
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                Monthly Fees
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Pay Month</td>
                    <td>Amount</td>
                    <td>Notes</td>
                    <td>Pay Date</td>
                </tr>
                @php
                    $sr = 1;
                @endphp
                @foreach($fees as $fee)
                    <tr>
                        <td>{!! $sr++ !!}</td>
                        <td>{!! strtoupper($fee->month_title) !!}</td>
                        <td>{!! $fee->fee_amount ?? '' !!}</td>
                        <td>{!! $fee->notes !!}</td>
                        <td>{!! showDateTime($fee->created_at) !!}</td>
                    </tr>
                @endforeach
            </table>         
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                My Documents
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Sr</td>
                    <td>Category</td>
                    <td>Title</td>
                    <td>View</td>
                </tr>
                @php
                    $sr = 1;
                @endphp
                @foreach($documents as $document)
                    <tr>
                        <td>{!! $sr++ !!}</td>
                        <td>{!! strtoupper($document->category) !!}</td>
                        <td>{!! strtoupper($document->title) !!}</td>
                        <td><a target="_blank" href="{!! $document->attachment !!}"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
            </table>         
        </div>
    </div>
</div>

</div>
    </div>

    <div class="card-footer">
        <div class="card-tools text-right">
        
        </div>
        <div class="clearfix"></div>
    </div>
</div>
{{ Form::close() }}

<!-- Modal -->
<div class="modal fade " id="addNewStockModal" tabindex="-1" role="dialog" aria-labelledby="addNewStockModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewStockModalTitle">
                Add New Stock
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
             <div class="form-group row">
                <label class="col-lg-2 control-label">Date: </label>
                <div class="col-md-2">
                    <input style="width:200px;" type="date" id="selectStockDate" name="selectStockDate" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Stock: </label>
                <div class="col-md-10">
                    <select id="selectStockid" name="selectStockid" class="form-control">
                        <option value="">Select</option>
                        @foreach($allStocks as $astock)
                            <option value="{!! $astock->id !!}">{!! $astock->title !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Cost: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="selectStockCost" name="selectStockCost" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Qty: </label>
                <div class="col-md-10">
                    <input type="number" step="1" style="width: 150px;" id="selectStockQty" name="selectStockQty" class="form-control" value="" />
                </div>
            </div>

        </div>
        <div class="modal-footer">
            
            <button type="button" onclick="storeClientStock()"  class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Modal END-->


<!-- Modal -->
<div class="modal fade " id="settleStockModal" tabindex="-1" role="dialog" aria-labelledby="settleStockModalLable" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="settleStockModalTitle">
                Settle Stock
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div id="formContainer">
                <div class="form-group row">
                    <label class="col-lg-2 control-label">Date: </label>
                    <div class="col-md-10">
                        <input type="date" id="settleStockDate" name="settleStockDate" class="form-control" value="" style="width:200px;" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Stock: </label>
                    <div class="col-md-10" id="settleStockTitle"></div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Cost: </label>
                    <div class="col-md-10">
                        <input type="number" step="0.1" style="width: 150px;" id="settleStockCost" name="settleStockCost" class="form-control" value="" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Qty: </label>
                    <div class="col-md-10">
                        <input type="number" step="1" style="width: 150px;" id="settleStockQty" name="settleStockQty" class="form-control" value="" />
                    </div>
                </div>
            </div>

            <div id="verifyContainer" style="display: none;">
                <div class="form-group row">
                    <label class="col-lg-2 control-label">Date: </label>
                    <div class="col-md-10" id="showsettleStockDate"></div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Stock: </label>
                    <div class="col-md-10" id="showsettleStockTitle"></div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Cost: </label>
                    <div class="col-md-10" id="showsettleStockCost"></div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 control-label">Qty: </label>
                    <div class="col-md-10" id="showsettleStockQty"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="clientStockId" id="clientStockId" value="">
            <input type="hidden" name="isAjax" id="isAjax" value="">
            <button type="button" id="settleBtn" onclick="settleClientStock()"  class="btn btn-success">Settle</button>
            <button type="button" id="cancelBtn" onclick="settleClientStockCancel()"  class="btn btn-secondary">Cancel</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Modal END-->


<!-- Modal -->
<div class="modal fade " id="addFeeModal" tabindex="-1" role="dialog" aria-labelledby="addFeeModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addBalanceModalTitle">
                Add Fee: {!!  $item->name !!}
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Select Month: </label>
                <div class="col-md-10">
                        {{ Form::select('fee_month', $months, null, ['class' => 'form-control', 'placeholder' => 'Select Month', 'id' => 'fee_month']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 control-label">Amount: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="fee" name="fee" class="form-control" value="{!!  $item->monthly_fee ?? 500 !!}" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="fee_notes" name="fee_notes" class="form-control" value="Monthly Fee" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="storeFee()"  class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade " id="addBalanceModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addBalanceModalTitle">
                Add Balance: <span id="clientTitleContainer"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Amount: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="amount" name="amount" class="form-control" value="0" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="notes" name="notes" class="form-control" value="Adding Balance" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="clientId" id="clientId" value="">
            <button type="button" onclick="storeBalance()"  class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade " id="assignIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                Assign IPO: {!! $item->name !!}
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Select: </label>
                <div class="col-md-10">
                    <select onchange="setLotSize()" class="form-control" name="ipoId" id="ipoId">
                        <option value="">Select IPO</option>
                        @foreach($eligibleIpos as $eligibleIpo)
                            <option 
                            data-min-lot="{!! $eligibleIpo->min_lot_size !!}"
                            data-max-lot="{!! $eligibleIpo->max_lot_size !!}"
                            data-price-band="{!! $eligibleIpo->price_band !!}"
                            value="{!! $eligibleIpo->id !!}">
                                {!! $eligibleIpo->ipo_name !!}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

             <div class="form-group row">
                <label class="col-lg-2 control-label">Size: </label>
                <div class="col-md-10">
                    <select class="form-control" name="ipoLotSize" id="ipoLotSize">
                        <option value="">Select SIZE</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="ipo_notes" name="ipo_notes" class="form-control" value="Apply IPO" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="clientId" id="clientId" value="">
            <button type="button" onclick="applyIpo()"  class="btn btn-success">Apply</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@endsection


@section('after-scripts')
<script type="text/javascript">

function addBalance(clientId, clientTitle)
{
    jQuery("#addBalanceModal").modal('show');
    jQuery("#clientTitleContainer").html(clientTitle);
    jQuery("#clientId").val(clientId);
    console.log(clientId);
}

function addFee(clientId)
{
    jQuery("#addFeeModal").modal('show');
}

function assignIpo(clientId)
{
    jQuery("#assignIpoModal").modal('show');
}

function storeBalance()
{
    var clientId = jQuery("#clientId").val();
    var amount = jQuery("#amount").val();

    if(parseFloat(amount) < 0)
    {
        swal('Oh', 'Please enter valid amount','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.transactions.add-balance')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           client_id: clientId,
           notes: jQuery("#notes").val(),
           amount,
        },
        success : function(data) 
        {
            jQuery("#addBalanceModal").modal('hide');
            if(data.status == true)
            {
                swal('Yeah.', 'Balance added successfully.', 'success');   
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

                return;
            }
            swal('Oh', 'Something went Wrong','error');
        },
        complete: function() {
            jQuery("#addBalanceModal").modal('hide');
        }
    });
}

function storeFee()
{
    var clientId = {!! $item->id !!}
    var amount = jQuery("#fee").val();

    if(parseFloat(amount) < 0)
    {
        swal('Oh', 'Please enter valid amount','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.fees.pay-client')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           client_id: clientId,
           notes: jQuery("#fee_notes").val(),
           month_title: jQuery("#fee_month").val(),
           fee_amount: amount,
        },
        success : function(data) 
        {
            jQuery("#addFeeModal").modal('hide');
            if(data.status == true)
            {
                swal('Yeah.', 'Fee added successfully.', 'success');   
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

                return;
            }
            swal('Oh', data.message,'error');
        },
        complete: function() {
            jQuery("#addFeeModal").modal('hide');
        }
    });
}

function applyIpo()
{
    var client_id    = {!! $item->id !!};
    var ipo_id       = jQuery("#ipoId").val();
    var applied_date = "{!! date('Y-m-d') !!}";
    var lotSize      = jQuery("#ipoLotSize").val();

    if(ipo_id.trim() == '')
    {
        swal('Oh', 'Please select valid IPO','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.ipoassignments.assign-client')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           client_id,
           ipo_id,
           lotSize,
           applied_date,
           status: 1,
           notes: jQuery("#ipo_notes").val(),
        },
        success : function(data) 
        {
            jQuery("#assignIpoModal").modal('hide');

            if(data.status == true)
            {
                swal('Yeah.', 'Ipo Assigned successfully.', 'success');   
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

                return;
            }
            swal('Oh', 'Something went Wrong','error');
        },
        complete: function() {
            jQuery("#assignIpoModal").modal('hide');
        }
    });
}

/**
 * Set Lot Size
 * 
 */
function setLotSize()
{
    jQuery("#ipoLotSize").empty();
    jQuery('#ipoLotSize')
        .append($("<option></option>")
        .attr("value", '')
        .text('Select Lot')); 

    var minLot      = $("#ipoId").find(':selected').attr('data-min-lot');
    var maxLot      = $("#ipoId").find(':selected').attr('data-max-lot')
    var priceBand   = $("#ipoId").find(':selected').attr('data-price-band');

    jQuery('#ipoLotSize')
        .append($("<option></option>")
        .attr("value", minLot)
        .text('Min Lot ( '+ minLot * priceBand+' )')); 

    jQuery('#ipoLotSize')
        .append($("<option></option>")
        .attr("value", maxLot)
        .text('Max Lot ( '+ maxLot * priceBand+' )' )); 

}

function addNewStock()
{
    jQuery("#addNewStockModal").modal('show');
    jQuery("#selectStockCost").val('');
    jQuery("#selectStockQty").val('');
    jQuery("#selectStockid").val('');
}

function storeClientStock()
{
    var clientId = {!! $item->id !!};
    var date = jQuery("#selectStockDate").val();
    var stockId = jQuery("#selectStockid").val();
    var cost = jQuery("#selectStockCost").val();
    var qty = jQuery("#selectStockQty").val();

    if(parseFloat(cost) < 0 || parseFloat(qty) < 1)
    {
        swal('Oh', 'Please enter valid cost or QTY','error');
        return;
    }
    
    if(stockId == '')
    {
        swal('Oh', 'Please Select valid Stock','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.clientstock.add-new')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
            clientId,
            date,
            stockId,
            cost,
            qty
        },
        success : function(data) 
        {
            jQuery("#addNewStockModal").modal('hide');
            if(data.status == true)
            {
                swal('Yeah.', 'Stock added successfully.', 'success');   
                // setTimeout(function() {
                //     window.location.reload();
                // }, 2000);

                return;
            }

            swal('Oh', 'Something went Wrong','error');
        }
    });
}

function settleClientStock()
{
    var clientId = {!! $item->id !!};
    var date = jQuery("#settleStockDate").val();
    var stockId = jQuery("#clientStockId").val();
    var cost = jQuery("#settleStockCost").val();
    var qty = jQuery("#settleStockQty").val();

    if(parseFloat(cost) < 0 || parseFloat(qty) < 1)
    {
        swal('Oh', 'Please enter valid cost or QTY','error');
        return;
    }
    
    if(stockId == '')
    {
        swal('Oh', 'Please Select valid Stock','error');
        return;
    }

    if(jQuery("#isAjax").val().toString() == "1")
    {
        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.clientstock.settle')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
                clientId,
                date,
                stockId,
                cost,
                qty
            },
            success : function(data) 
            {
                jQuery("#settleStockModal").modal('hide');
                if(data.status == true)
                {
                    swal('Yeah.', 'Stock settled successfully.', 'success');
                    setTimeout(function() 
                    {
                        window.location.reload();
                    }, 1000);

                    return;
                }

                swal('Oh', 'Something went Wrong','error');
            }
        });

        jQuery("#isAjax").val(0);
    }
    else
    {
        jQuery("#isAjax").val(1);
        jQuery("#verifyContainer").show();
        jQuery("#formContainer").hide();
        jQuery("#settleBtn").html('Settle Now');
        
        jQuery("#showsettleStockDate").html(date);
        jQuery("#showsettleStockCost").html(cost);
        jQuery("#showsettleStockQty").html(qty);
        jQuery("#showsettleStockDate").html();
    }
}

function settleTrade(clientStockId, title)
{
    jQuery("#settleStockTitle").html(title);
    jQuery("#showsettleStockTitle").html(title);
    jQuery("#settleStockModal").modal('show');
    jQuery("#selectStockCost").val('');
    jQuery("#selectStockQty").val('');
    jQuery("#selectStockid").val('');
    jQuery("#clientStockId").val(clientStockId);
}

function settleClientStockCancel()
{
    jQuery("#settleStockCost").val('');
    jQuery("#settleStockQty").val('');
    jQuery("#selectStockid").val('');
    jQuery("#clientStockId").val('');
    jQuery("#isAjax").val('');
    jQuery("#verifyContainer").hide();
    jQuery("#formContainer").show();
    jQuery("#settleBtn").html('Settle');
}
</script>
@endsection