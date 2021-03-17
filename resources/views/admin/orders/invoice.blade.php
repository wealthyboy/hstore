<!DOCTYPE html>
<html>
<head>
<title>invoice</title>
</head>
<style>
body{
  margin: 0px;

}

@media print {
 
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  .no-print{visibility: hidden;}
  #section-to-print {
    height:100%; 
    overflow: hidden;
    background: #FFF; 
    font-size: 17px;
    width: 100%;
    margin-right: 0px;
    padding: 10px;
  }
  span.tx{
    font-size: 15px;
    font-weight: 400;
  }
}   
</style>
<body onclick="window.print();" >
        <div  style="" id="section-to-print" class="col-md-12">
            @if($order != '')
              <br/>
              <div class="content" >
              <div class="">
                <strong>Name: </strong>   <span class="tx">&nbsp{{ optional(optional($order)->address)->first_name }} {{ optional(optional($order)->address)->last_name }} </span><br/>
                <strong>Phone: </strong> <span class="tx"> &nbsp{{ optional(optional($order)->user)->phone_number }} </span><br/>
                <strong>Address:  </strong><span class="tx"> &nbsp{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;&nbsp;</span><br/>
                <strong>State:  </strong><span class="tx">{{ optional(optional($order->address)->address_state)->name }}&nbsp;</span><br/><br/>
                <strong>Date: </strong> <span class="tx">&nbsp{{  $order->created_at->format('d/m/y') }}</span></div>
                <div style="margin-left: 150px;" class="logo">
                  <img width="200" src="{{ $system_settings->logo_path() }}" alt="{{ Config('app.name') }} Logo">
                </div>
              </div>
              
            @else
               <div> No data </div>
            @endif
         </div>
      </div>
               

  </div>
</body>

