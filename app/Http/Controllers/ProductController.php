<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Guesser\Name;
use App\Models\Category;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use App\Models\Product_category;
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
        return view('products.index',['data'=>Product::with('media')->get()]);
        
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
        $file = $request->file('image');

        // print_r($file);


        // $ext = $file->getClientOriginalExtension();
        // $name = $file->getClientOriginalName();
        // dd($ext);
        // $nameOfFile=time().'.'.$name;
        // $path='image';
        // $file->move($path,$nameOfFile);
        // $file->move('image',$nameOfFile);
        // dd($nameOfFile);
        
        // request()->image->move(public_path('image'), $nameOfFile);


        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => [],
            'price' => [],
            'discount' => [],
            'cgst' => [],
            'sgst' => [],
            'net_price' => [],
            'image'=>[]
        ]);
        $price= $request->price;
        $discount= $request->discount;
        $cgst= $request->cgst;
        $sgst= $request->sgst;
        // $file_type= $path.$nameOfFile;
        
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

        // ProductMedia::create([
        // 'product_id' =>$data['id'],
        //     "file_path"=>$nameOfFile,
        //     "file_type"=>$ext
        // ]);
    }


// file uplaod code 

foreach($file as $val){
    // echo $val->getClientOriginalName();
    // echo "<br>";

    $ext = $val->getClientOriginalExtension();
    $name = $val->getClientOriginalName();
    $nameOfFile=time().'_'.$name;
    $path='image';
    $val->move($path,$nameOfFile);
    // $val->move('image',$nameOfFile);

// request()->image->move(public_path('image'), $nameOfFile);

$file_type= $path.$nameOfFile;

ProductMedia::create([
    'product_id' =>$data['id'],
        "file_path"=>$nameOfFile,
        "file_type"=>$ext
]);


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
        // $data = $product->categoryids();
        // dd($data);
        $data = Category::all();
        $ProductCategory = Product_category::all();
        // dd($product->categoryids);
        // $product = Product::find()
        
        return (view("products.edit",compact('product','data')));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
{
    $files = $request->file('image');

    $validated = $request->validate([
        'name' => ['required', 'max:255'],
        'description' => [],
        'price' => [],
        'discount' => [],
        'cgst' => [],
        'sgst' => [],
        'net_price' => [],
        'image' => []
    ]);

    // Calculate the net price
    $price = $request->price;
    $discount = $request->discount;
    $cgst = $request->cgst;
    $sgst = $request->sgst;
    $validated['net_price'] = $price - ($price * $discount / 100) + ($price * $cgst / 100) + ($price * $sgst / 100);

    // Update the product details
    $product->update($validated);

    // Handle image files if provided
    if ($files) {
        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $nameOfFile = time() . '_' . $name;
            $path = 'image';
            $file->move($path, $nameOfFile);

            $file_type = $path . '/' . $nameOfFile;

            // Create new media record
            ProductMedia::create([
                'product_id' => $product->id,
                'file_path' => $nameOfFile,
                'file_type' => $ext
            ]);
        }
    }

    // Redirect back to the products page with a success message
    return redirect("/products")->with("success", "Product updated successfully");
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
                

            // Redirect the user to a different page with a success message
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
           public function list()
    {
        return view('products.list',['data'=>Product::with('media')->get()]);
        
    }

    
}
