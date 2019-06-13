<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id;   
        });
        
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '此商品已經被放入購物車!');
        }

        cart::instance('cart')->add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message', '成功加入購物車!');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Cart::instance('cart')->remove($id);
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
        $item = Cart::instance('cart')->get($id);
        Cart::instance('cart')->remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;   
        });
     
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '此商品已經被加進稍後購買了!');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

        return redirect()->route('cart.index')->with('success_message', '商品成功加進稍後購買');
    }
}
