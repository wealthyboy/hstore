<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cart;
use App\Mail\AbandonedCart;
use App\User;


class SendAbandonedCartEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:abandonedcart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send abandoned cart email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {    

        ////\Log::info(User::all());

        
        
            // $abandoned_carts = Cart::where('status','pending')->where('user_id','!=',null)->get();

            // \Log::info($abandoned_carts);
            // foreach ($abandoned_carts as $abandoned_cart) {
            //     if (optional($abandoned_cart->user)->email) {
            //         $carts = Cart::where('user_id',optional($abandoned_cart->user)->id)
            //                         ->where('status','pending')->get();
            //         if ($carts[0]->user->email){
            //             // \Mail::to("jacob.atam@gmail.com")
            //             // ->later(now()->addMinutes(10), new AbandonedCart($carts));
            //         }
                
            //     }
            // }

            // $this->info('Abandoned cart mail sent');


        // } catch (\Throwable $th) {
        //     \Log::error($th);
        // }

    }
}
