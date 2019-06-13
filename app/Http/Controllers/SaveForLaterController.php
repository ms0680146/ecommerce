<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Cart::instance('saveForLater')->remove($id);
        return back()->with('success_message', '商品已經從稍後加入購物車移除!');
    }

    /**
     * Switch item from Saved for Later to Cart.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart(string $id)
    {
        $item = Cart::instance('saveForLater')->get($id);
        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;   
        });
     
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '此商品已經被加進購物車了!');
        }

        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        
        return redirect()->route('cart.index')->with('success_message', '商品成功加進購物車!');
    }
}
