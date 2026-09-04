@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')

@section('page-header')
<h1>
    {{$repository->moduleTitle}}
    <small>Edit</small>
</h1>
@endsection

@section('content')
{{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $repository->moduleTitle }}</h3>
        <div class="card-tools pull-right">
            @include('common.'.strtolower($repository->moduleTitle).'.header-buttons', [
            'listRoute' => $repository->getActionRoute('listRoute'),
            'createRoute' => $repository->getActionRoute('createRoute')
            ])
        </div>
    </div>

    <div class="card-body">
        {{-- Module Form --}}
        @include('common.'.strtolower($repository->moduleTitle).'.form')
    </div>

    <div class="card-footer">
        <div class="card-tools text-right">
            {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
            {{ link_to_route($repository->getActionRoute('listRoute'), 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
{{ Form::close() }}
@endsection

@section('after-scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$('.date-picker').datepicker({

    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true
});
function parseDDMMYYYY(dateStr) {
    if (!dateStr) {
        return null;
    }

    var parts = dateStr.split('/');

    if (parts.length !== 3) {
        return null;
    }

    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10) - 1; // JS month starts from 0
    var year = parseInt(parts[2], 10);

    return new Date(year, month, day);
}

    function calculateFund()
    {
        var loanAmount = jQuery("#loan_amount").val();
        var priceBand = jQuery("#price_band").val();
        var retailQty = jQuery("#lot_size").val();
        var shniQty = jQuery("#max_lot_size").val();
        var bhniQty = jQuery("#bhni_lot_size").val();
        var reailApp = jQuery("#retail_applications").val();
        var shniApp = jQuery("#shni_applications").val();
        var bhniApp = jQuery("#bhni_applications").val();

        var retailInvest    = priceBand * retailQty * reailApp;
        var shniInvest      = priceBand * shniQty * shniApp;
        var bhniInvest      = priceBand * bhniQty * bhniApp;

        var totalInvestment = retailInvest + shniInvest + bhniInvest;
        
        var closeDate = parseDDMMYYYY(jQuery("#closing_date").val());
        var listDate = parseDDMMYYYY(jQuery("#refund_date").val());

        var close = new Date(closeDate);
        var list = new Date(listDate);

        var diffDays = Math.round((list - close) / (1000 * 60 * 60 * 24));

        
        var totalInterest = Math.ceil((((loanAmount * 10) / 100) / 365) * (diffDays + 1)) ;

        jQuery("#block_amt").val(totalInvestment);
        jQuery("#block_days").val(diffDays);
        jQuery("#loan_interest").val(totalInterest);
        
        var paidInterest = Math.ceil((((totalInvestment * 2.5) / 100) / 365) * diffDays);
        jQuery("#paid_interest").val(paidInterest);
        
        jQuery("#risk_amount").val(parseInt(totalInterest-paidInterest));
    }
</script>

@endsection