@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Alloted List
        </h3>
        <div class="card-tools">
        
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="items-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                    	<td>Client</td>
                    	<td>IPO</td>
                    	<td>Buy At</td>
                    	<td>QTY</td>
                    	<td>Invested</td>
                    	<td>Action</td>
                    </tr>

                    @foreach($records as $record)
                    	<tr>	
	                    	<td>{!! $record->client->name !!}</td>
	                    	<td>{!! $record->ipo->ipo_name !!}</td>
	                    	<td>{!! $record->ipo->price_band !!}</td>
	                    	<td>{!! $record->share_qty !!}</td>
	                    	<td>{!! $record->share_qty * $record->ipo->price_band !!}</td>
	                    	<td>
	                    		<a  onclick="settleAllotment({!! $record->id !!}, `{!! $record->ipo->ipo_name  !!} | {!! $record->client->name!!} `)" href="javascript:void(0);" class="btn btn-xs btn-primary">Settle</a>
	                    	</td>
	                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</div>


<div class="modal fade " id="settleIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="settleIpoTitle">
                Settle IPO: <span id="clientTitleContainer"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Rate: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="rate" name="rate" class="form-control" value="0" />
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
            <input type="hidden" name="assignmentId" id="assignmentId" value="">
            <button type="button" onclick="updateAssignment()"  class="btn btn-success">Settle</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@endsection

@section('after-scripts')
<script type="text/javascript">
	function settleAllotment(id, title)
	{
		jQuery("#settleIpoModal").modal('show');
	    jQuery("#clientTitleContainer").html(title);
	    jQuery("#assignmentId").val(id);
	}

	function updateAssignment()
	{
	    var assignmentId = jQuery("#assignmentId").val();
	    var amount = jQuery("#rate").val();

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
	        url : "{{ url(route('admin.ipoassignments.settle-ipo')) }}",
	        dataType : 'json',
	        type : 'POST',
	        data : {
	           assignmentId: assignmentId,
	           notes: jQuery("#notes").val(),
	           amount,
	        },
	        success : function(data) 
	        {
	            jQuery("#settleIpoModal").modal('hide');
	            if(data.status == true)
	            {
	                swal('Yeah.', 'IPO Settled successfully.', 'success');   
	                setTimeout(function() {
	                    //window.location.reload();
	                }, 2000);

	                return;
	            }
	            swal('Oh', 'Something went Wrong','error');
	        },
	        complete: function() {
	            jQuery("#settleIpoModal").modal('hide');
	        }
	    });
	}
</script>
@endsection