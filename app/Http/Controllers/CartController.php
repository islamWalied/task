<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return CartResource::collection($cart);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $product_id = Product::findOrFail($id);
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cart_id = Cart::where('product_id',$id)->first();
        if ($cart_id)
        {
            if ($request->quantity > $product_id->quantity){
                return new JsonResponse(['message'=>"you can not add more than the product quantity"]);
            }
            $cart_id->update(['quantity' => $request->quantity]);
        }
        else {
            $cart_id = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id->id,
                'quantity' => $request->quantity,
            ]);
        }
        return new CartResource($cart_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Cart::where('product_id',$id)->first();
        if (!$product)
        {
            return new JsonResponse(['message'=>"this product isn't available in the cart"]);
        }
        $product->delete();
        return new JsonResponse(['message'=>'the item deleted successfully']);
    }
    public function increment($id)
    {
        $product_id = Product::findOrFail($id);
        $cartItem = Cart::where('product_id',$id)->first();
        if($cartItem->quantity < $product_id->quantity)
        {
            $cartItem->increment('quantity');
        }
        else {
            return new JsonResponse(['message' => "you can not add more than the product quantity"]);
        }
        return $cartItem;
    }

    public function decrement($id)
    {
        $cartItem = Cart::where('product_id',$id)->first();
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
        return $cartItem;
    }
}
