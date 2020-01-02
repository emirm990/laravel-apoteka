<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Items;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('cart.index', ['cartItems' => $cartItems]);
    }
    public function itemsInCart(){
        $total = 0;
        $totalInCart = Cart::where('user_id', auth()->id())->get()->pluck('count');
        foreach($totalInCart as $itemCount){
            $total += $itemCount;
        };
        return $total;
    }

    public function addToCart(User $user, Items $item, Request $request)
    {
        $user = $user::find(auth()->id());
        $item = $item::find($request->item_id);
        $number_of_items = $request->number_of_items;

   
        $itemInCart = Cart::where([
            ['user_id', $user->id],
            ['item_id', $item->id]
        ])->first();
        if ($itemInCart) {
            $itemInCart->count += $number_of_items;
            $itemInCart->total = $itemInCart->count * $item->price;
            $itemInCart->save();
            $total = $this->itemsInCart();
            return response()->json(
                ['item' => $itemInCart,
                'total' => $total]
            );
        }
        $cartItem = new Cart;
        $cartItem['user_id'] = $user->id;
        $cartItem['item_id'] = $item->id;
        $cartItem['count'] = $number_of_items;
        $cartItem['total'] = $cartItem->count * $item->price;
        $cartItem['processed'] = false;
        $cartItem->save();
        $total = $this->itemsInCart();
        return response()->json(
            ['item' => $cartItem,
            'total' => $total]
        );
        //return $cartItem;
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
    public function destroy(Cart $cart, User $user, Items $item, Request $request)
    {
        $user = Auth::id();
        $item = $item::find($request->item_id);
        $number_of_items = $request->number_of_items;
        $itemInCart = Cart::where([
            ['user_id', $user],
            ['item_id', $item->id]
        ])->first();
        if ($itemInCart) {
            $itemInCart->count -= $number_of_items;
            $itemInCart->total = $itemInCart->count * $item->price;
            if($itemInCart->count <= 0){
                $itemInCart->delete();
            }else{
                $itemInCart->save();
            } 
            return response()->json(
                ['item' => $itemInCart->count,
                'total' => $itemInCart->total]
            );
        }
        /*$cartItem = new Cart;
        $cartItem['user_id'] = $user->id;
        $cartItem['item_id'] = $item->id;
        $cartItem['count'] = $number_of_items;
        $cartItem['total'] = $cartItem->count * $item->price;
        $cartItem['processed'] = false;*
        $cartItem->save();

        return $cartItem;*/
    }
}
