<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', getClientOptions(), null, ['class' => 'form-control', 'placeholder' => 'Client Id', 'required' => 'required']) }}
    </div>
</div>


<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('amount', 'Amount :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('credit_date', 'Credit Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('credit_date', null, ['class' => 'form-control date-picker', 'placeholder' => 'Credit Date', 'required' => 'required']) }}
    </div>
</div>
