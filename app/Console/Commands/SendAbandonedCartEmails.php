<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cart;
use App\Mail\AbandonedCart;


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
    protected $description = 'Send emails to users with abandou=ned cart';

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
        $cart = Cart::all();
        \Mail::to('jacob.atam@gmail.com')
               ->send(new AbandonedCart($cart));
    }
}
