<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactNotification;

class ContactController extends Controller
{
    

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Notification::route('mail', 'jacob.atam@gmail.com')
            ->notify(new ContactNotification($request));
            return back()->with("success", "Thank for your message.Your request will be looked into and a member of our team will be in touch.");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with("success", "We could not send your mail at the moment");

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


   
}
