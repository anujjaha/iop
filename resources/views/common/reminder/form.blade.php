<div class="form-group row">
    {{ Form::label('user_id', 'User Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('user_id', $clientOptions, null, ['class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('actual_time', 'Actual Time :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('actual_time', null, ['class' => 'form-control', 'placeholder' => 'Actual Time', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('frequency', 'Frequency :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('frequency', null, ['class' => 'form-control', 'placeholder' => 'Frequency', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('new_time', 'New Time :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('new_time', null, ['class' => 'form-control', 'placeholder' => 'New Time', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('reminder_tone', 'Reminder Tone :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('reminder_tone', null, ['class' => 'form-control', 'placeholder' => 'Reminder Tone', 'required' => 'required']) }}
    </div>
</div>
