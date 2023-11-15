<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Jobs\SendEmailJob;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
{
    $request->validated();

    $product = new Product([
        'article' => $request->article,
        'name' => $request->name,
        'status' => $request->status,
        'data' => ['Color' => $request->color, 'Size' => $request->size],
    ]);

    $product->save();

    $details = [
        'email' => config('products.email'),
        'article' => $request->article,
        'name' => $request->name,
        'status' => $request->status,
    ];

    dispatch(new SendEmailJob($details));

    return redirect()->route('products.index')->with('success','Product created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $admin = false;
        if (array_search(auth()->user()->name, config('products.role')['admin']) !== false) {
            $admin = true;
        }
        return view('products.edit',compact('product', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();
        $array = [
            
            'name' => $request->name,
            'status' => $request->status,
            'data' => ['Color' => $request->color, 'Size' => $request->size],
        ];

        $product->update($array);

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success','product deleted successfully');
    }
}
