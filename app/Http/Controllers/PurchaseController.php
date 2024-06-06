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
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'pincode' => 'required|numeric',
            'locality' => 'required|string|max:255',
        ]);

        $purchase = Purchase::create([
            'email' => $request->email,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'locality' => $request->locality,
            'total_price' => 0, // Adjust as per your logic
        ]);

        if ($purchase) {
            return redirect()->route('home')->with('success', 'Purchase created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create purchase.');
        }
    }
}
