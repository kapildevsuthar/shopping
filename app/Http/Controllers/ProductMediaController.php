<?php

namespace App\Http\Controllers;

use App\Models\Product_media;
use App\Models\ProductMedia;
use Illuminate\Http\Request;

class ProductMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductMedia $product)
    {
        return view('product_media.create', compact('product'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductMedia $product)
    {
        $request->validate([
            'media' => 'required|array',
            'media.*' => 'file|mimes:jpeg,png,jpg,gif,mp4|max:20480',
        ]);

        foreach ($request->file('media') as $file) {
            $path = $file->store('product_media', 'public');

            ProductMedia::create([
                'product_id' => $product->id,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
            ]);
        }

        return redirect()->route('products.show', $product)->with('success', 'Media uploaded successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_media  $product_media
     * @return \Illuminate\Http\Response
     */
    public function show(Product_media $product_media)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_media  $product_media
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_media $product_media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_media  $product_media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_media $product_media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_media  $product_media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_media $product_media)
    {
        //
    }
}
