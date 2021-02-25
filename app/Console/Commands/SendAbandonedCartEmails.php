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
        
        try {
            $abandoned_carts = Cart::where('user_id','!=',null)
                        ->where('status','pending')->get();

            \Log::info($abandoned_carts);

            \Log::info(User::find(838));


            foreach ($abandoned_carts as $abandoned_cart) {
                if (optional($abandoned_cart->user)->email) {
                    $user_carts = Cart::where('user_id',optional($abandoned_cart->user)->id)
                                    ->where('status','pending')->get();
                    if ($user_carts[0]->user->email){
                        \Mail::to($user_carts[0]->email)
                        ->send(new AbandonedCart($user_carts));
                    }
                
                }
            }

        } catch (\Throwable $th) {
            \Log::error($th);
        }
        
    }
}
