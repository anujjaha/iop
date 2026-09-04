<div class="row">

    {{-- =========================================================
         BASIC IPO INFORMATION
    ========================================================== --}}

    {{-- IPO Type --}}
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ipo_type', 'IPO Type :', ['class' => 'control-label']) }}
            {{ Form::select('ipo_type', [
                '1' => 'NSE',
                '2' => 'SME',
            ], null, [
                'class' => 'form-control',
                'placeholder' => 'IPO Type',
                'required' => 'required'
            ]) }}
        </div>
    </div>

    {{-- IPO Name --}}
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ipo_name', 'IPO Name :', ['class' => 'control-label']) }}
            {{ Form::text('ipo_name', null, [
                'class' => 'form-control',
                'placeholder' => 'IPO Name',
                'required' => 'required'
            ]) }}
        </div>
    </div>


    {{-- External Link --}}
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('external_link', 'External Link :', ['class' => 'control-label']) }}
            {{ Form::text('external_link', null, [
                'class' => 'form-control',
                'placeholder' => 'External Link'
            ]) }}
        </div>
    </div>

    {{-- Opening Date --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('opening_date', 'Opening Date :', ['class' => 'control-label']) }}

            {{ Form::text(
                'opening_date',
                isset($item) && $item->opening_date
                    ? date('d/m/Y',strtotime($item->opening_date))
                    : null,
                [
                    'class' => 'form-control date-picker',
                    'placeholder' => 'DD-MM-YYYY',
                    'required' => 'required',
                    'autocomplete' => 'off'
                ]
            ) }}
        </div>
    </div>

    {{-- Closing Date --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('closing_date', 'Closing Date :', ['class' => 'control-label']) }}

            {{ Form::text(
                'closing_date',
                isset($item) && $item->closing_date
                    ? date('d/m/Y',strtotime($item->closing_date))
                    : null,
                [
                    'class' => 'form-control date-picker',
                    'placeholder' => 'DD-MM-YYYY',
                    'required' => 'required',
                    'autocomplete' => 'off'
                ]
            ) }}
        </div>
    </div>

    {{-- Refund Date --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('refund_date', 'Refund Date :', ['class' => 'control-label']) }}

            {{ Form::text(
                'refund_date',
                isset($item) && $item->refund_date
                    ? date('d/m/Y',strtotime($item->refund_date))
                    : null,
                [
                    'class' => 'form-control date-picker',
                    'placeholder' => 'DD-MM-YYYY',
                    'required' => 'required',
                    'autocomplete' => 'off'
                ]
            ) }}
        </div>
    </div>

    {{-- Listing Date --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('listing_date', 'Listing Date :', ['class' => 'control-label']) }}

            {{ Form::text(
                'listing_date',
                isset($item) && $item->listing_date
                    ? date('d/m/Y',strtotime($item->listing_date))
                    : null,
                [
                    'class' => 'form-control date-picker',
                    'placeholder' => 'DD-MM-YYYY',
                    'required' => 'required',
                    'autocomplete' => 'off'
                ]
            ) }}
        </div>
    </div>
    {{-- =========================================================
         IPO PRICING & LOT INFORMATION
    ========================================================== --}}

     {{-- Price Band --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('price_band', 'Price Band :', ['class' => 'control-label']) }}
            {{ Form::number('price_band', null, [
                'class' => 'form-control',
                'placeholder' => 'Price Band',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>

    {{-- Lot Size --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('lot_size', 'Lot Size :', ['class' => 'control-label']) }}
            {{ Form::number('lot_size', null, [
                'class' => 'form-control',
                'placeholder' => 'Lot Size',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    {{-- Max Lot Size --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('max_lot_size', 'SHNI Lot Size :', ['class' => 'control-label']) }}
            {{ Form::number('max_lot_size', null, [
                'class' => 'form-control',
                'placeholder' => 'SHNI Lot Size',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    {{-- Max Lot Size --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('bhni_lot_size', 'BHNI Lot Size :', ['class' => 'control-label']) }}
            {{ Form::number('bhni_lot_size', null, [
                'class' => 'form-control',
                'placeholder' => 'BHNI Lot Size',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

   


    {{-- GMP Latest --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('gmp_latest', 'GMP Latest :', ['class' => 'control-label']) }}
            {{ Form::number('gmp_latest', null, [
                'class' => 'form-control',
                'placeholder' => 'GMP Latest',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>


    {{-- Listed Price --}}
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('listed_price', 'Listed Price :', ['class' => 'control-label']) }}
            {{ Form::number('listed_price', null, [
                'class' => 'form-control',
                'placeholder' => 'Listed Price',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>


    {{-- Retail Applications --}}
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('retail_applications', 'Retail Applications :', ['class' => 'control-label']) }}
            {{ Form::number('retail_applications', $item->retail_applications ?? 0, [
                'class' => 'form-control',
                'placeholder' => 'Retail Applications',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    {{-- SHNI Applications --}}
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('shni_applications', 'SHNI Applications :', ['class' => 'control-label']) }}
            {{ Form::number('shni_applications', $item->shni_applications ?? 0, [
                'class' => 'form-control',
                'placeholder' => 'SHNI Applications',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    {{-- BHNI Applications --}}
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('bhni_applications', 'BHNI Applications :', ['class' => 'control-label']) }}
            {{ Form::number('bhni_applications', $item->bhni_applications ?? 0, [
                'class' => 'form-control',
                'placeholder' => 'BHNI Applications',
                'required' => 'required',
                'min' => '0',
                'onblur' => 'calculateFund()'
            ]) }}
        </div>
    </div>

    {{-- =========================================================
         APPLICATION & FINANCIAL INFORMATION
    ========================================================== --}}

    {{-- Block Amount --}}


    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('loan_amount', 'Loan Amount :', ['class' => 'control-label']) }}
            {{ Form::number('loan_amount', null, [
                'class' => 'form-control',
                'placeholder' => 'Loan Amount',
                'required' => 'required',
                'step' => 'any',
                'onblur' => 'calculateFund()'
            ]) }}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('block_amt', 'Block Amount :', ['class' => 'control-label']) }}
            {{ Form::number('block_amt', null, [
                'class' => 'form-control',
                'placeholder' => 'Block Amount',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>


    {{-- Block Days --}}
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('block_days', 'Block Days :', ['class' => 'control-label']) }}
            {{ Form::number('block_days', null, [
                'class' => 'form-control',
                'placeholder' => 'Block Days',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    {{-- Paid Interest --}}
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('paid_interest', 'Earn Interest :', ['class' => 'control-label']) }}
            {{ Form::number('paid_interest', null, [
                'class' => 'form-control',
                'placeholder' => 'Interest',
                'required' => 'required',
                'min' => '0'
            ]) }}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('loan_interest', 'Loan Interest :', ['class' => 'control-label']) }}
            {{ Form::number('loan_interest', null, [
                'class' => 'form-control',
                'placeholder' => 'Loan Amount',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('risk_amount', 'Risk Amount :', ['class' => 'control-label']) }}
            {{ Form::number('risk_amount', null, [
                'class' => 'form-control',
                'placeholder' => 'Risk Amount',
                'required' => 'required',
                'step' => 'any'
            ]) }}
        </div>
    </div>

     {{-- Notes --}}
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('notes', 'Notes :', ['class' => 'control-label']) }}

            <div class="input-group">
                {{ Form::text('notes', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Notes',
                    'required' => 'required'
                ]) }}

                <span class="input-group-btn">
                    <a onclick="calculateFund()"
                       href="javascript:void(0)"
                       class="btn btn-primary">
                        <i class="fa fa-calculator"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>

    {{-- =========================================================
         ADDITIONAL INFORMATION
    ========================================================== --}}

    


</div>
