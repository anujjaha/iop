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
<div class="modal fade " id="simPlanModal" tabindex="-1" role="dialog" aria-labelledby="simPlanModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                SIM PLAN
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                
            <div class="form-group row">
                {{ Form::label('title', 'Title :', ['class' => 'col-lg-4 control-label']) }}
                <div class="col-lg-8">
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required', 'id' => 'plan_title']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('cost', 'Cost :', ['class' => 'col-lg-4 control-label']) }}
                <div class="col-lg-8">
                    {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost', 'required' => 'required', 'id' => 'plan_cost']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('recharge_date', 'Recharge Date :', ['class' => 'col-lg-4 control-label']) }}
                <div class="col-lg-8">
                    {{ Form::date('recharge_date', null, ['class' => 'form-control', 'placeholder' => 'Recharge Date', 'required' => 'required', 'id' => 'plan_date']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('expire_date', 'Expire Date :', ['class' => 'col-lg-4 control-label']) }}
                <div class="col-lg-8">
                    {{ Form::date('expire_date', null, ['class' => 'form-control', 'placeholder' => 'Expire Date', 'required' => 'required', 'id' => 'plan_expire_date']) }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="simId" id="simId" value="">
            <button type="button" onclick="attachPlanSave()"  class="btn btn-success">Apply</button>
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

function attachPlan(simId)
{
    jQuery("#simPlanModal").modal('show');
    jQuery("#simId").val(simId);
}

function attachPlanSave()
{
    var planTitle = jQuery("#plan_title").val();
    var planCost  = jQuery("#plan_cost").val();
    var planDate  = jQuery("#plan_date").val();
    var planEDate = jQuery("#plan_expire_date").val();
    var simId     = jQuery("#simId").val();

    if(planTitle.trim() == '')
    {
        swal('Oh', 'Please Add Plan Title','error');
        return;
    }

    if(planCost.trim() == '')
    {
        swal('Oh', 'Please Add Plan Cost','error');
        return;
    }

    if(planDate.trim() == '')
    {
        swal('Oh', 'Please Add Date','error');
        return;
    }

    if(planEDate.trim() == '')
    {
        swal('Oh', 'Please Add Expire Date','error');
        return;
    }

    jQuery.ajax(
    {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url(route('admin.simplan.add-new')) }}",
        dataType : 'json',
        type : 'POST',
        data : {
           planTitle,
           planCost,
           planDate,
           planEDate,
           simId
        },
        success : function(data) 
        {
            jQuery("#simPlanModal").modal('hide');

            if(data.status == true)
            {
                swal('Yeah.', 'SIM Plan updated successfully.', 'success');   
                setTimeout(function() {
                    window.location.reload();
                }, 1000);

                return;
            }
            swal('Oh', 'Something went Wrong','error');
        },
        complete: function() {
            jQuery("#simPlanModal").modal('hide');
        }
    });
}
</script>
@endsection