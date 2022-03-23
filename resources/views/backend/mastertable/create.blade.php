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
        {{-- Event Form --}}
        @include('common.'.strtolower($repository->moduleTitle).'.form')
        <hr />
        <h5> Let's Add some Fields </h5>
        @include('common.tablefield.form')
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

@section('scripts')
<script>
    $(".addItem").on('click', function(e) {
        console.log(e.target);
        copyRow();
    });

    $(document).on('click', ".removeItem", function(e) {
        console.log(e.target);
        $(e.target).closest('tr').remove();
    });

    function copyRow() {
        var newRow = `<tr>
                    <td>
                        <input type="text" name="field_name[]" class="form-control" />
                    </td>
                    <td>
                        <select name="field_type[]" class="form-control">
                            <option value="int">Integer</option>
                            <option value="float">Float</option>
                            <option value="string">String</option>
                            <option value="date">Date</option>
                            <option value="datetime">Date Time</option>
                            <option value="timestamp">Time Stamp</option>
                            <option value="longText">Long Text</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="default_value[]" class="form-control" />
                    </td>
                    <td>
                        <select name="is_nullable[]" class="form-control">
                            <option selected="selected" value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_primary_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_index_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_unique_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_soft_delete[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-danger removeItem">-</a>
                    </td>
                </tr>`;
        $("#tableBody").append(newRow);
    }
</script>
@endsection