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
    function getClients()
    {
        jQuery('#client_id').empty();
        
        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.fees.get-clients')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
                monthTitle: jQuery("#month_title").val(),
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
                        .attr("monthly-fees", clientList[i].monthly_fee)
                        .text(clientList[i].name + ' ('+ clientList[i].monthly_fee +')')); 
                    }
                }
            },
            complete: function() 
            {
            
            }
        });
    }

    function validateClient()
    {
        var fee = jQuery("#client_id").find(':selected').attr('monthly-fees');
        jQuery("#fee_amount").val(parseInt(fee));
    }
</script>
@endsection