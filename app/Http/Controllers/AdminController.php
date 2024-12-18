<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Review;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Payments;
use App\Models\Portfolio;
use App\Models\Additional;
use Illuminate\Support\Str;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function package()
    {
        $packages = Package::all();
        return view('admin.package', compact('packages'));
    }

    public function packageCreate()
    {
        return view('admin.package-create');
    }

    public function packageCreatePost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'nama' => 'required',
            'harga' => 'required',
            'properti' => 'required',
            'jenis_bunga' => 'required',
            'hand_bouquet' => 'required',
            'luas_dekorasi' => 'required',
            'dekorasi' => 'required',
            'meja_angpao' => 'required',
            'kotak_angpao' => 'required',
            'deskripsi' => 'nullable',
        ]);
        // Set Text validasi ke bahasa indonesia
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ], [
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg, png, jpg, gif, atau svg',
            'image.max' => 'Gambar maksimal 10MB',
        ]);

        // Simpan gambar
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/packages', $imageName);


        $packageSlug = 'package-' . Str::slug($request->nama);
        $package = Package::create([
            'image' => $imageName,
            'nama' => $request->nama,
            'packageSlug' => $packageSlug,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'properti' => $request->properti,
            'jenis_bunga' => $request->jenis_bunga,
            'hand_bouquet' => $request->hand_bouquet,
            'luas_dekorasi' => $request->luas_dekorasi,
            'dekorasi' => $request->dekorasi,
            'meja_angpao' => $request->meja_angpao,
            'kotak_angpao' => $request->kotak_angpao,
        ]);
        return redirect()->route('admin.package')->with('success', 'Package created successfully');
    }

    public function packageEdit($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        return view('admin.package-edit', compact('package'));
    }

    public function packageUpdatePost(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'nama' => 'required',
            'harga' => 'required',
            'properti' => 'required',
            'jenis_bunga' => 'required',
            'hand_bouquet' => 'required',
            'luas_dekorasi' => 'required',
            'dekorasi' => 'required',
            'meja_angpao' => 'required',
            'kotak_angpao' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $package = Package::find($request->id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/packages', $imageName);
        }
        $packageSlug = 'package-' . Str::slug($request->nama);
        $package->update([
            'image' => $request->hasFile('image') ? $imageName : $package->image,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'properti' => $request->properti,
            'packageSlug' => $packageSlug,
            'jenis_bunga' => $request->jenis_bunga,
            'hand_bouquet' => $request->hand_bouquet,
            'luas_dekorasi' => $request->luas_dekorasi,
            'dekorasi' => $request->dekorasi,
            'meja_angpao' => $request->meja_angpao,
            'kotak_angpao' => $request->kotak_angpao,
        ]);
        return redirect()->route('admin.package')->with('success', 'Package updated successfully');
    }

    public function packageDelete($slug)
    {
        $package = Package::where('packageSlug', $slug)->first();
        $package->delete();
        return redirect()->route('admin.package')->with('success', 'Package deleted successfully');
    }

    public function additional()
    {
        $additionals = Additional::all();
        return view('admin.additional', compact('additionals'));
    }
    public function additionalCreate()
    {
        $additionals = Additional::all();
        // Tentukan Additional Number format 0001, 0002, 0003, dst
        $lastAdditionalNumber = $additionals->isEmpty() ? 0 : $additionals->last()->additional_number;
        $additionalNumber = sprintf('%04d', $lastAdditionalNumber + 1);
        return view('admin.additional-create', compact('additionalNumber'));
    }

    public function additionalCreatePost(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'additional_number' => 'required',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/additional', $imageName);

        $slug = 'additional-' . Str::slug($request->nama);

        $additional = Additional::create([
            'image' => $imageName,
            'nama' => $request->nama,
            'slug' => $slug,
            'additional_number' => $request->additional_number,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('admin.additional')->with('success', 'Additional created successfully');
    }

    public function additionalEdit($slug)
    {
        $additional = Additional::where('slug', $slug)->first();
        return view('admin.additional-edit', compact('additional'));
    }

    public function additionalUpdatePost(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'additional_number' => 'required',
            'harga' => 'required',
            'deskripsi' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/additional', $imageName);
            $fileName = $request->image->hashName();
        } else {
            $fileName = $request->oldImage;
        }
        $additional = Additional::find($request->id);
        $slug = 'additional-' . Str::slug($request->nama);
        $additional->update([
            'nama' => $request->nama,
            'additional_number' => $request->additional_number,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'image' => $request->hasFile('image') ? $imageName : $additional->image,
            'slug' => $slug,
        ]);
        return redirect()->route('admin.additional')->with('success', 'Additional updated successfully');
    }

    public function additionalDelete($slug)
    {
        $additional = Additional::where('slug', $slug)->first();
        $additional->delete();
        return redirect()->route('admin.additional')->with('success', 'Additional deleted successfully');
    }


    // Review
    public function review()
    {
        $reviews = Review::all();
        return view('admin.review', compact('reviews'));
    }


    // Order
    public function order()
    {
        $orders = Orders::all();
        return view('admin.order', compact('orders'));
    }

    public function orderDetail($code_order)
    {
        $order = Orders::where('code_order', $code_order)->first();
        $package = ProductOrder::where('order_id', $order->id)->where('jenis', 'package')->get();
        $additional = ProductOrder::where('order_id', $order->id)->where('jenis', 'additional')->get();
        $downPayment = Payments::where('order_id', $order->id)->where('jenis', 'down-payment')->first();
        $fullPayment = Payments::where('order_id', $order->id)->where('jenis', 'remaining-payment')->first();
        return view('admin.order-detail', compact('order', 'package', 'additional', 'downPayment', 'fullPayment'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
            'nominal' => 'required',
            'notes' => 'nullable',
        ]);

        $payment = Payments::find($request->id);
        $payment->update(['status' => $request->status, 'notes' => $request->notes]);
        $payment->update(['nominal' => $request->nominal]);

        if ($request->status == 'confirmed') {
            $order = Orders::find($payment->order_id);
            $order->payment_total = $order->payment_total + $request->nominal;
            if ($order->payment_total >= $order->total_price) {
                $order->status_pembayaran = 'full';
            } elseif ($order->payment_total < $order->total_price) {
                $order->status_pembayaran = 'dp';
            }
            $order->save();
        }

        return redirect()->back()->with('success', 'Payment status updated successfully');
    }

    public function rejectPayment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
            'notes' => 'nullable',
        ]);
        $payment = Payments::find($request->id);
        $payment->update(['status' => $request->status, 'notes' => $request->notes]);
        return redirect()->back()->with('success', 'Payment status updated successfully');
    }


    // Portfolio
    public function portfolio()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolio', compact('portfolios'));
    }

    public function portfolioCreate()
    {
        $orders = Orders::all();    
        return view('admin.portfolio-create', compact('orders'));
    }

    public function portfolioCreatePost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'package_name' => 'required',
            'venue_name' => 'required',
            'bride_name' => 'required',
            'groom_name' => 'required',
            'total_price' => 'required',
            'code_order' => 'required',
            'location' => 'required',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/portfolios', $imageName);

        $portfolio = Portfolio::create([
            'image' => $imageName,
            'package_name' => $request->package_name,
            'venue_name' => $request->venue_name,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'total_price' => $request->total_price,
            'code_order' => $request->code_order,
            'location' => $request->location,
        ]);
        return redirect()->route('admin.portfolio')->with('success', 'Portfolio created successfully');
    }

    public function portfolioEdit($id)
    {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio-edit', compact('portfolio'));
    }

    public function portfolioUpdatePost(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'package_name' => 'required',
            'venue_name' => 'required',
            'bride_name' => 'required',
            'groom_name' => 'required',
            'total_price' => 'required',
            'code_order' => 'required',
            'location' => 'required',
        ]);

        $portfolio = Portfolio::find($request->id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/portfolios', $imageName);
        }
        $portfolio->update([
            'image' => $request->hasFile('image') ? $imageName : $portfolio->image,
            'package_name' => $request->package_name,
            'venue_name' => $request->venue_name,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'total_price' => $request->total_price,
            'code_order' => $request->code_order,
            'location' => $request->location,
        ]);
        return redirect()->route('admin.portfolio')->with('success', 'Portfolio updated successfully');
    }

    public function portfolioDelete($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->delete();
        return redirect()->route('admin.portfolio')->with('success', 'Portfolio deleted successfully');
    }
    // approve review
    public function reviewApprove($id)
    {
        $review = Review::find($id);
        $review->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Review approved successfully');
    }
    public function reviewReject($id)
    {
        $review = Review::find($id);
        $review->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Review rejected successfully');
    }

    // User
    public function user()
    {
        $users = User::where('level', 'user')->get();
        return view('admin.user', compact('users'));
    }

    public function userUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8',
        ]);
        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }
}
