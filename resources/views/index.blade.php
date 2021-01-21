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


<!--End Portfolio-->
    <!--End Categories-->
    @if ($posts->count()) 

    <!--Blog-->
    <section class="pb-4 pt-4 bg--primary mb-1">
        <div class="container">
            <div class="page-head">
                <span class="page-sub-title"></span>
                <h2 class="page-title  heading-hr-margin-white">BLOG</h2>
            </div>
        </div>
       <div class="container">
            <div class="blog-slider owl-carousel owl-theme text-center">
                 @foreach($posts as $post)
                    <!--Item-->
                    <div class="item raised animated fadeIn  bg--light mb-4">
                        <div class="blog-item">
                            <div class="blog-item-image">
                                <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="blog-img-link">
                                    <img  title="{{  $post->title }}" src="{{ $post->image }}" alt="{{  $post->title }}" />
                                </a>
                            </div>
                            <div class="blog-item-content">
                                <p class="info mb-2">
                                    <i class="fa fa-clock-o"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                                </p>
                                <div class="tag bold">
                                    @foreach($post->attributes as $tag)
                                    <a href="/blog/tag/{{ $tag->id }}"><i class="fa fa-tags"></i> {{ $tag->name }}</a>
                                    @endforeach
                                </div>
                                <h6 class="blog-title text-uppercase"> 
                                    <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="">
                                        {{ $post->title }}
                                    </a> 
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <!--End Blog-->
    @endif

@endsection
@section('page-scripts')
@stop


