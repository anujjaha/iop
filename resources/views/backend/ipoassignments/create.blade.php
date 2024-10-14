@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Create - '. $repository->moduleTitle : 'Create')

@section('page-header')
<h1>
    {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}
    <small>Create</small>
</h1>
@endsection

@section('content')
{{ Form::open([
        'route'     => $repository->getActionRoute('storeRoute'),
        'class'     => 'form-horizontal',
        'role'      => 'form',
        'method'    => 'post'
    ])}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}</h3>

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
            {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
            {{ link_to_route($repository->getActionRoute('listRoute'), 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
{{ Form::close() }}
@endsection


@section('after-scripts')

<script type="text/javascript">
    @if($requestedIpo)
        getClients();
    @endif

    function getClients()
    {
        jQuery('#client_id').empty();
        
        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.ipoassignments.get-clients')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
                ipoId: jQuery("#ipo_id").val(),
            },
            success : function(data) {
                if(data.status == true)
                {
                    var clientList = data.clientList;
                    jQuery('#client_id')
                        .append($("<option></option>")
                        .attr("value", '')
                        .text('Please select')); 

                    for(var i = 0; i < clientList.length; i++)
                    {
                        jQuery('#client_id')
                        .append($("<option></option>")
                        .attr("value", clientList[i].id)
                        .attr("current-bal", clientList[i].balance)
                        .text(clientList[i].name + ' ('+ clientList[i].balance +')')); 
                    }
                }
                console.log(data);
            },
            complete: function() {
                
            }
        });
    }

    function validateClient()
    {
        var clientBal = jQuery("#client_id").find(':selected').attr('current-bal');
        if(clientBal < 1)
        {
            alert('No Sufficient Fund for IPO!');
            jQuery("#client_id").val('');
        }
    }
</script>
@endsection