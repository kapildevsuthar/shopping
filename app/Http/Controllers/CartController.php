<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        // Check if product is already in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "net_price" => $product->net_price,
                "image" => $product->media->first()->file_path ?? 'imgnotavl.png'
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]['quantity'] = $request->quantity;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }
}
