@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')

@section('page-header')
<h1>IPO: {!! $item->ipo_name !!}</h1>
@endsection

@section('content')
{{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        
                                Basic Details
                            <div class="card-tools pull-right float-right">
                                @if($clientList && count($clientList))
                                    <a href="javascript:void(0)" onclick="assignIpo({!! $item->id !!})" class="btn btn-xs btn-success">Assign</a>
                                @endif
                            </div>
                        
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
                                        {!! $item->lot_size !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Amount:</label>
                                    <div class="col-lg-7">
                                        {!! $item->block_amt !!}
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
                                        {!! $item->assignments->

                                        whereNull('profit_loss')->pluck('profit_loss')->sum()  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Alloted:</label>
                                    <div class="col-lg-7">
                                        {!! $item->assignments->whereNotNull('profit_loss')->count()  !!}
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


        <table class="table table-bordered">
            <tr>
                <td>SR</td>
                <td>Name</td>
                <td>Allotment</td>
                <td>P/L</td>
                <td>Blocked Amount</td>
            </tr>

            @php
                $sr = 1;
                $totalBlock = 0;
            @endphp
            @foreach($item->assignments as $assignment)
                <tr>
                    <td>{!! $sr !!}</td>
                    <td>{!! $assignment->client->name !!}</td>
                    <td>{!! $assignment->status !!}</td>
                    <td>{!! $assignment->profit_loss !!}</td>
                    <td class="text-right">{!! $item->block_amt !!}</td>
                </tr>
                @php
                    $sr++;
                    $totalBlock = $totalBlock + $item->block_amt;
                @endphp
            @endforeach
             <tr>
                <td colspan="4">-</td>
                <td class="text-right text-strong"><strong>{!! $totalBlock !!}</strong></td>
            </tr>
        </table>
    </div>

    <div class="card-footer">
        <div class="clearfix"></div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade " id="assignIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                IPO: {!! $item->ipo_name !!} ( {!! $item->block_amt !!} )
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Select: </label>
                <div class="col-md-10">
                    <select class="form-control" name="client_id" id="client_id">
                        <option value="">Select Client</option>
                        @foreach($clientList as $client)
                            <option value="{!! $client->id !!}">
                                {!! $client->name !!} ({!! $client->balance !!})
                            </option>
                        @endforeach
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
{{ Form::close() }}
@endsection


@section('after-scripts')
<script type="text/javascript">

function assignIpo(clientId)
{
    jQuery("#assignIpoModal").modal('show');
}

function applyIpo()
{
    var client_id    = jQuery("#client_id").val();
    var ipo_id       = {!! $item->id !!};
    var applied_date = "{!! date('Y-m-d') !!}";

    if(client_id.trim() == '')
    {
        swal('Oh', 'Please select valid Client','error');
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
</script>
@endsection