@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
@php
    $mcxData = getMcxStats();
@endphp
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
          <div class="card card-primary">
                    <div class="card-header">
                        Basic Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-3 control-label">Total:</label>
                                    <div class="col-lg-8">{!! $mcxData['total'] !!}</div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-3 control-label">Buy:</label>
                                    <div class="col-lg-8">{!! $mcxData['buy'] !!}</div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-3 control-label">Sell:</label>
                                    <div class="col-lg-8">{!! $mcxData['sell'] !!}</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-4 control-label">P/L:</label>
                                    <div class="col-lg-8">{!! $mcxData['pl'] !!}</div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-4 control-label">Net P/L:</label>
                                    <div class="col-lg-8">
                                        <div class="col-lg-8">{!! $mcxData['npl'] !!}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="name" class="col-lg-4 control-label">Open:</label>
                                    <div class="col-lg-8">{!! $mcxData['open'] !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                    
        <div class="table-responsive">
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
});
</script>
@endsection