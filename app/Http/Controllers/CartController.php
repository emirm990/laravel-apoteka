<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Items;
use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->join('items', 'items.id', '=', 'item_id')->get();
        $totalPrice = Cart::select('total')->where('user_id', auth()->id())->get();
        $cartPrice = 0;
        foreach ($totalPrice as $price) {
            $cartPrice += $price->total;
        }
        
        return view('cart.index', ['cartItems' => $cartItems, 'cartPrice' => $cartPrice]);
    }

    public function addToCart(User $user, Items $item, Request $request)
    {
        $user = $user::find($request->user_id);
        $item = $item::find($request->item_id);
        $itemInCart = Cart::where([
            ['user_id', $user->id],
            ['item_id', $item->id]
        ])->first();
        if ($itemInCart) {
            $itemInCart->count += 1;
            $itemInCart->total = $itemInCart->count * $item->price;
            $itemInCart->save();
            return $itemInCart;
        }
        $cartItem = new Cart;
        $cartItem['user_id'] = $user->id;
        $cartItem['item_id'] = $item->id;
        $cartItem['count'] = 1;
        $cartItem['total'] = $cartItem->count * $item->price;
        $cartItem['processed'] = false;
        $cartItem->save();

        return $cartItem;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
