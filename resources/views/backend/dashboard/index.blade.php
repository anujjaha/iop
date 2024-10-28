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

             


              <!-- /.col -->
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            IPO List
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    {!! date('d M') !!}
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    {!! date('d M', strtotime('+1 day')) !!}
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    {!! date('d M', strtotime('+2 day')) !!}
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
@endsection