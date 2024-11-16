@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">IPO Assginment Listing
        </h3>
        <div class="card-tools">
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="items-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Sr</td>
                        <td>IPO</td>
                        <td>Retail</td>
                        <td>SHNI</td>
                        <td>Total Amount</td>
                        <td>PL</td>
                        <td>Listing Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sr = 1;
                    @endphp
                    @foreach($list as $ipo)
                    	@php
                    		$retail = $ipo->assignments->where('share_qty', $ipo->min_lot_size)->count();
                    		$shni   = $ipo->assignments->where('share_qty', $ipo->max_lot_size)->count();
                    		$profit = $ipo->assignments->sum('profit_loss');
                    	@endphp
                        <tr>
                             <td>{!! $sr++; !!}</td>
                            <td>
                            	{!! $ipo->ipo_name !!}
                            	<br />
                            	{!! $ipo->min_lot_size !!} / {!! $ipo->max_lot_size !!} @ {!! $ipo->price_band !!}
                            </td>
                            <td>{!! $retail !!}</td>
                            <td>{!! $shni !!}</td>
                            <td>{!! ( ($retail * $ipo->min_lot_size) * $ipo->price_band ) + ( ($shni * $ipo->max_lot_size) * $ipo->price_band ) !!}</td>
                            
                            <td>{!! $profit !!}</td>
                            <td>{!! $ipo->listing_date !!}</td>
                            <td>
                                <a href="{!! route('admin.ipoassignments.filter', $ipo->id) !!}" class="btn btn-xs btn-warning" target="_blank">Allotment</a>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('after-scripts')
<script type="text/javascript">

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
            //window.location.reload();
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

