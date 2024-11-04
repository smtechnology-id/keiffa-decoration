<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Package;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function catalog()
    {
        $packages = Package::all();
        return view('user.catalog', compact('packages'));
    }

    public function cart()
    {
        $cartCatalog = Cart::where('user_id', auth()->user()->id)->where('jenis', 'package')->get();
        $cartAdditional = Cart::where('user_id', auth()->user()->id)->where('jenis', 'additional')->get();
        return view('user.cart', compact('cartCatalog', 'cartAdditional'));
    }


    public function cartAdd($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();

        // check if package already in cart
        $cart = Cart::where('package_id', $package->id)->where('user_id', auth()->user()->id)->first();
        if ($cart) {
            return redirect()->route('user.cart')->with('error', 'Package already in cart');
        }

        // add to cart
        Cart::create([
            'user_id' => auth()->user()->id,
            'package_id' => $package->id,
            'quantity' => 1,
            'total_price' => $package->harga,
            'jenis' => 'package',
        ]);
        return redirect()->route('user.cart');
    }

    public function cartAddQuantity($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        $cart = Cart::where('package_id', $package->id)->where('user_id', auth()->user()->id)->first();
        $cart->quantity += 1;
        $cart->total_price = $cart->quantity * $package->harga;
        $cart->save();
        return redirect()->route('user.cart');
    }

    public function cartSubQuantity($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        $cart = Cart::where('package_id', $package->id)->where('user_id', auth()->user()->id)->first();
        $cart->quantity -= 1;
        if ($cart->quantity < 1) {
            $cart->delete();
        } else {
            $cart->total_price = $cart->quantity * $package->harga;
            $cart->save();
        }
        return redirect()->route('user.cart');
    }
}
