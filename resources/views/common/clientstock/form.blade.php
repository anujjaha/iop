<div class="form-group">
    {{ Form::label('buy_cost', 'Buy Cost :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('buy_cost', null, ['class' => 'form-control', 'placeholder' => 'Buy Cost', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('buy_date', 'Buy Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('buy_date', null, ['class' => 'form-control', 'placeholder' => 'Buy Date', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('buy_qty', 'Buy Qty :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('buy_qty', null, ['class' => 'form-control', 'placeholder' => 'Buy Qty', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('client_id', null, ['class' => 'form-control', 'placeholder' => 'Client Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('stock_id', 'Stock Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('stock_id', null, ['class' => 'form-control', 'placeholder' => 'Stock Id', 'required' => 'required']) }}
    </div>
</div>