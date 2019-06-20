<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Order;
use App\OrderProduct;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout');
    }

    public function store()
    {
        // Insert into orders table
        $couponDiscount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;
        $couponName = session()->has('coupon') ? session()->get('coupon')['name'] : null;

        try {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'billing_discount' => $couponDiscount,
                'billing_discount_code' => $couponName,
                'billing_subtotal' => Cart::instance(config('cart.cart_type'))->subtotal(),
                'billing_total' => Cart::instance(config('cart.cart_type'))->subtotal() - $couponDiscount,
            ]);
            // Insert into order_product table
            foreach (Cart::instance(config('cart.cart_type'))->content() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                ]);
            }
            // Delete Cart Instance & coupon
            Cart::instance(config('cart.cart_type'))->destroy();
            session()->forget('coupon');

            return redirect()->route('static.thanks');
        } catch(\Exception $e) {
            Log::error($e);
            return back()->with('error',  $e->getMessage());
        }
    }
}
