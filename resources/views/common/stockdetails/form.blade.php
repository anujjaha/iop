<div class="form-group row">
    {{ Form::label('code', 'Code :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('external_link', 'External Link :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('external_link', null, ['class' => 'form-control', 'placeholder' => 'External Link', 'required' => 'required']) }}
    </div>
</div><div class="form-group row">
    {{ Form::label('cmp', 'Current Price :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('cmp', null, ['class' => 'form-control', 'placeholder' => 'Cmp', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes']) }}
    </div>
</div>
