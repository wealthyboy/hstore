<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use App\User;
use Storage;
use App\Http\Resources\CartIndexResource;


class CartController  extends Controller {

	
    public function index() {
		$page_title = "Your Cart  ";
		return view('carts.index',compact('page_title'));
	}
	

}