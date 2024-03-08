@extends('frontend.layouts.app')
@section('content')

    
<style type="text/css">

.bgBlur {
    opacity: 0.2;
}
.zoomItem img:hover
{
    transition:all 0.6s; /* Change Speed */
    -ms-transform: scale(2, 2); /* IE 9 */
    -webkit-transform: scale(2, 2); /* Safari */
    transform: scale(2, 2); /* Change Size */
    overflow:visible;
    opacity: 1;
    z-index:2 !important; /* you can change it, but better let this in default */
    background-color: white;
}


        .f-11 {
            font-size: 11px;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="javascript:void(0);">
        <span class="d-none d-lg-block zoomItem">
            @if(isset($content->image))
                <img  class="img-fluid img-profile rounded-circle mx-auto mb-2" style="width: 50%" src="{{ asset('media/images/' . $content->id .'/'. $content->image) }}" />
            @endif
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="javascript:void(0);">
                    Company: <strong>{!! $content->company_name !!}</strong>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="javascript:void(0);">
                    Owner: {!! $content->owner_1 !!}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="javascript:void(0);">
                    <i class="fa fa-phone"></i> : {!! $content->contact_primary !!}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger f-11" href="javascript:void(0);">
                    <i class="fa fa-phone"></i> : {!! $content->email !!}
                </a>
            </li>
            @if(isset($content->website) && !empty($content->website))
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="javascript:void(0);">
                    <i class="fa fa-web"></i> : {!! $content->website !!}
                </a>
            </li>
            @endif

            <li>
                <div class="row">
                    @if(isset($content->qr_1))
                        <div class="col-md-4 zoomItem">
                                <img  class="img-fluid img-profile mx-auto mb-2" style="width: 50%" src="{{ asset('media/qr_1/' . $content->id .'/'. $content->qr_1) }}" />
                        </div>
                    @endif

                    @if(isset($content->qr_2))
                        <div class="col-md-4 zoomItem">
                                <img  class="img-fluid img-profile mx-auto mb-2" style="width: 50%" src="{{ asset('media/qr_2/' . $content->id .'/'. $content->qr_2) }}" />
                        </div>
                    @endif

                    @if(isset($content->qr_3))
                        <div class="col-md-4 zoomItem">
                                <img  class="img-fluid img-profile mx-auto mb-2" style="width: 50%" src="{{ asset('media/qr_3/' . $content->qr_3) }}" />
                        </div>
                    @endif
                </div>
            </li>

            <li>
                {!! $counter !!}
            </li>
        </ul>


      </div>
    </nav>

    <div class="container-fluid p-0">
        <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
            <div class="my-auto">
                <center>
                @if(isset($content->image))
                    <img style="width: 60%" src="{{ asset('media/images/' . $content->id .'/'. $content->image) }}" />
                @endif
                </center>
            </div>
      </section>


    </div>

@endsection