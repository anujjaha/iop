<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>


<div class="form-group row">
    {{ Form::label('amount', 'Amount :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
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
</div>


@php
    $months = [];

    // Generate previous 24 months
    for ($i = 1; $i <= 24; $i++) {
        $date = \Carbon\Carbon::now()->subMonths($i);

        // Value => Display
        $months[strtoupper($date->format('M-Y'))] = $date->format('M-Y');
    }

    // Default = previous month
    $defaultMonth = \Carbon\Carbon::now()->subMonth()->format('M-Y');
@endphp

<div class="form-group row">
    {{ Form::label('month_year', 'Month :', ['class' => 'col-md-2 control-label']) }}

    <div class="col-md-10">
        {{ Form::select(
            'month_year',
            $months,
            $defaultMonth,
            [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ) }}
    </div>
</div>


<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-md-2 control-label']) }}
    <div class="col-md-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>
