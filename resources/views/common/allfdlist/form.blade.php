<div class="form-group row">
    {{ Form::label('client_id', 'Select Client :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-8">
        {{ Form::select('client_id', getClientOptions(), null, ['class' => 'form-control', 'placeholder' => 'Client Id', 'required' => 'required']) }}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
        <div class="card-header">
            Primary Details
        </div>
        
        <div class="card-body">

            <div class="form-group row">
            {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
            <div class="col-lg-10">
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
            </div>
            </div>
            <div class="form-group row">
                {{ Form::label('bank_name', 'Bank Name :', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::select('bank_name', [
                    'AU-Bank' => 'AU Bank',
                    'Kotak' => 'Kotak',
                    'Hdfc' => 'HDFC',
                    ],null, ['class' => 'form-control', 'placeholder' => 'Bank Name', 'required' => 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required', 'rows'=>2]) }}
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-md-6">
        <div class="card card-primary">
        <div class="card-header">
            Other Details
        </div>

         <div class="card-body">
            <div class="form-group row">
                {{ Form::label('fd_ref_no', 'Fd Details :', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-5">
                    {{ Form::text('fd_ref_no', null, ['class' => 'form-control', 'placeholder' => 'Fd Ref No', 'required' => 'required']) }}
                </div>

                <div class="col-lg-5">
                    {{ Form::select('payout_type', [
                    'monthly' => 'Monthly',
                    'quarterly' => 'Quarterly',
                    'half-yearly' => 'Half Yearly',
                    'yearly' => 'Yearly',
                    ],null, ['class' => 'form-control', 'placeholder' => 'Payout Type', 'required' => 'required']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('amount', 'Amount :', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
                </div>

                <div class="col-lg-3">
                    {{ Form::text('rate_of_int', null, ['class' => 'form-control', 'placeholder' => 'Rate Of Int', 'required' => 'required']) }}
                </div>

                <div class="col-lg-3">
                    {{ Form::text('expected_monthly_int', null, ['class' => 'form-control', 'placeholder' => 'Expected Monthly Int', 'required' => 'required']) }}
                </div>

            </div>

            <div class="form-group row">
                {{ Form::label('start_date', 'FD Date :', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-5">
                    {{ Form::date('start_date', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required' => 'required']) }}
                </div>
                <div class="col-lg-5">
                    {{ Form::date('end_date', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required' => 'required']) }}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>



