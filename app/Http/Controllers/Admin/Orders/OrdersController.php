<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;

use App\Order;
use App\User;
use App\SystemSetting;
use App\OrderedProduct;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusNotification;





class OrdersController extends Controller{ 


  
    public function __construct()
    {

       $this->middleware('admin'); 
	   $this->settings =  \DB::table('system_settings')->first();
    }

    public function index ( ) { 
	
		$orders = Order::has('ordered_products')->orderBy('created_at','desc')->get();
        return view('admin.orders.index',compact('orders'));
    }
    

    public function invoice($id){
        $order     =  Order::find($id);
        $system_settings = SystemSetting::first();
		$sub_total = '';
        return view('admin.orders.invoice',compact('sub_total','order','system_settings'));
    }

    public static function order_status() { 
		return [
			"Processing",
			"Refunded",
			"Shipped",
			"Delivered"
		];
	}

	public function show($id) { 
	   $order     =  Order::find($id);
	   $statuses   =  static::order_status();
	   $total = \Db::table('ordered_product')->select(\DB::raw('SUM(ordered_product.price*ordered_product.quantity) as items_total'))->where('order_id',3004030)->get();
       $sub_total = $total[0]->items_total ?? '0.00';
	   return view('admin.orders.show',compact('statuses','order','sub_total'));
	}
	
	public function updateStatus(Request $request){
		$ordered_product = OrderedProduct::findOrFail($request->ordered_product_id);
		$ordered_product->status = $request->status;
		$ordered_product->save();  

		return $ordered_product;
	}
	
	
	public function updateOrderStatus(Request $request){
		$user = User::find($request->id);
		Notification::route('mail', $user->email)
            ->notify(new OrderStatusNotification($user,$request));
	}


    public function dispatchNote(Request $request,$id){
	    $page_title = 'Dispatch Note';
		$order =  Order::find($id);	 
		return view('admin.dispatch.index',compact('order','page_title'));
	}


}