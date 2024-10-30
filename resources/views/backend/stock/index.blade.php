@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($repository->moduleTitle) ? str_plural($repository->moduleTitle) : '' }} Listing
        </h3>
        <div class="card-tools">
            @include('common.'.strtolower($repository->moduleTitle).'.header-buttons', ['createRoute' =>
            $repository->getActionRoute('createRoute')])
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="items-table" class="table table-bordered table-hover">
                <thead>
                    <tr id="tableHeadersContainer"></tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade " id="sellStockModal" tabindex="-1" role="dialog" aria-labelledby="sellStockModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addBalanceModalTitle">
                Sell Stock: <span id="stockTitleContainer"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Qty: </label>
                <div class="col-md-10">
                    <input type="number" step="1" style="width: 150px;" id="qty" name="qty" class="form-control" value="0" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Price: </label>
                <div class="col-md-10">
                    <input type="number" step="1" style="width: 150px;" id="price" name="price" class="form-control" value="0" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="notes" name="notes" class="form-control" value="Sell Stock" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="stockId" id="stockId" value="">
            <button type="button" onclick="sellFinalStock()"  class="btn btn-success">Sell Now</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@endsection

@section('after-scripts')
<script type="text/javascript">
var headers = JSON.parse('{!! $repository->getTableHeaders() !!}'),
    columns = JSON.parse('{!! $repository->getTableColumns() !!}'),
    moduleConfig = {
        getTableDataUrl: '{!! route($repository->getActionRoute("dataRoute")) !!}'
    };

jQuery(document).ready(function() {
    BaseCommon.Utils.setTableHeaders(document.getElementById("tableHeadersContainer"), headers);
    BaseCommon.Utils.setTableColumns(document.getElementById("items-table"), moduleConfig.getTableDataUrl,
        'GET', columns);
});

function sellStock(stockId, title, max)
{
    jQuery("#sellStockModal").modal('show');
    jQuery("#stockTitleContainer").html(title);
    jQuery("#qty").val(max);
    jQuery("#stockId").val(stockId);
    jQuery("#qty").attr('max', max);
}


function sellFinalStock()
{
    var qty = jQuery("#qty").val();
    var rate = jQuery("#price").val();
    var stockId = jQuery("#stockId").val();
    var notes = jQuery("#notes").val();

    if(qty < 1)
    {
        swal('Oh', 'Please enter valid Qty','error');
        return;
    }

    if(rate < 1)
    {
        swal('Oh', 'Please enter valid amount','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.stock.sell')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           qty,
           rate,
           stockId,
           notes
        },
        success : function(data) {
            swal.close();
            window.location.reload();
        },
        complete: function() {
            
        }
    });
}
</script>
@endsection