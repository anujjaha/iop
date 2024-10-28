<div class="form-group row">
    {{ Form::label('ipo_id', 'Select IPO :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-8">
        {{ Form::select('ipo_id', $ipoOptions, null, ['class' => 'form-control', 'placeholder' => 'Ipo Id', 'required' => 'required', 'onchange' => 'getClients()']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('client_id', 'Client Id :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-8">
        {{ Form::select('client_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select Client', 'required' => 'required', 'onchange' => 'validateClient()']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('applied_date', 'Applied Date :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-8">
        {{ Form::text('applied_date', $item->applied_date ?? date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Applied Date', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-3 control-label']) }}
    <div class="col-lg-8">
        {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::hidden('status', $item->status ?? 1, ['class' => 'form-control', 'placeholder' => 'Status', 'required' => 'required']) }}
</div>