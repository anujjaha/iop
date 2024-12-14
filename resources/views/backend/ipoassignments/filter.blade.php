@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3>{!! $item->ipo_name !!}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Start:</label>
                        <div class="col-lg-7">
                            {!! $item->opening_date !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">END:</label>
                        <div class="col-lg-7">
                            {!! $item->closing_date !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Lot Size:</label>
                        <div class="col-lg-7">
                            {!! $item->min_lot_size !!} / {!! $item->max_lot_size !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Amount:</label>
                        <div class="col-lg-7">
                            {!! $item->min_lot_size * $item->price_band  !!} / {!! $item->max_lot_size * $item->price_band  !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Applied:</label>
                        <div class="col-lg-7">
                            {!! count($item->assignments) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Blocked:</label>
                        <div class="col-lg-7">
                            {!! $item->assignments->whereNull('profit_loss')->pluck('profit_loss')->sum()  !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">Alloted:</label>
                        <div class="col-lg-7">
                            {!! $item->assignments->where('status', '!=', 2)->count()  !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row row">
                        <label for="name" class="col-lg-5 control-label">P/L:</label>
                        <div class="col-lg-7">
                            {!! $item->assignments->sum('profit_loss')  !!}
                        </div>
                    </div>
                </div>


            </div>  
        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($repository->moduleTitle) ? str_plural($repository->moduleTitle) : '' }} Listing
        </h3>
        <div class="card-tools">
            <a href="javascript:void(0);" onclick="bulkIpoAction(0)" class="btn btn-xs btn-warning">Non Allotment</a>
            <a href="javascript:void(0);"  onclick="bulkIpoAction(1)" class="btn btn-xs btn-primary">Allotment</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="items-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Sr</td>
                        <td>Client</td>
                        <td>PAN</td>
                        <td>Amount</td>
                        <td>Assignment</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sr = 1;
                    @endphp
                    @foreach($list as $item)
                        <tr>
                            <td>
                                @if($item->status == 1)
                                    <input class="form-control bulk-action" type="checkbox"  name="actionid_{!! $item->id !!}" name="actionid_{!! $item->id !!}" class="bulk_action" value="{!! $item->id !!}">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{!! route('admin.clientdetail.show', $item->client_id) !!}" target="_blank">
                                {!! $item->client->getFullName() !!}
                                </a>
                        </td>
                            <td>{!! $item->client->pan_no !!}</td>
                            <td>{!! $item->share_qty * $item->ipo->price_band !!}</td>
                            <td>
                                @if($item->status == 1)
                                <a href="javascript:void(0);" onclick="revokeIpo({!! $item->id !!})" class="btn btn-xs btn-primary"><i class="fa fa-trash"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="allotedIpo({!! $item->id !!})" class="btn btn-xs btn-primary"><i class="fa fa-check"></i></a>
                                @else
                                    {!! getAssignmentLiveStatus($item->status) !!}
                                @endif
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

function bulkIpoAction(isAlloted = 0)
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
            if(isAlloted == 0)
            {
                revokeSuccess(0, true);
            }
            else
            {
                allottedSuccess(0, true);
            }
        } else 
        {
            swal.close();
        }
    });
}


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

function revokeSuccess(assignmentId = 0, isbulk = false)
{
    var isBlukOpt = 0;
    var bulkIds = [];
    if(isbulk == true)
    {
        isBlukOpt = 1;

        jQuery('.bulk-action:checkbox:checked').each(function(i,j) {
            bulkIds.push(jQuery(j).val());
        });
    }
    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.ipoassignments.revoke-ipo')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           assignmentId,
           isBlukOpt,
           bulkIds,
        },
        success : function(data) {
            swal.close();
            setTimeout(function() {
                window.location.reload();
            }, 100);
        },
        complete: function() {
            
        }
    });
}

function allottedSuccess(assignmentId =0, isbulk = false)
{
    var isBlukOpt = 0;
    var bulkIds = [];
    if(isbulk == true)
    {
        isBlukOpt = 1;

        jQuery('.bulk-action:checkbox:checked').each(function(i,j) {
            bulkIds.push(jQuery(j).val());
        });
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.ipoassignments.alloted-ipo')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
            assignmentId,
            isBlukOpt,
            bulkIds,
        },
        success : function(data) 
        {
            swal.close();
            if(data.status)
            {
                window.location.reload();
            }
        },
        complete: function() {
            
        }
    });
}

</script>
@endsection

