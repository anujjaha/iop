<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', $clientList, null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('ipo_id', 'Ipo Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('ipo_id', $ipoList, null, ['class' => 'form-control', 'placeholder' => 'Select Ipo', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('total_amount', 'Total Amount :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('total_amount', null, ['class' => 'form-control', 'placeholder' => 'Total Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('profit_amount', 'Form Sell Price :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('profit_amount', null, ['class' => 'form-control', 'placeholder' => 'Sell Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>