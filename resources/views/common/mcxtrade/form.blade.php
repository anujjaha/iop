<div class="form-group row">
    {{ Form::label('client_id', 'Select Client :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::select('client_id', getClientOptions(), null, ['class' => 'form-control', 'placeholder' => 'Client Id' ]) }}
    </div>
    <div class="col-lg-2"></div>
    {{ Form::label('is_settle', 'Trade Completed :', ['class' => 'col-lg-3 control-label text-right']) }}
    <div class="col-lg-2">
        {{ Form::select('is_settle', [
        0 => 'No',
        1 => 'Yes'
        ],
        null, ['class' => 'form-control', 'placeholder' => 'Trade Settle' ]) }}
    </div>
</div>    

<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                Primary
            </div>
            <div class="card-body">
                

                <div class="form-group row">
                    {{ Form::label('mcx_code', 'Mcx Code :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::select('mcx_code', getMcxOptions(), null, ['class' => 'form-control', 'placeholder' => 'Mcx Code' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('qty', 'Qty :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::text('qty', null, ['class' => 'form-control', 'placeholder' => 'Qty' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('trade_type', 'Trade Type :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::select('trade_type', getTradeOptions(), null, ['class' => 'form-control', 'placeholder' => 'Trade Type' ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                Buy Details
            </div>
            <div class="card-body">
                <div class="form-group row">
                    {{ Form::label('buy_price', 'Buy Price :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::text('buy_price', null, ['class' => 'form-control', 'placeholder' => 'Buy Price' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('additional_bcost', 'Extra Cost :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::text('additional_bcost', null, ['class' => 'form-control', 'placeholder' => 'Additional Buy Cost' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('trade_date', 'Trade Date :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::date('trade_date', null, ['class' => 'form-control', 'placeholder' => 'Trade Date' ]) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                Sell Details
            </div>
            <div class="card-body">

                <div class="form-group row">
                    {{ Form::label('sell_price', 'Sell Price :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::text('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Sell Price' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('additional_scost', 'Extra Cost :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::text('additional_scost', null, ['class' => 'form-control', 'placeholder' => 'Additional Sell Ccost' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('settle_date', 'Sell Date :', ['class' => 'col-lg-3 control-label']) }}
                    <div class="col-lg-9">
                        {{ Form::date('settle_date', null, ['class' => 'form-control', 'placeholder' => 'Settle Date' ]) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>