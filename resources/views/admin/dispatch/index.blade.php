<!DOCTYPE html>
<html>
<head>
<title>Dispatch</title>
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
    padding-right: 15px;
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
                @if (null !== $order->shipping)
                  <strong>Address:  </strong><span class="tx"> &nbsp{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;&nbsp;</span><br/>
                  @else
                  <strong>
                  {{ 
                     $order->delivery_option == "1 Bassie Ogamba Street, off Adeniran Ogunsanya , SURULERE (₦200 to be paid at pick up address" ? "Pick Up:  " : "Stock Pile: " 
                  }}
                  </strong> 
                  {{ $order->delivery_option }}<br/>
                @endif
                <strong>State:  </strong><span class="tx">{{ optional(optional($order->address)->address_state)->name }}&nbsp;</span><br/>
                <strong>Date: </strong> <span class="tx">&nbsp{{  $order->created_at->format('d/m/y') }}</span></div>
                
              </div>
              
            @else
               <div> No data </div>
            @endif
         </div>
      </div>
               

  </div>
</body>