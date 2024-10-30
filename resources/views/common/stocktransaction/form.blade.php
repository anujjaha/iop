<div class="form-group">
    {{ Form::label('stock_id', 'Stock Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('stock_id', null, ['class' => 'form-control', 'placeholder' => 'Stock Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('client_id', null, ['class' => 'form-control', 'placeholder' => 'Client Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('buy_price', 'Buy Price :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('buy_price', null, ['class' => 'form-control', 'placeholder' => 'Buy Price', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('sell_price', 'Sell Price :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Sell Price', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('qty', 'Qty :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('qty', null, ['class' => 'form-control', 'placeholder' => 'Qty', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('profit_loss', 'Profit Loss :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('profit_loss', null, ['class' => 'form-control', 'placeholder' => 'Profit Loss', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>