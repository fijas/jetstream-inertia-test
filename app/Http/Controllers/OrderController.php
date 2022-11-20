<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $orders = Order::where(['user_id' => auth()->user()->id])->withCount('products')->get();
        return Inertia::render('Order/Index', [
            'orders' => $orders
        ]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $products = [];
        $cart = [];
        $tax = 0;
        $subTotal = 0;
        $total = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            $products = Product::whereIn('id', array_keys($cart))
                ->get();
            foreach ($products as $product) {
                $subTotal += $product->price * $cart[$product->id];
            }
            $tax = round($subTotal * 0.1, 2);
            $total = round($subTotal + $tax, 2);
        }
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => Order::STATUS_INITIATED,
            'sub_amount' => $subTotal,
            'tax_amount' => $tax,
            'total_amount' => $total
        ]);
        foreach ($products as $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'count' => $cart[$product->id]
            ]);
        }
        Mail::to($request->user())->send(new OrderCreated($order));
        Transaction::create([
            'order_id' => $order->id,
            'status' => Transaction::STATUS_PAYMENT_INITIATED,
            'amount' => $total,
            'type' => Transaction::TYPE_CREDIT_CARD,
        ]);
        Transaction::create([
            'order_id' => $order->id,
            'status' => Transaction::STATUS_PAYMENT_COMPLETED,
            'amount' => $total,
            'type' => Transaction::TYPE_CREDIT_CARD,
        ]);
        session()->put('cart', null);

        return redirect('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show(Order $order)
    {
        return Inertia::render('Order/Show', [
            'order' => fn () => $order->load('products'),
            'user' => fn () => User::find(auth()->user()->id),
            'transactions' => Inertia::lazy(fn () => Transaction::where(['order_id' => $order->id])->get())
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        if (!$order->delete()) {
            return redirect('order.view', $order->id);
        }
        return redirect('order');
    }
}
