@extends('layouts.app')
 
@section('content')  
  


@extends('layouts.app')
 
@section('content')
    <!--Content-->
    <div class="top-notice text-white bg--gray">
    <div class="container-fluid text-center">
        <div class="row">
            
            <div class="col-12">
                <h5 class="d-inline-block color--primary text-uppercase  mb-0"><b><i class="fas fa-money-check"></i>
                    LAUCH WEEK  GET 5% OFF  USE  HSLNCH </b>
                </h5>
            </div>

        </div>
        
    </div><!-- End .container -->
</div>
  
   <!--Content-->
   <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"><small>WishList</small></li>
            </ol>
        </div>
    </nav> 
    <section class="bg--gray">          
        <div class="container-fluid">
            <div id="js-loading"  class="full-bg">
                <div class="signup--middle">
                    <div class="loading">
                        <div class="loader"></div>
                    </div>
                    <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="The Luxury sale Logo">
                </div>        
            </div>
            <cart-summary :sub_total="{{ $sub_total }}" :crts="{{ $carts }}" />

        </div>
    </section>
    <!--End Content-->
@endsection










