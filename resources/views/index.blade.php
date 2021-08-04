@extends('layouts.app')

@section('content')
@include('_partials.top_banner')

<div class="container-fliud">
    <div  class="row align-items-start">
        @foreach( $banners as $banner )
            <div data-title="{{ $banner->title }}" class="{{ $banner->col }} {{ $banner->col == 'col-lg-3' ?  'col-6    p-0' : '' }}  {{ $banner->title }} p-0 text-center">
                <div class="banner-box">
                    <a class="portfolio-thumb" href="{{ $banner->link }}">
                        <img src="{{ $banner->image }}" alt="" />
                    </a>
                </div>
            </div> 
        @endforeach
    </div>
</div>

<div class="container-fluid ">
<div class="feature-boxes-container row mt-6 mb-1">
    <div class="col-md-4 col-4">
        <div class="feature-box px-sm-5 px-md-4 mx-sm-5 mx-md-3 feature-box-simple text-center">
            <i class="icon-earphones-alt"></i>
            <div class="feature-box-content">
                <h3 class="mb-0 pb-1">Customer Support</h3>
                <h5 class="m-b-3">Need Assistance?</h5>

                <p></p>
            </div><!-- End .feature-box-content -->
        </div><!-- End .feature-box -->
    </div><!-- End .col-md-4 -->

    <div class="col-md-4 col-4">
        <div class="feature-box px-sm-5 px-md-4 mx-sm-5 mx-md-3 feature-box-simple text-center">
            <i class="icon-credit-card"></i>
            <div class="feature-box-content">
                <h3 class="mb-0 pb-1">Secured Payment</h3>
                <h5 class="m-b-3">Safe &amp; Fast</h5>
                <p></p>
            </div><!-- End .feature-box-content -->
        </div><!-- End .feature-box -->
    </div><!-- End .col-md-4 -->

    <div class="col-md-4 col-4">
        <div class="feature-box px-sm-5 px-md-4 mx-sm-5 mx-md-3 feature-box-simple text-center">
            <i class="icon-action-undo"></i>

            <div class="feature-box-content">
                <h3 class="mb-0 pb-1">Returns</h3>
                <h5 class="m-b-3">Hassle Free</h5>

                <p></p>
            </div><!-- End .feature-box-content -->
        </div><!-- End .feature-box -->
    </div><!-- End .col-md-4 -->
</div>

</div>



<div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url(/images/newsletter/newsletter_popup_bg.jpg)">
    <div class="newsletter-popup-content">
        <img src="{{ $system_settings->logo_path() }}"  class="logo-newsletter" alt="{{ Config('app.name') }} Logo">
        <h2>BE THE FIRST TO KNOW</h2>
        <p class="mb-2">Subscribe to the hautesignatures newsletter to receive timely updates.</p>
        
        <sign-up />

        <div class="newsletter-subscribe">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1">
                    Don't show this popup again
                </label>
            </div>
        </div>
    </div><!-- End .newsletter-popup-content -->
</div><!-- End .newsletter-popup -->



@endsection
@section('page-scripts')
@stop


