@extends('layouts.app')
@section('content')

@include('_partials.top_banner')

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item bold"><a href="/products/{{ $category->slug }}"><small>{{ title_case($category->name) }}</small></a></li>
            <li class="breadcrumb-item active" aria-current="page"><small>{{ $product_variation->name }}</small></li>
        </ol>
    </div>
</nav>

<div class="container-fluid">
    <div>
        <product-show :attributes="{{ $attributes }}" :stock="{{ $stock }}" :inventory="{{ $inventory }}"  :product="{{ $product_variation }}" />
    </div>
    @if ( optional($product_variation->product)->related_products->count() )

    <div class="products-section pt-0">
        <h2 class="section-title bold">Related Products</h2>

        <div class="products-slider owl-carousel owl-theme dots-top">
           
           
        </div><!-- End .products-slider -->
    </div><!-- End .products-section -->

    @endif
    </div><!-- End .container -->
@endsection





