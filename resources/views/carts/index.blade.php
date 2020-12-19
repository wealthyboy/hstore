 
  


@extends('layouts.app')
 
@section('content')
 

  
   <!--Content-->
   
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










