@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">reply</i>
         </a>
      </div>
   </div>
  
   <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="card card-stats">
            <div class="card-content">
               <p class="category">Order Total</p>
               <h3 class="card-title">{{ $currency=null }}{{ optional($user->orders)->sum('total') }}</h3>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="card card-stats">
            <div class="card-content">
               <p class="category">All Orders</p>
               <h3 class="card-title">{{ $currency=null }}{{ optional($user->orders)->count() }}</h3>
            </div>
         </div>
      </div>
     
   
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">User {{ $user->full_name  }}</h4>
         </div>
         <div class="card-content">
            <ul class="nav nav-pills nav-pills-warning">
               <li class="active"><a href="panels.html#pill1" data-toggle="tab">General</a></li>
               <li class=""><a href="panels.html#carts" data-toggle="tab">Cart</a></li>
               <li class=""><a href="panels.html#Addresses" data-toggle="tab">Addresses</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="pill1">
                <div class="col-md-12 col-sm-12">
                     <div class="table-responsive">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td colspan="4"><b>Full Name</b></td>
                                 <td class="text-right"> {{ $user->fullname() }}</td>
                              </tr>
                             
                              <tr>
                                 <td colspan="4"><b>Email </b></td>
                                 <td class="text-right">{{  $user->email }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Phone </b></td>
                                 <td class="text-right">{{  $user->phone_number  }}</td>
                              </tr>
                             
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
                <div class="tab-pane" id="carts">
                    <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                            <th>
                                <div class="checkbox">
                                    <label>
                                    <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                    </label>
                                </div>
                            </th>
                            <th>Product name </th>
                            <th>Customer</th>
                            <th> Price</th>
                            <th>Quantity</th>
                            <th>Total</th>

                            <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->carts as $order )
                                <tr>
                                <td>
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" value="{{ $order->id }}" name="selected[]" >
                                    </label>
                                </div>
                            </td>
                                <td class="text-left">{{ optional(optional($order->product_variation)->product)->product_name }}

                                @if (null !== $order->product_variation)
                                    @foreach( $order->product_variation->product_variation_values  as $v)
                                       {{ $v->attribute->name .','}}
                                    @endforeach
                                 @else
                                    -----
                                 @endif
                                    
                                </td>
                                <td>{{ $user->fullname() }}</td>
                                <td>{{ $system_settings->default_currency->symbol }}{{optional(optional($order->product_variation)->product)->display_price() }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total }}</td>
                                <td class="td-actions text-center"></td>
                            @endforeach   
                            
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="Addresses">
                   @foreach($user->addresses as $address )
                    <div>
                        {{ $address->first_name }} </br> {{ $address->last_name }}  </br> {{ $address->city }}
                        </br> {{ $address->address }} 
                        </br> {{ null !== $address->address_state ? $address->address_state->name : '' }} 
                    </div>
                    @endforeach
                </div>


            </div>
         </div>
      </div>
   </div>

   <div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <div class="col-md-12">
               <div class="text-left">
                  <h4 class="card-title">Sales</h4>
               </div>
               <div class="text-right">
               </div>
            </div>
            <div class="toolbar">
               <!--  Here you can write extra buttons/actions for the toolbar-->
            </div>
            <div class="material-datatables">
               <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  <thead>
                     <tr>
                        <th>
                           <div class="checkbox">
                              <label>
                              <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                              </label>
                           </div>
                        </th>
                        <th>Customer</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sku</th>
                        <th>Total</th>
                        <th class="disabled-sorting text-right">Date</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                  </tbody>
               </table>
            </div>
         </div>
         <!-- end content-->
      </div>
      <!--  end card  -->
   </div>
   <!-- end col-md-12 -->
</div>
</div>
<!-- end row -->
@endsection
@section('page-scripts')
   <script src="{{ asset('asset/js/sweetalert2.js') }}"></script>
@stop

@section('inline-scripts')   
@stop
