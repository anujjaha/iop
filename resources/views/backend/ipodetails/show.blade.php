@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')


@section('page-header')
<h1>IPO: 
    <a target="_blank" href="{!! $item->external_link !!}">
        {!! $item->ipo_name !!}</h1>
    </a>
@endsection

@include('backend.includes.datatable-asset')

@section('content')
<!-- Dropzone CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

{{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                                Basic Details
                            <div class="card-tools pull-right float-right">
                                <a href="javascript:void(0)" onclick="bulkUpload({!! $item->id !!})" class="btn btn-xs btn-success">Upload</a>
                                @if($clientList && count($clientList))
                                    <a href="javascript:void(0)" onclick="assignIpo({!! $item->id !!})" class="btn btn-xs btn-success">Assign</a>
                                @endif

                                <a href="{!! route('admin.ipodetails.download-csv', $item->id) !!}" class="btn btn-xs btn-secondary">Download</a>
                            </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Start:</label>
                                    <div class="col-lg-7">
                                        {!! date('d M Y',strtotime($item->opening_date)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">END:</label>
                                    <div class="col-lg-7">
                                        {!! date('d M Y',strtotime($item->closing_date)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Lot Size:</label>
                                    <div class="col-lg-7">
                                        {!! $item->min_lot_size !!} / {!! $item->max_lot_size !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Amount:</label>
                                    <div class="col-lg-7">
                                        {!! $item->min_lot_size * $item->price_band  !!} / {!! $item->max_lot_size * $item->price_band  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Applied:</label>
                                    <div class="col-lg-7">
                                        {!! count($item->assignments) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Blocked:</label>
                                    <div class="col-lg-7">
                                        {!! $item->assignments->whereIn('status', [1,2,3])->pluck('final_net_pl')->sum()  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Alloted:</label>
                                    <div class="col-lg-7">
                                        {!! $item->assignments->where('status', '!=', 2)->count()  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">P/L:</label>
                                    <div class="col-lg-7">
                                        {!! $item->assignments->sum('final_net_pl')  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Invested:</label>
                                    <div class="col-lg-7">
                                        {!! $item->invested_amount == 0 ? $item->block_amt : $item->invested_amount;  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Loan:</label>
                                    <div class="col-lg-7">
                                        {!! $item->loan_amount;  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Paid Interest:</label>
                                    <div class="col-lg-7">
                                        {!! $item->loan_interest . ' | ' . $item->paid_interest ;  !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row row">
                                    <label for="name" class="col-lg-5 control-label">Total Risk:</label>
                                    <div class="col-lg-7">
                                        {!! $item->risk_amount;  !!}
                                    </div>
                                </div>
                            </div>
                            

                        </div>  
                    </div>
                </div>
            </div>
        </div>


        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <td>SR</td>
                    <td>Name</td>
                    <td>PAN</td>
                    <td>Allotment</td>
                    <td>P/L</td>
                    <td>Blocked Amount</td>
                </tr>
            </thead>
            @php
                $sr = 1;
                $totalBlock = 0;
            @endphp
            <tbody>
            @foreach($item->assignments as $assignment)
                <tr>
                    <td>{!! $sr !!}</td>
                    <td>
                        <a target="_blank" href="{!! route('admin.clientdetail.show', $assignment->client->id) !!}"> 
                        {!! $assignment->client->name !!} ({!! $assignment->client->balance !!})
                        | {!! $assignment->client->mobile_device !!} | {!! $assignment->client->dmat_device !!}
                        </a>
                    </td>
                    <td>{!! $assignment->client->pan_no !!}</td>
                    <td>{!! getAssignmentLiveStatus($assignment->status) !!}</td>
                    <td>{!! $assignment->profit_loss !!}</td>
                    <td class="text-right">{!! $assignment->share_qty * $item->price_band !!}</td>
                </tr>
                @php
                    $sr++;
                    $totalBlock = $totalBlock + ($assignment->share_qty * $item->price_band);
                @endphp
            @endforeach
             
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">-</td>
                <td class="text-right text-strong"><strong>{!! $totalBlock !!}</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="card-footer">
        <div class="clearfix"></div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade " id="assignIpoModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                IPO: {!! $item->ipo_name !!} ( {!! $item->block_amt !!} )
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-lg-3 control-label">Select Lot: </label>
                <div class="col-md-9">
                    <select class="form-control" name="ipoLotSize" id="ipoLotSize">
                        <option value="">Select Size</option>
                            <option value="{!! $item->min_lot_size !!}">{!! $item->min_lot_size !!}
                            </option>
                            <option value="{!! $item->max_lot_size !!}">{!! $item->max_lot_size !!}
                            </option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 control-label">Select: </label>
                <div class="col-md-9">
                    <select class="form-control" name="client_id" id="client_id">
                        <option value="">Select Client</option>
                        @foreach($clientList as $client)
                            <option value="{!! $client->id !!}">
                                {!! $client->name !!} ({!! $client->balance !!})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 control-label">Notes: </label>
                <div class="col-md-9">
                    <input type="text" id="ipo_notes" name="ipo_notes" class="form-control" value="Apply IPO" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="clientId" id="clientId" value="">
            <button type="button" onclick="applyIpo()"  class="btn btn-success">Apply</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<!-- Upload Modal -->
<div class="modal fade " id="bulkUploadModal" tabindex="-1" role="dialog" aria-labelledby="addBalanceModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">
                IPO: {!! $item->ipo_name !!} ( {!! $item->block_amt !!} )
            </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div id="dropzoneArea" class="dropzone"></div>
        </div>
        <div class="modal-footer">
        <input type="hidden" name="ipoHiddenId" id="ipoHiddenId" value="">
        <button type="button" onclick="applyIpo()"  class="btn btn-success">Apply</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
{{ Form::close() }}
@endsection


@section('after-scripts')
<script type="text/javascript">
Dropzone.autoDiscover = false;

let csvUploader;

jQuery(document).ready(function() {
    jQuery(".data-table").dataTable();
})

function assignIpo(clientId)
{
    jQuery("#assignIpoModal").modal('show');
}

function bulkUpload(clientId)
{
    jQuery("#bulkUploadModal").modal('show');
    jQuery("#ipoHiddenId").val(clientId);

    // Initialize only once
    if (!csvUploader) {
        csvUploader = new Dropzone("#dropzoneArea", {
            url: "{{ route('admin.ipodetails.upload-csv') }}", // Your Laravel route
            method: 'post',
            maxFiles: 1,
            acceptedFiles: '.csv',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dictDefaultMessage: "Drag & drop CSV here or click to browse",
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    formData.append("ipoId", clientId);
                    
                });

                this.on("success", function (file, response) {
                    alert("CSV uploaded successfully!");
                    $('#bulkUploadModal').modal('hide');
                    this.removeAllFiles();
                    // location.reload(); // or handle refresh manually
                });
                this.on("error", function (file, errorMessage) {
                    alert("Error uploading file.");
                });
            }
        });
    }
}

// Clear Dropzone when modal closes
$('#bulkUploadModal').on('hidden.bs.modal', function () {
    if (csvUploader) {
        csvUploader.removeAllFiles(true);
    }
});

function applyIpo()
{
    var client_id    = jQuery("#client_id").val();
    var ipo_id       = {!! $item->id !!};
    var applied_date = "{!! date('Y-m-d') !!}";
    var lotSize      = jQuery("#ipoLotSize").val();

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
           lotSize
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


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
  <script>
    Dropzone.autoDiscover = false; // Prevent Dropzone from auto-initializing

    var myDropzone;
     // Dropzone config
    Dropzone.options.csvDropzone = {
      paramName: "file", // The name that will be used to transfer the file
      maxFiles: 1,
      acceptedFiles: ".csv",
      dictDefaultMessage: "Drop your CSV here or click to upload",


      init: function () {
         

        this.on("success", function (file, response) {
          alert("File uploaded successfully.");
          closeModal();
        });

        this.on("error", function (file, errorMessage) {
          alert("Error uploading file: " + errorMessage);
        });
      }
    };

</script>
@endsection