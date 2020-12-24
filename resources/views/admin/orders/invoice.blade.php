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
    padding: 0px;
  }
  #section-to-print span{
    font-size: 15px;
    font-weight: 400;
  }
}   
</style>
<body onclick="window.print();" >
        <div  style="" id="section-to-print" class="col-md-12">
                    @if($order != '')
                    <div><img src="" /></div>

                    <br/>


                     <div >
                        <div class="">
                         <strong>Invoice No: </strong>  <span class="tx">&nbsp{{ $order->invoice }}</span><br/>

                        <strong>Name: </strong>   <span class="tx">&nbsp{{ optional(optional($order)->address)->first_name }} {{ optional(optional($order)->address)->last_name }} </span><br/>
                        <strong>Phone: </strong> <span class="tx"> &nbsp{{ optional(optional($order)->address)->phone_number }} </span><br/>
                        <strong>Address:  </strong><span class="tx"> &nbsp{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;<br /> {{ optional(optional($order->address)->address_state)->name }},{{ optional(optional($order->address)->address_country)->name }}&nbsp;</span><br/><br/>
                        <strong>Date: </strong> <span class="tx">&nbsp{{  $order->created_at->format('d/m/y') }}</span></div>

                        <hr/>                        


                     
                     </div>
                     

                    @else
                       <div> No data </div>
                    @endif
                  </div>
               </div>
               

  </div>
</body>

