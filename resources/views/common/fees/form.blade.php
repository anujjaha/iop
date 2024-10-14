<div class="form-group row">
    {{ Form::label('month_title', 'Month Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('month_title', $months, null, ['class' => 'form-control', 'placeholder' => 'Select Month', 'required' => 'required', 'onchange' => 'getClients()']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required', 'onchange' => 'validateClient()']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('fee_amount', 'Fee Amount :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('fee_amount', null, ['class' => 'form-control', 'placeholder' => 'Fee Amount', 'required' => 'required']) }}
    </div>
</div>



<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes']) }}
    </div>
</div>