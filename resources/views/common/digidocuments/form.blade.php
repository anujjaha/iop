<div class="form-group row">
    {{ Form::label('user_id', 'User Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::select('user_id', $clientOptions,null, ['class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('category', 'Category :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Category', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('attachment', 'Attachment :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('attachment', null, ['class' => 'form-control', 'placeholder' => 'Attachment', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('is_aadhar_pan_link', 'Is Aadhar Pan Link :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('is_aadhar_pan_link', null, ['class' => 'form-control', 'placeholder' => 'Is Aadhar Pan Link', 'required' => 'required']) }}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>