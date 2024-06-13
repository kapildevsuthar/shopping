<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function create()
    {
        return view('purchase.create');
    }
    

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'pincode' => 'required|numeric',
        'locality' => 'required|string|max:255',
        'total_price' => 'required|numeric',
    ]);

    $info = [
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'address' => $request->address,
        'pincode' => $request->pincode,
        'locality' => $request->locality,
        'total_price' => $request->total_price,
    ];

    Purchase::create($info);

    return redirect()->route('home')->with('success', 'Purchase created successfully!');
}
}
