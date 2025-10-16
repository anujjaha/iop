<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('amount', 'Amount :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('pay_mode', 'Pay Mode :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::select('pay_mode', 
            [
                1 => 'NEFT',
                2 => 'GPAY',
                3 => 'Cash',
            ]
        ,null, ['class' => 'form-control', 'placeholder' => 'Pay Mode', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>