<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\Purchase;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view("purchase.create");
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
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'pincode' => 'required|numeric',
        'locality' => 'required|string|max:255',
    ]);

    // Calculate the total price (you need to implement this logic based on your cart)
    $totalPrice = $this->calculateTotalPrice();

    $purchase = Purchase::store([
        'email' => $request->email,
        'name' => $request->name,
        'mobile' => $request->mobile,
        'address' => $request->address,
        'pincode' => $request->pincode,
        'locality' => $request->locality,
        'total_price' => $totalPrice,
    ]);

    // Clear the cart (implement this logic as needed)

    return redirect()->route('home')->with('success', 'Purchase created successfully!');
}

private function calculateTotalPrice()
{
    // Implement your logic to calculate the total price of items in the cart
    // For example, you might loop through the items in the cart and sum their prices
    return 100; // Example fixed total price
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
