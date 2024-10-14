<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', $clientOptions, null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('loss_amount', 'Loss Amount :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::number('loss_amount', null, ['class' => 'form-control', 'placeholder' => 'Loss Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>