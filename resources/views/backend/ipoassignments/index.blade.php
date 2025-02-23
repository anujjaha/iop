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

function revokeIpo(assignmentId)
{
    swal({
    title: "Sure, allotment not received",
    text: "You will not be able to recover operation",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
    },
    function(isConfirm)
    {
        if (isConfirm)
        {
            revokeSuccess(assignmentId);
        } else 
        {
            swal.close();
        }
    });
}

function allotedIpo(assignmentId)
{
    swal({
    title: "Sure, successfully alloted",
    text: "You will not be able to recover operation",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!",
    closeOnConfirm: false,
    closeOnCancel: false
    },
    function(isConfirm)
    {
        if (isConfirm)
        {
            allottedSuccess(assignmentId);
        } else 
        {
            swal.close();
        }
    });
};

function revokeSuccess(assignmentId)
{
    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.ipoassignments.revoke-ipo')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           assignmentId
        },
        success : function(data) {
            swal.close();
            window.location.reload();
        },
        complete: function() {
            
        }
    });
}

function allottedSuccess(assignmentId)
{
    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.ipoassignments.alloted-ipo')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           assignmentId
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

