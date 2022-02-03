<?php  

namespace App\Http\ViewComposer;

use  App\User;
use Illuminate\View\View;

use Auth;
use App\Cart;
use App\Information;
use App\Category;
use App\SystemSetting;
use App\Voucher;
use App\Promo;
use App\Currency;
use App\EnableBlog;

use App\PageBanner;


use Illuminate\Support\Facades\Cache;

class   NavComposer { 
   
   
    public function compose (View $view) 
	{ 
		$global_categories = Category::parents('sort_order', 'asc')->where('is_active',true)->get();
		$footer_info = Information::where('blog',false)->parents()->get(); 
		$global_promo = Promo::first(); 
		$system_settings = SystemSetting::first();
		$currencies      = Currency::all();
		$blog_status     = EnableBlog::first();
		$news_letter_image = PageBanner::where('page_name','newsletter')->first();
	    $view->with([
		   	'footer_info'=>$footer_info,
		   	'global_categories'=> $global_categories,
			'system_settings'=>$system_settings,
			'global_promo'=>$global_promo,
			'news_letter_image' =>$news_letter_image,
			'currencies' =>$currencies,
			'blog_status'=>$blog_status
	    ]);
    }




}