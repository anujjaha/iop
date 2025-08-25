<div class="form-group">
    {{ Form::label('cost', 'Cost :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('current_plan', 'Current Plan :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('current_plan', null, ['class' => 'form-control', 'placeholder' => 'Current Plan', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('expire_date', 'Expire Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('expire_date', null, ['class' => 'form-control', 'placeholder' => 'Expire Date', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('recharge_date', 'Recharge Date :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('recharge_date', null, ['class' => 'form-control', 'placeholder' => 'Recharge Date', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('sim_id', 'Sim Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('sim_id', null, ['class' => 'form-control', 'placeholder' => 'Sim Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>