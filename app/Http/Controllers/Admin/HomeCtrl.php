<?php 

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

use Illuminate\Support\Facades\Storage;





class HomeCtrl extends Controller
{
	
	protected $redirectTo = '/admin/login';

	/**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
          $this->middleware('admin'); 
     }

	public function index() { 

         $o = Category::where('name' ,'BAGS')->first();
         $o->parent_id = null;
         $o->save();
         

        return view('admin.index'); 
     }
     
	
}
?>