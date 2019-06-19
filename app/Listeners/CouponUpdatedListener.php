<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $couponName = session()->get('coupon')['name'];

        if (isset($couponName)) {
            $coupon = Coupon::where('code', $couponName)->first();
            if (is_null($coupon)) {
                Log::error('Coupon is not found: '. $couponName);
                return;
            }
            
            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(Cart::subtotal()),
            ]);
        }
    }
}
