<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Cart;
use App\PendingCart;

class CartController  extends Controller {

	
    public function index() {
		$page_title = "Your Cart  ";
		return view('carts.index',compact('page_title'));
	}

	public function meta() {
		$pending_cart = new PendingCart;
		return $pending_cart;
	}



}