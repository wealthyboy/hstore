<?php  namespace App\Http\Controllers\Admin\Activity;

use Illuminate\Http\Request;




use App\Activity;


use App\Http\Controllers\Controller;


class ActivityController extends Controller
{
    //
	 
	 
	 public function __construct()
    {
    }

	public function index(){
		
		$activities = Activity::orderBy('created_at','DESC')->get();
	    return view('admin.activity.index',compact('activities'));
    }

	protected function delete($id)
    {   
	     $users = Activity::find($id);
	     $users->delete();  
         $flash = app('App\Http\flash');
		 $flash->success("Success"," Deleted");
		 return redirect()->back();
    }
	

}
