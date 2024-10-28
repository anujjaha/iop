@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')

@section('page-header')
<h1>CLIENT INFO</h1>
@endsection

@section('content')
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

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">P & L</span>
                        <span class="info-box-number">{!! $item->assignedIpos->sum('profit_loss') !!}</span>
                    </div>
                </div>
            </div>

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
                        <span class="info-box-number">{!! $item->assignedIpos->sum('profit_loss_aftertax') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
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
            </div>

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
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Basic Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-3 control-label">Name :</label>
                        <div class="col-lg-9">
                            Anuj
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="mobile" class="col-lg-3 control-label">Mobile :</label>
                        <div class="col-lg-9">
                            8000060541
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="email" class="col-lg-3 control-label">Email :</label>
                        <div class="col-lg-9">
                            anuj@yopmail.com
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="aadhar_no" class="col-lg-3 control-label">Aadhar No. :</label>
                        <div class="col-lg-9">
                            7011200253
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group row row">
                    <label for="pan" class="col-lg-3 control-label">PAN:</label>
                        <div class="col-lg-9">
                            ASDF862N
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="dmat_co_name" class="col-lg-3 control-label">DMAT Co. Name:</label>
                        <div class="col-lg-9">
                           Zerodha
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="dmat_account" class="col-lg-3 control-label">Dmat Account:</label>
                        <div class="col-lg-9">
                            608787647376
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row row">
                        <label for="bank_name" class="col-lg-3 control-label">Bank Name:</label>
                        <div class="col-lg-9">
                            Kotak Mahindra Bank
                        </div>
                    </div>
                    <div class="form-group row row">
                        <label for="otTotalPay" class="col-lg-3 control-label">Bank Account:</label>
                        <div class="col-lg-9">
                            1293084857
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
                    <td>Name</td>
                    <td>Status</td>
                    <td>Block</td>
                    <td>Invested</td>
                    <td>P/L</td>
                </tr>
                @foreach($item->assignedIpos as $ipo)
                    <tr>
                        <td>{!! $ipo->ipo->ipo_name !!}</td>
                        <td>{!! getAssignmentLiveStatus($ipo->status) !!}</td>
                        <td>{!! $ipo->status == 1 ? $ipo->share_qty * $ipo->ipo->price_band : 'N/A' !!}</td>
                        <td>{!! $ipo->share_qty * $ipo->ipo->price_band !!}</td>
                        <td>{!! $ipo->profit_loss !!}</td>
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
                <label class="col-lg-2 control-label">Amount: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="fee" name="fee" class="form-control" value="{!!  $item->monthly_fee !!}" />
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
           month_title: '{!! strtolower(date("M-Y")) !!}',
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
</script>
@endsection