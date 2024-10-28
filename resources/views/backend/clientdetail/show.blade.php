@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')

@section('page-header')
<h1>CLIENT INFO</h1>
@endsection

@section('content')
{{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">View Client</h3>
        <div class="card-tools pull-right">
        
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">P & L</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Basic Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group row row">
                    <label for="name" class="col-lg-3 control-label">Name :</label>
                    <div class="col-lg-9">
                         {!! $item->name !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="mobile" class="col-lg-3 control-label">Mobile :</label>
                    <div class="col-lg-9">
                        {!! $item->mobile !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="email" class="col-lg-3 control-label">Email :</label>
                    <div class="col-lg-9">
                       {!! $item->email !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="aadhar_no" class="col-lg-3 control-label">Aadhar No. :</label>
                    <div class="col-lg-9">
                        {!! $item->aadhar_no !!}
                    </div>
                </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group row row">
                    <label for="pan" class="col-lg-3 control-label">PAN:</label>
                        <div class="col-lg-9">
                            {!! $item->pan_no !!}
                        </div>
                    </div>
                <div class="form-group row row">
                    <label for="dmat_co_name" class="col-lg-3 control-label">DMAT Co. Name:</label>
                    <div class="col-lg-9">
                       {!! $item->mobile !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="dmat_account" class="col-lg-3 control-label">Dmat Account:</label>
                    <div class="col-lg-9">
                        {!! $item->dmat_account !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="bank_name" class="col-lg-3 control-label">Bank Name:</label>
                    <div class="col-lg-9">
                        {!! $item->bank_name !!}
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="otTotalPay" class="col-lg-3 control-label">Bank Account:</label>
                    <div class="col-lg-9">
                        {!! $item->bank_account !!}
                    </div>
                </div>
                
            </div>
        </div>
                
    </div>
</div>

        <div class="col-md-12">
            
        </div>  
</div>



<div class="col-md-12">
<div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                IPO
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="other_cash_pay" class="col-lg-4 control-label">Other Cash Pay :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="Other Cash Pay" required="required" name="other_cash_pay" type="text" value="0" id="other_cash_pay">
                </div>
            </div>

            <div class="form-group row">
                <label for="travel" class="col-lg-4 control-label">Travel :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="Travel" required="required" name="travel" type="text" value="0" id="travel">
                </div>
            </div>

             <div class="form-group row">
                <label for="netTotal" class="col-lg-4 control-label">Total Wages :</label>
                <div class="col-lg-5">
                    <input class="form-control" placeholder="NetTotal" required="required" name="netTotal" type="text" value="36204" id="netTotal">
                </div>

                <div class="col-lg-3">
                    <a href="javascript:void(0);" onclick="calculateTotalWage()" class="btn btn-sm btn-primary">Calculate</a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-md-12">



    <div class="card card-primary">
        <div class="card-header">
            <div class="card-title">
                All Transactions
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row row">
                    <label for="PfAmount" class="col-lg-4 control-label">PF Total:</label>
                    <div class="col-lg-8">
                        <input class="form-control" placeholder="PF" required="required" id="pfAmount" name="pfAmount" type="text" value="1800">
                    </div>
                </div>
                <div class="form-group row row">
                    <label for="esic_amount" class="col-lg-4 control-label">ESIC Amt:</label>
                    <div class="col-lg-8">
                        
                        <input class="form-control" placeholder="ESIC" required="required" name="esic_amount" type="text" value="272" id="esic_amount">
                    </div>
                </div>   
           
            <div class="form-group row">
                <label for="mess" class="col-lg-4 control-label">Mess :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="Mess" required="required" name="mess" type="text" value="0" id="mess">
                </div>
            </div>

            <div class="form-group row">
                <label for="advance" class="col-lg-4 control-label">Advance :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="Advance" required="required" name="advance" type="text" value="0" id="advance">
                </div>
            </div>

            <div class="form-group row">
                <label for="cash_adv" class="col-lg-4 control-label">Cash Adv :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="Cash Adv" required="required" name="cash_adv" type="text" value="0" id="cash_adv">
                </div>
            </div>

            <div class="form-group row">
                <label for="totalDed" class="col-lg-4 control-label">TotalDed :</label>
                <div class="col-lg-8">
                    <input class="form-control" placeholder="TotalDed" required="required" name="totalDed" type="text" value="2072" id="totalDed">
                </div>
            </div>
            <div class="form-group row">
                <label for="netAmt" class="col-lg-4 control-label">NetAmt :</label>
                <div class="col-lg-5">
                    <input class="form-control" placeholder="NetAmt" required="required" name="netAmt" type="text" value="34132" id="netAmt">
                </div>
                <div class="col-lg-3">
                    <a href="javascript:void(0);" onclick="calculateTotalDeduction()" class="btn btn-sm btn-primary">Calculate</a>
                </div>
        </div>
            </div>
        </div>
</div>


</div>
    </div>

    <div class="card-footer">
        <div class="card-tools text-right">
        
        </div>
        <div class="clearfix"></div>
    </div>
</div>
{{ Form::close() }}
@endsection