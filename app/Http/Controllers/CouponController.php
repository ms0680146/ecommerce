<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Coupon;

class CouponController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        
        if (!isset($coupon)) {
            return redirect()->route('cart.index')->with('error', '未找到此折扣碼，請再嘗試一次!');
        }
     
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::instance(config('cart.cart_type'))->subtotal()),
        ]);
        
        return redirect()->route('cart.index')->with('success_message', '可以使用此折扣碼!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('cart.index')->with('success_message', '折扣碼成功移除!');
    }
}
