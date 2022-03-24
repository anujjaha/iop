    <div class="form-group">
        {{ Form::label('module_name', 'Module Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('module_name', null, ['class' => 'form-control', 'placeholder' => 'Module Name', 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('title', 'Table Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Table Name', 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('extra_notes', null, ['class' => 'form-control', 'placeholder' => 'Notes']) }}
        </div>
    </div>