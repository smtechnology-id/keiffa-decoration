<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Package;
use App\Models\Payments;
use App\Models\Portfolio;
use App\Models\ProductOrder;
use App\Models\Review;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('user.index', compact('packages'));
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
        $totalPrice = $cartCatalog->sum('total_price') + $cartAdditional->sum('total_price');
        return view('user.cart', compact('cartCatalog', 'cartAdditional', 'totalPrice'));
    }


    public function cartAdd($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        if ($package) {
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
        } else {
            $additional = Additional::where('slug', $slug)->first();

            if ($additional) {
                $cart = Cart::where('additional_id', $additional->id)->where('user_id', auth()->user()->id)->first();
                if ($cart) {
                    return redirect()->route('user.cart')->with('error', 'Additional already in cart');
                }
                // add to cart
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'additional_id' => $additional->id,
                    'quantity' => 1,
                    'total_price' => $additional->harga,
                    'jenis' => 'additional',
                ]);
                return redirect()->route('user.cart');
            }
        }
        return redirect()->route('user.catalog')->with('error', 'Package or Additional not found');
    }

    public function cartAddQuantity($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        if ($package) {
            $cart = Cart::where('package_id', $package->id)->where('user_id', auth()->user()->id)->first();
            // maksimal 1
            if ($cart->quantity >= 1) {
                return redirect()->route('user.cart')->with('error', 'Maksimal Quantity 1');
            }
        } else {
            $additional = Additional::where('slug', $slug)->first();
            $cart = Cart::where('additional_id', $additional->id)->where('user_id', auth()->user()->id)->first();
            $cart->quantity += 1;
            $cart->total_price = $cart->quantity * $additional->harga;
            $cart->save();
        }
        return redirect()->route('user.cart');
    }

    public function cartSubQuantity($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        if ($package) {
            $cart = Cart::where('package_id', $package->id)->where('user_id', auth()->user()->id)->first();
            $cart->quantity -= 1;
            if ($cart->quantity < 1) {
                $cart->delete();
            } else {
                $cart->total_price = $cart->quantity * $package->harga;
                $cart->save();
            }
        } else {
            $additional = Additional::where('slug', $slug)->first();
            $cart = Cart::where('additional_id', $additional->id)->where('user_id', auth()->user()->id)->first();
            $cart->quantity -= 1;
            if ($cart->quantity < 1) {
                $cart->delete();
            } else {
                $cart->total_price = $cart->quantity * $additional->harga;
                $cart->save();
            }
        }
        return redirect()->route('user.cart');
    }

    public function additional()
    {
        $additional = Additional::all();
        return view('user.additional', compact('additional'));
    }

    // order
    public function order()
    {
        $orders = Orders::where('user_id', auth()->user()->id)->get();
        return view('user.order', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'bride_name' => 'required',
            'grooms_name' => 'required',
            'wedding_date' => 'required',
            'wedding_location' => 'required',
            'wedding_theme' => 'required',
        ]);
        //   Process Checkout
        $cart_additional = Cart::where('user_id', auth()->user()->id)->where('jenis', 'additional')->get();
        $cart_package = Cart::where('user_id', auth()->user()->id)->where('jenis', 'package')->get();
        if ($cart_additional->isEmpty() && $cart_package->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Cart is empty');
        }
        if ($cart_package->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Minimal memesan 1 Paket Dekorasi Wedding');
        }


        $code_order = 'INV-' . date('Ymd') . '-' . rand(10000, 99999);
        $order = Orders::create([
            'user_id' => auth()->user()->id,
            'code_order' => $code_order,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->grooms_name,
            'wedding_date' => $request->wedding_date,
            'wedding_location' => $request->wedding_location,
            'wedding_theme' => $request->wedding_theme,
            'total_price' => $cart_additional->sum('total_price') + $cart_package->sum('total_price'),
            'status' => 'pending',
        ]);

        if ($cart_package) {
            foreach ($cart_package as $package) {
                ProductOrder::create([
                    'order_id' => $order->id,
                    'code_order' => $code_order,
                    'user_id' => auth()->user()->id,
                    'package_id' => $package->package_id,
                    'quantity' => $package->quantity,
                    'total_price' => $package->total_price,
                    'jenis' => 'package',
                ]);
            }
        }
        if ($cart_additional) {
            foreach ($cart_additional as $additional) {
                ProductOrder::create([
                    'order_id' => $order->id,
                    'code_order' => $code_order,
                    'user_id' => auth()->user()->id,
                    'additional_id' => $additional->additional_id,
                    'quantity' => $additional->quantity,
                    'total_price' => $additional->total_price,
                    'jenis' => 'additional',
                ]);
            }
        }
        return redirect()->route('user.payment', $code_order)->with('success', 'Checkout Success');
    }

    public function payment($code_order)
    {
        $order = Orders::where('code_order', $code_order)->first();
        $package = ProductOrder::where('order_id', $order->id)->where('jenis', 'package')->get();
        $additional = ProductOrder::where('order_id', $order->id)->where('jenis', 'additional')->get();
        $total_price = $package->sum('total_price') + $additional->sum('total_price');
        $totalPackage = $package->sum('total_price');
        $totalAdditional = $additional->sum('total_price');
        $dateRemainingPayment = \Carbon\Carbon::parse($order->wedding_date)->subDays(7)->format('d M Y');

        $downPayment = Payments::where('order_id', $order->id)->where('jenis', 'down-payment')->first();
        $remainingPayment = Payments::where('order_id', $order->id)->where('jenis', 'remaining-payment')->first();
        return view('user.payment', compact('order', 'package', 'additional', 'total_price', 'totalPackage', 'totalAdditional', 'dateRemainingPayment', 'downPayment', 'remainingPayment'));
    }

    public function paymentDown(Request $request)
    {
        $request->validate([
            'down_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_id' => 'required',
            'code_order' => 'required',
        ]);
        if ($request->hasFile('down_payment')) {
            // Store the uploaded file in the 'payment_proof' directory
            $paymentProofPath = $request->file('down_payment')->store('payment_proof', 'public');
            $namePaymentProof = $request->file('down_payment')->hashName();
        }
        $payment = Payments::create([
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'code_order' => $request->code_order,
            'jenis' => 'down-payment',
            'payment_proof' => $namePaymentProof,
            'status' => 'pending',
        ]);
        return redirect()->route('user.payment', $request->code_order)->with('success', 'Payment Success');
    }
    public function paymentRemaining(Request $request)
    {
        $request->validate([
            'remaining_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_id' => 'required',
            'code_order' => 'required',
        ]);
        if ($request->hasFile('remaining_payment')) {
            // Store the uploaded file in the 'payment_proof' directory
            $paymentProofPath = $request->file('remaining_payment')->store('payment_proof', 'public');
            $namePaymentProof = $request->file('remaining_payment')->hashName();
        }
        $payment = Payments::create([
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'code_order' => $request->code_order,
            'jenis' => 'remaining-payment',
            'payment_proof' => $namePaymentProof,
            'status' => 'pending',
        ]);
        return redirect()->route('user.payment', $request->code_order)->with('success', 'Payment Success');
    }

    public function paymentRemainingUpdate(Request $request)
    {
        $request->validate([
            'remaining_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_id' => 'required',
            'code_order' => 'required',
            'payment_id' => 'required',
        ]);
        if ($request->hasFile('remaining_payment')) {
            // Store the uploaded file in the 'payment_proof' directory
            $paymentProofPath = $request->file('remaining_payment')->store('payment_proof', 'public');
            $namePaymentProof = $request->file('remaining_payment')->hashName();
        }
        $payment = Payments::find($request->payment_id);
        $payment->update([
            'payment_proof' => $namePaymentProof,
            'status' => 'pending',
        ]);
        return redirect()->route('user.payment', $request->code_order)->with('success', 'Payment Success');
    }

    // Portfolio
    public function portfolio()
    {
        $portfolio = Portfolio::all();
        return view('user.portfolio', compact('portfolio'));
    }

    public function portfolioDetail($id)
    {
        $portfolio = Portfolio::find($id);
        return view('user.portfolio-detail', compact('portfolio'));
    }

    public function addReview(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'review' => 'required',
            'nama_venue' => 'required',
        ]);
        if ($request->hasFile('image')) {
            // Store the uploaded file in the 'payment_proof' directory
            $imagePath = $request->file('image')->store('review_image', 'public');
            $nameImage = $request->file('image')->hashName();
        }
        // Remember
        Review::create([
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'image' => $nameImage,
            'review' => $request->review,
            'nama_venue' => $request->nama_venue,
            'status' => 'pending',
        ]);
        return redirect()->route('user.order')->with('success', 'Review Success');
    }


    // Review
    public function review()
    {
        $reviews = Review::where('status', 'approved')->get();
        return view('user.review', compact('reviews'));
    }
}
