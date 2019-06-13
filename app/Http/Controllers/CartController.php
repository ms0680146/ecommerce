<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get(); 
        return view('cart', compact('mightAlsoLike'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::instance(config('cart.cart_type'))->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;   
        });
        
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '此商品已經被放入購物車!');
        }

        cart::instance(config('cart.cart_type'))->add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message', '成功加入購物車!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            session()->flash('errors', $validator->messages()->all());
            return response()->json(['success' => false], 400);
        }

        try {
            Cart::instance(config('cart.cart_type'))->update($id, $request->quantity);
            session()->flash('success_message',  '此商品的數量已被更新');
        } catch(\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true] , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Cart::instance(config('cart.cart_type'))->remove($id);
        return back()->with('success_message', '商品已經移除購物車!');
    }

    /**
     * Switch item from Cart to Saved for Later.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater(string $id)
    {
        $item = Cart::instance(config('cart.cart_type'))->get($id);
        Cart::instance(config('cart.cart_type'))->remove($id);

        $duplicates = Cart::instance(config('cart.saveForLater_type'))->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;   
        });
     
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '此商品已經被加進稍後購買了!');
        }

        Cart::instance(config('cart.saveForLater_type'))->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

        return redirect()->route('cart.index')->with('success_message', '商品成功加進稍後購買');
    }
}
