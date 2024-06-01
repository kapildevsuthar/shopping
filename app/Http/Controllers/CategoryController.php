<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('category.index',['data'=>Category::with('media')->get()]);

        return view('category.index',['data'=>Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("category.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
       $validated = $request->validate([
        'name' => ['required','max:50'],
        'description' =>[ 'max:255'],
        'image'=>""
       ]);
    //    $ext = $file->getClientOriginalExtension();
       
       $nameOfFile=time().'_'.$request->image->getClientOriginalName();
       //$path='image';
       $request->image->move('image',$nameOfFile);
      $validated['image']= $nameOfFile;
       
       $validated['user_id'] = 1;
        Category::create($validated);
    
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
        public function edit($id)
    {
        $category=Category::find($id);
        // dd($category); 
        return (view("category.edit",compact('category')));
    }
    // public function edit(Category $category)
    // {
    //     // dd($category);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->name);
        // dd($category);

            
        $validated = $request->validate([
            'name' => ['required','max:50'],
            'description' =>[ 'max:255'],
            'image'=>""
        ]);
        $nameOfFile=$category->image;
        if($request->file('image')){
            if($nameOfFile){
                unlink("image\\$nameOfFile");
            }
       $nameOfFile=time().'_'.$request->image->getClientOriginalName();
       //$path='image';
       $request->image->move('image',$nameOfFile);
      $validated['image']= $nameOfFile;
        }

        //    $validated['user_id'] = Auth::id();
            // dd($validated);

        //    $validated['user_id'] = 1;
        $category->update($validated);
        
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // dd($category);
        $category->delete();
        return redirect('/category');
    }
    // public function deleted(Category $category)
    // {
    //     dd($category);
    // }
    
}
