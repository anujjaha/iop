<div class="form-group row">
    {{ Form::label('ipo_name', 'Ipo Name :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('ipo_name', null, ['class' => 'form-control', 'placeholder' => 'Ipo Name', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('ipo_type', 'Ipo Type :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('ipo_type', [
        '1' => 'NSE',
        '2' => 'SME',
        ], null, ['class' => 'form-control', 'placeholder' => 'Ipo Type', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('opening_date', 'Opening Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('opening_date', null, ['class' => 'form-control date-picker', 'placeholder' => 'Opening Date', 'required' => 'required', 'autocomplete' =>'off']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('closing_date', 'Closing Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('closing_date', null, ['class' => 'form-control date-picker', 'placeholder' => 'Closing Date', 'required' => 'required', 'autocomplete' =>'off']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('listing_date', 'Listing Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('listing_date', null, ['class' => 'form-control date-picker', 'placeholder' => 'Listing Date', 'required' => 'required', 'autocomplete' =>'off']) }}
    </div>
</div>
     
<div class="form-group row">
    {{ Form::label('gmp_latest', 'Gmp Latest :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('gmp_latest', null, ['class' => 'form-control', 'placeholder' => 'Gmp Latest', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('lot_size', 'Lot Size :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('lot_size', null, ['class' => 'form-control', 'placeholder' => 'Lot Size', 'required' => 'required']) }}
    </div>
</div> 
<div class="form-group row">
    {{ Form::label('block_amt', 'Block Amt :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('block_amt', null, ['class' => 'form-control', 'placeholder' => 'Block Amt', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('listed_price', 'Listed Price :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('listed_price', null, ['class' => 'form-control', 'placeholder' => 'Listed Price', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('refund_date', 'Refund Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('refund_date', null, ['class' => 'form-control date-picker', 'placeholder' => 'Refund Date', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('external_link', 'External Link :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('external_link', null, ['class' => 'form-control', 'placeholder' => 'External Link']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>
