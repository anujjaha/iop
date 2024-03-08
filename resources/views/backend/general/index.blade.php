@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')

<style type="text/css">

.bgBlur {
    opacity: 0.2;
}
.zoomItem img:hover
{
    transition:all 0.6s; /* Change Speed */
    -ms-transform: scale(2, 2); /* IE 9 */
    -webkit-transform: scale(2, 2); /* Safari */
    transform: scale(2, 2); /* Change Size */
    overflow:visible;
    opacity: 1;
    z-index:2 !important; /* you can change it, but better let this in default */
    background-color: white;
}

</style>

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
        <div class="table-responsive zoomItem">
            <table id="items-table" class="table table-bordered table-hover">
                <thead>
                    <tr id="tableHeadersContainer"></tr>
                </thead>
            </table>
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

    // $(".zoomItem img").mouseover(function(){
    //     $("body").addClass('bgBlur');
    // });

    // $(".zoomItem img").mouseout(function(){
    //     $("body").removeClass('bgBlur');
    // });
});
</script>
@endsection