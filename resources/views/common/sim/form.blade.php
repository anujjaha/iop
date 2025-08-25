<div class="form-group row">
    {{ Form::label('device_id', 'Device Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('device_id', getDeviceOptions(), null, ['class' => 'form-control', 'placeholder' => 'Select Device', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('company', 'Company :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('company', null, ['class' => 'form-control', 'placeholder' => 'Company', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('mobile_number', 'Mobile Number :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('mobile_number', null, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'required' => 'required']) }}
    </div>
</div>


<div class="form-group row">
    {{ Form::label('cost', 'Cost :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('purchase_date', 'Purchase Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::date('purchase_date', null, ['class' => 'form-control', 'placeholder' => 'Purchase Date', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('status', 'Status :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('status', [
        1 => 'Yes',
        0 => 'NO'
        ],null,  ['class' => 'form-control', 'placeholder' => 'Status', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>