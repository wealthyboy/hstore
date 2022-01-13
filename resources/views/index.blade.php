@extends('layouts.app')

@section('content')
@include('_partials.top_banner')

<div class="container-fliud">
    <div  class="row align-items-start">
        @foreach( $banners as $banner )
            <div data-title="{{ $banner->title }}" class="{{ $banner->col }} {{ $banner->col == 'col-lg-3' ?  'col-6    p-0' : '' }}  {{ $banner->title }} p-0 text-center          {{ $banner->device }}">
                <div class="banner-box">
                    <a class="portfolio-thumb" href="{{ $banner->link }}">
                        <img src="{{ $banner->image }}" title="{{ $banner->title }}" alt="{{ $banner->img_alt }}" />
                    </a>
                </div>
            </div> 
        @endforeach
    </div>
</div>


@if ($posts->count() && optional($blog_status)->is_active) 

<div class="blog-section pt-0 mt-3">
    <h1 title="fashion blog" class="text-center mb-3">Blog</h1>

    <div class="products-slider ml-3 owl-carousel owl-theme dots-top">
       @foreach($posts as $post)
        <div class="blog-default inner-quickview inner-icon">
            <figure>
                <a href="{{ route('blog.show',['blog'=> $post->slug]) }}">
                    <img  title="{{ $post->title }}" src="{{ $post->image_m }}" alt="{{  $post->title }}">
                </a>
            </figure>
            <div class="blog-details text-left">
                <h4 class="blog-title mb-1">
                    <a title="{{ $post->title }} " href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="">
                        {{ $post->title }}
                    </a>
                </h4>
                <div class="blog-teaser-box">
                    <?php echo  str_limit(html_entity_decode($post->teaser), $limit = 100, $end = '...') ?>   
                </div><!-- End .price-box -->
            </div><!-- End .product-details -->
        </div>
        @endforeach
        
    </div><!-- End .products-slider -->
</div><!-- End .products-section -->

@endif


@if ( $products->count() )
    <div class="container-fluid mt-1 ">
        <div class="products-section pt-0">
            <div class=" text-center fa-2x">Best of sale: shop our editor's picks</div>
            <div class="products-slider owl-carousel owl-theme ">
                @foreach( $products as $featered_product)
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ $featered_product->link }}">
                            <img src="{{ $featered_product->image_to_show_m }}">
                        </a>
                    </figure>
                    <div class="product-details text-left">
                        <div class="">
                            
                            @if($featered_product->colours->count()  && $featered_product->colours->count() > 1)
                                <div  class="justify-content-start d-flex mb-1">
                                    @foreach($featered_product->colours as $color)
                                    <div   style="border:1px solid #222; height: 15px; width: 15px; border-radius: 50%; background-color: {{ $color->color_code }};" class="mr-1"></div>
                                    @endforeach
                                </div>
                            @endif
                            @if($featered_product->brand_name)
                                <div  class="product-brand text-capitalize  bold">
                                    {{ strtolower($featered_product->brand_name) }} 

                                </div>
                            @endif

                            <div class="color--primary">
                                <a href="{{ $featered_product->link }}">{{ $featered_product->product_name }}</a>
                            </div>
                        </div>
                        <div class="price-box mt-1">
                            @if( $featered_product->default_discounted_price)
                                <span class="old-price">{{ $featered_product->currency }}{{ number_format($featered_product->converted_price)   }}</span>
                                <span class="product-price  ml-1">
                                    |
                                    @if( $featered_product->default_percentage_off )
                                        {{ $featered_product->default_percentage_off }}% OFF
                                    @endif
                                    <span class="text-danger">
                                    {{ $featered_product->currency }}{{ number_format($featered_product->default_discounted_price)  }}
                                    </span>
                                </span>
                            @else
                                <span class="product-price">{{ $featered_product->currency }}{{ number_format($featered_product->converted_price) }}</span>
                            @endif
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>


                @endforeach
            
            </div><!-- End .products-slider -->
        </div><!-- End .products-section -->

    </div><!-- End .container -->
    @endif


<section class="section-6    appear-animate">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="section-title">Latest Product Reviews</h2>
                <div class="owl-carousel owl-theme testimonials-carousel" data-owl-options="{
                        'autoplay': false,
                        'autoHeight': true
                    }">
                    @foreach($reviews as $review)

                    <div class="testimonial bg-white pt-3">
                        <div class="testimonial-owner pl-3">
                            <figure>
                                <img title="{{ $review->title }}" src="{{ optional($review->product_variation)->image_to_show_m }}"  width="96" height="96" alt="{{ $review->title }} ">

                            </figure>

                            <div class="testi-content">
                                <div class="ratings-container mb-1">
                                    <div class="product-ratings">
                                        <div class="ratings" style="width: {{ $review->rating }}%"></div>
                                    </div>
                                </div>

                                <h4 class="testimonial-title p-0">{{ optional($review->product)->product_name }}</h4>

                                <blockquote class="ml-3 pr-0">
                                <p>{{ $review->description }}</p>
                                      
                                </blockquote>

                                <h5 class="testi-author">{{ optional($review->user)->name }} {{ optional($review->user)->last_name[0]  }}.</h5>
                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>
                <!-- End .testimonial-slider -->
            </div>
        </div>
    </div>
</section>
<!-- End .blog-section -->



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
                <h3 class="mb-0 pb-1">DELIVERIES AND RETURNS</h3>
                <h5 class="m-b-3">Hassle Free</h5>
                <p></p>
            </div><!-- End .feature-box-content -->
        </div><!-- End .feature-box -->
    </div><!-- End .col-md-4 -->
</div>

</div>



<div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url({{ $news_letter_image->image }})">
    <div class="newsletter-popup-content">
        <img src="{{ $system_settings->logo_path() }}"  class="logo-newsletter" alt="{{ Config('app.name') }} Logo">
        <h2>Join The Fashionista Stylish Geng!</h2>
        <p title="Subscribe to the hautesignatures newsletter to receive timely updates" class="mb-2">Subscribe to the hautesignatures newsletter to receive timely updates.
            You don’t want to miss out with new trends in fashion. Join Now and receive updates to glam up!</p> 
        <p>Join the geng!</p>
        
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


