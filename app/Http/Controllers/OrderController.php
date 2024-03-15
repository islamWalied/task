<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function Sodium\compare;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $notify = Notification::all();
        return view('admin.orders.index',compact('orders','notify')) ;
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
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'unique:orders',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'shipping_address' => 'required',
            'shipping_method' => 'required',
        ]);

        $order = Order::create([
            'order_number' => 'ORD' . time() . '-' . Str::random(6),
            'user_id' => Auth::user()->id,
            'total_price' => $request->total_price,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'shipping_method' => $request->shipping_method,
            'payment_method' => $request->payment_method,
        ]);
        event(new \App\Events\OrderEvent($order->user->name));

        $date = [
            'order_number' => $order->order_number,
            'total_price' => $request->total_price,
        ];
        $notify = Notification::create([
            'type' => 'order.created',
            'data' => json_encode($date),
            'user_id' => $order->user_id,
        ]);

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
