<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $products = [];
        $cart = [];
        $tax = 0;
        $total = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            $products = Product::whereIn('id', array_keys($cart))
                ->get();
            foreach ($products as $product) {
                $total += $product->price * $cart[$product->id];
            }
            $tax = round($total * 0.1, 2);
            $total = round($total + $tax, 2);
        }

        return Inertia::render('Cart/Index', [
            'products' => $products,
            'cart' => $cart,
            'total' => $total,
            'tax' => $tax
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
        $cart = [];
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
        }
        $cart[$request->input('id')] = $request->input('quantity');
        $request->session()->put('cart', $cart);

        return redirect('/product/' . $request->input('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
