<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-6">
        {{ Form::select('client_id', $clientOptions, null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('amount', 'Amount :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-6">
        {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-6">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>