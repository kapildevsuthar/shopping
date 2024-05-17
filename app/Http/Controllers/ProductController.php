<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index',['data'=>Product::all()]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        // dd($data);
        return view('products.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => [],
            'price' => [],
            'discount' => [],
            'cgst' => [],
            'sgst' => [],
            'net_price' => [],
        ]);
        $price= $request->price;
        $discount= $request->discount;
        $cgst= $request->cgst;
        $sgst= $request->sgst;

        $validated['net_price']= $price -($price*$discount/100)+ ($price*$cgst/100 )+ ($price*$sgst/100);
        // Assign user_id to the authenticated user's ID
        $validated['user_id'] = Auth::id();
        // Create a new product record in the database using Eloquent ORM
       $data= Product::create($validated);
       foreach($request->selected_values as $cid){
       $info=[
        'product_id' =>$data['id'],
'category_id' =>$cid,
       ];
        Product_category::create($info);
    }
        // Redirect back to the products page with a success message
        return redirect("/products")->with("success", "Data has been saved successfully");
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
        // $category=Category::find($id);
        // dd($product); 
        $data = Category::all();
        $ProductCategory = Product_category::all();
        return (view("products.edit",compact('product','data','ProductCategory')));
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
        // dd($request->name);
        // dd($product->name);
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => [],
            'mrp' => [],
            'price' => [],
            'discount' => [],
            'cgst' => [],
            'sgst' => [],
        ]);

        // Assign user_id to the authenticated user's ID
        // $validated['user_id'] = Auth::id();

        // Create a new product record in the database using Eloquent ORM
        
        $product->update($validated);

        // Redirect back to the products page with a success message
        return redirect("/products")->with("success", "Data has been saved successfully");
    }

    /**
     * Remove the specified resource from storage.  
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
        public function destroy(Product $product)
        {
            dd($product);
            $product->delete();

            // Redirect the user to a different page with a success message
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
}
