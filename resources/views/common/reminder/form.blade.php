<div class="form-group row">
    {{ Form::label('user_id', 'User Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('user_id', $clientOptions, null, ['class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('frequency', 'Frequency :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('frequency', [
            'MONTHLY' => 'MONTHLY',
            'ONCE' => 'ONCE',
            'DAILY' => 'DAILY',
            'YEARLY' => 'YEARLY'
        ], 
        null, ['class' => 'form-control', 'placeholder' => 'Select Frequency', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('actual_time', 'Select Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('actual_time', null, ['class' => 'form-control date-picker', 'placeholder' => 'Actual Time', 'required' => 'required']) }}
    </div>
</div>


<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'rows' => 4]) }}
    </div>
</div>