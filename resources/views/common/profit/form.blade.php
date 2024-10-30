<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', $clientList, null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('profit_amount', 'Profit Amount :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('profit_amount', null, ['class' => 'form-control', 'placeholder' => 'Profit Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('executed_on', 'Executed On :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('executed_on', null, ['class' => 'form-control', 'placeholder' => 'Executed On', 'required' => 'required']) }}
    </div>
</div>