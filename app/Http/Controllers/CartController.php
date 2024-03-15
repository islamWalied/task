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
        //
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

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product_id->id,
            'quantity' => $request->quantity,
        ]);
        return new CartResource($cart);
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
        $product = Product::find($id);
        if (!$product)
        {
            return new JsonResponse(['message'=>"this product isn't available in the cart"]);
        }
        $product->delete();
        return new JsonResponse(['message'=>'the item deleted successfully']);
    }
}
