<div class="form-group">
    {{ Form::label('name', 'Name :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('bank', 'Bank :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('bank', null, ['class' => 'form-control', 'placeholder' => 'Bank', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('branch', 'Branch :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('branch', null, ['class' => 'form-control', 'placeholder' => 'Branch', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('account_number', 'Account Number :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('account_number', null, ['class' => 'form-control', 'placeholder' => 'Account Number', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('ifsc', 'Ifsc :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('ifsc', null, ['class' => 'form-control', 'placeholder' => 'Ifsc', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('balance', 'Balance :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('balance', null, ['class' => 'form-control', 'placeholder' => 'Balance', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>