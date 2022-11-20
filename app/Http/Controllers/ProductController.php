<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function index()
    {
        if (!auth()->user()->email === 'admin@admin.com') {
            return redirect()->route('welcome');
        }
        return Inertia::render('Product/List', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Product/Form', [
            'type' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();
        $data['code'] = 'manual-' . rand(50, 700);

        Product::create($data);

        return redirect()->route('product')->banner('Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show(Product $product)
    {
        $cart = session('cart');
        $added = false;
        if (isset($cart[$product->id])) {
            $added = true;
        }
        return Inertia::render('Product/Show', [
            'product' => $product,
            'added' => $added
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Form', [
            'product' => $product,
            'type' => 'update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('product')->banner('Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->deleteOrFail();
        return redirect()->route('product');
    }
}
