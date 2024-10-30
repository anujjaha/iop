<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('client_id', $clientList, null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('code', 'Code :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('cost', 'Cost :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('qty', 'Qty :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('qty', null, ['class' => 'form-control', 'placeholder' => 'Qty', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('cmp', 'Cmp :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('cmp', null, ['class' => 'form-control', 'placeholder' => 'Cmp', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('external_link', 'External Link :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('external_link', null, ['class' => 'form-control', 'placeholder' => 'External Link', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>