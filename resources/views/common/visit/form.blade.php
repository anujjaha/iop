<div class="form-group">
    {{ Form::label('content_id', 'Content Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('content_id', null, ['class' => 'form-control', 'placeholder' => 'Content Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('user_id', 'User Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('user_id', null, ['class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('actionType', 'ActionType :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('actionType', null, ['class' => 'form-control', 'placeholder' => 'ActionType', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('ip', 'Ip :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('ip', null, ['class' => 'form-control', 'placeholder' => 'Ip', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('user_agent', 'User Agent :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('user_agent', null, ['class' => 'form-control', 'placeholder' => 'User Agent', 'required' => 'required']) }}
    </div>
</div>