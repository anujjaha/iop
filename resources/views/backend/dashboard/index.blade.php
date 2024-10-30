@extends('backend.layouts.app')

@section ('title', 'Dashboard')

@section('content')


<div class="container-fluid">
    @php
        $mainBal    = mainBalance();
        $blockBal   = blockBalance();
        $masterBal  = $mainBal + $blockBal;
    @endphp
    <h3>Dashboard</h3>

    <div class="card">
        <div class="card-body">
            <div class="row">
              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-envelope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Main Balance</span>
                    <span class="info-box-number">{!! $masterBal !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-flag"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Available Fund</span>
                    <span class="info-box-number">{!! $mainBal !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-envelope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Block Fund</span>
                    <span class="info-box-number">{!! $blockBal !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

               <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-envelope"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">P/L</span>
                    <span class="info-box-number">{!! profitOrLoss() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <!-- /.col -->
              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-copy"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Applied IPO</span>
                    <span class="info-box-number">{!! count($assignedIpos) !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">CLIENTS</span>
                    <span class="info-box-number">{!! count($clients) !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

               <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Fees</span>
                    <span class="info-box-number">{!! totalPaidFees() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Loss</span>
                    <span class="info-box-number">{!! totalLoss() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Holding</span>
                    <span class="info-box-number">{!! totalHoldings() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Stock Profit</span>
                    <span class="info-box-number">{!! totalStockProfit() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

                <div class="col-md-2 col-sm-4 col-12">
                <div class="info-box">
                  <span class=""><i class="far fa-star"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Other Profit</span>
                    <span class="info-box-number">{!! formProfit() !!}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
             


              <!-- /.col -->
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            IPO List <span class="text-right float-right"><a href="{!! route('admin.ipoassignments.create') !!}" class="btn btn-sm btn-success">Assign</a>
            </span>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    {!! date('d M') !!} {!! count($todayIpos) ? '('.count($todayIpos).')' : '' !!}
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    {!! date('d M', strtotime('+1 day')) !!} {!! count($tomorrowIpos) ? '('.count($tomorrowIpos).')' : '' !!}
                </a> 
              </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        {!! date('d M', strtotime('+2 day')) !!} {!! count($dayAfterIpos) ? '('.count($dayAfterIpos).')' : '' !!}
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        {!! date('d M', strtotime('+3 day')) !!} {!! count($thirdDay) ? '('.count($thirdDay).')' : '' !!}
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        {!! date('d M', strtotime('+4 day')) !!} {!! count($fourDay) ? '('.count($fourDay).')' : '' !!}
                    </a>
                </li>
            </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        {!! getTableHtml($todayIpos, $clients) !!}
                    </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        {!! getTableHtml($tomorrowIpos, $clients) !!}
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    {!! getTableHtml($dayAfterIpos, $clients) !!}
                  </div>

                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    {!! getTableHtml($thirdDay, $clients) !!}
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    {!! getTableHtml($fourDay, $clients) !!}
                  </div>
                </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Allocations <span class="text-right float-right">
            </span>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($filterList as $key => $filter)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        {!! $key !!}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
             @foreach($filterList as $key => $filter)
                   
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table id="items-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Client</td>
                                        <td>IPO</td>
                                        <td>Buy At</td>
                                        <td>QTY</td>
                                        <td>Invested</td>
                                        <td>Action</td>
                                    </tr>

                                     @foreach($filter as $record)
                                        <tr>
                                            <td>{!! $record->client->name !!}</td>
                                            <td>{!! $record->ipo->ipo_name !!}</td>
                                            <td>{!! $record->ipo->block_amt / $record->ipo->lot_size !!}</td>
                                            <td>{!! $record->ipo->lot_size !!}</td>
                                            <td>{!! $record->ipo->block_amt !!}</td>
                                            <td>
                                                <a  onclick="settleAllotment({!! $record->id !!}, `{!! $record->ipo->ipo_name  !!} | {!! $record->client->name!!} `)" href="javascript:void(0);" class="btn btn-xs btn-primary">Settle</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Welcome To Laravel 9 Quick Panel</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            Hi My Self Anuj Jaha, Fullstack developer with 8+ years of Experience.
        </div>
        <div class="card-footer">
            Email: <a href="mailto:er.anujjaha@gmail.com">er.anujjaha@gmail.com</a>
            <span class="float-right">Mob: +91 8000060541</span>
        </div>
    </div>
</div>


<div class="modal fade " id="settleIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="settleIpoTitle">
                Settle IPO: <span id="clientTitleContainer"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Rate: </label>
                <div class="col-md-10">
                    <input type="number" step="0.1" style="width: 150px;" id="rate" name="rate" class="form-control" value="0" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="notes" name="notes" class="form-control" value="Adding Balance" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="assignmentId" id="assignmentId" value="">
            <button type="button" onclick="updateAssignment()"  class="btn btn-success">Settle</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade " id="assignIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                IPO: <span id="ipoDetailsContainer"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-2 control-label">Select: </label>
                <div class="col-md-10">
                    <select class="form-control" name="client_id" id="client_id">
                        <option value="">Select Client</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 control-label">Notes: </label>
                <div class="col-md-10">
                    <input type="text" id="ipo_notes" name="ipo_notes" class="form-control" value="Apply IPO" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="ipo_id" id="ipo_id" value="">
            <input type="hidden" name="min_block_amount" id="min_block_amount" value="">
            <button type="button" onclick="applyIpo()"  class="btn btn-success">Apply</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@endsection


@section('after-scripts')
<script type="text/javascript">
    function settleAllotment(id, title)
    {
        jQuery("#settleIpoModal").modal('show');
        jQuery("#clientTitleContainer").html(title);
        jQuery("#assignmentId").val(id);
    }

   

    function showEligibleClientList(ipoId)
    {
        jQuery("#client_id").empty();

        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.ipoassignments.get-clients')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
                ipoId,
                all: 1
            },
            success : function(data) {
                if(data.status == true)
                {
                    var ipo = data.ipoDetails;
                    jQuery("#assignIpoModal").modal('show');
                    jQuery("#ipoDetailsContainer").html(ipo.ipo_name + ' ('+ ipo.block_amt +')');
                    jQuery("#ipo_id").val(ipo.id);
                    jQuery("#min_block_amount").val(ipo.block_amt);
                    var clientList = data.clientList;
                    jQuery('#client_id')
                        .append($("<option></option>")
                        .attr("value", '')
                        .text('Please select')); 

                    for(var i = 0; i < clientList.length; i++)
                    {
                        jQuery('#client_id')
                        .append($("<option></option>")
                        .attr("value", clientList[i].id)
                        .attr("current-bal", clientList[i].balance)
                        .text(clientList[i].name + ' ('+ clientList[i].balance +')')); 
                    }
                }
                console.log(data);
            },
            complete: function() {
                
            }
        });
    }

    function showAppliedClientList(ipoId)
    {
        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.ipoassignments.assigned-client-list')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
               ipoId,
            },
            success : function(data) 
            {
                console.log(data);
                // jQuery("#settleIpoModal").modal('hide');
                // if(data.status == true)
                // {
                //     swal('Yeah.', 'IPO Settled successfully.', 'success');   
                //     setTimeout(function() {
                //         //window.location.reload();
                //     }, 2000);

                //     return;
                // }
                // swal('Oh', 'Something went Wrong','error');
            },
            complete: function() {
                jQuery("#settleIpoModal").modal('hide');
            }
        });
    }

    function updateAssignment()
    {
        var assignmentId = jQuery("#assignmentId").val();
        var amount = jQuery("#rate").val();

        if(parseFloat(amount) < 0)
        {
            swal('Oh', 'Please enter valid amount','error');
            return;
        }

        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.ipoassignments.settle-ipo')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
               assignmentId: assignmentId,
               notes: jQuery("#notes").val(),
               amount,
            },
            success : function(data) 
            {
                jQuery("#settleIpoModal").modal('hide');
                if(data.status == true)
                {
                    swal('Yeah.', 'IPO Settled successfully.', 'success');   
                    setTimeout(function() {
                        //window.location.reload();
                    }, 2000);

                    return;
                }
                swal('Oh', 'Something went Wrong','error');
            },
            complete: function() {
                jQuery("#settleIpoModal").modal('hide');
            }
        });
    }


    function applyIpo()
    {
        if(!validateClient())
        {
            return;
        }

        var client_id    = jQuery("#client_id").val();
        var ipo_id       = jQuery("#ipo_id").val();
        var applied_date = "{!! date('Y-m-d') !!}";

        if(client_id.trim() == '')
        {
            swal('Oh', 'Please select valid Client','error');
            return;
        }

        jQuery.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url(route('admin.ipoassignments.assign-client')) }}",
            dataType : 'json',
            type : 'POST',
            data : {
               client_id,
               ipo_id,
               applied_date,
               status: 1,
               notes: jQuery("#ipo_notes").val(),
            },
            success : function(data) 
            {
                jQuery("#assignIpoModal").modal('hide');

                if(data.status == true)
                {
                    swal('Yeah.', 'Ipo Assigned successfully.', 'success');   
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                    return;
                }
                swal('Oh', 'Something went Wrong','error');
            },
            complete: function() {
                jQuery("#assignIpoModal").modal('hide');
            }
        });
    }

    function validateClient()
    {
        var clientBal = jQuery("#client_id").find(':selected').attr('current-bal');

        if(clientBal < jQuery("#min_block_amount").val())
        {
            alert('No Sufficient Fund for IPO!');
            jQuery("#client_id").val('');
            return false;
        }


        return true;
    }
</script>
@endsection