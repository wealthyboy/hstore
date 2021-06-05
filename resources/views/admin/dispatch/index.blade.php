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
    font-size: 25px;
    width: 100%;
    margin-right: 10px;
    margin-top: 10px;

    padding: 10px;
    padding-right: 15px;
  }
  span.tx{
    font-size: 20px;
    font-weight: 400;
  }

  .content strong {
    font-size: 25px;
  }
}   
</style>
<body onclick="window.print();" >
        <div  style="" id="section-to-print" class="col-md-12">
            @if($order != '')
              
              <div class="content" >
                <strong>Name: </strong>   <span class="tx">&nbsp{{ optional(optional($order)->address)->first_name }} {{ optional(optional($order)->address)->last_name }} </span><br/>
                <strong>Phone: </strong> <span class="tx"> &nbsp{{ optional(optional($order)->user)->phone_number }} </span><br/>
                @if (null !== $order->shipping)
                  <strong>Address:  </strong><span class="tx"> &nbsp{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;&nbsp;</span><br/>
                  @else
                  <strong>
                    Delivery Option: 
                  </strong> 
                    @if(str_contains($order->delivery_option,  "SURULERE" )
                        Pick up at surulere.
                    
                    @elseif(str_contains($order->delivery_option,  "Magodo" )
                         Pick up at magodo.
                    @else
                        Stock pile.
                    @endif
                  <br/>
                @endif
                <strong>State:  </strong><span class="tx">{{ optional(optional($order->address)->address_state)->name }}&nbsp;</span><br/>
                <strong>Date: </strong> <span class="tx">&nbsp{{  $order->created_at->format('d/m/y') }}</span>
              </div>
                
              
            @else
               <div> No data </div>
            @endif
         </div>
      </div>
               

  </div>
</body>