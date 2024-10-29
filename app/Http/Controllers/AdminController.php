<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Additional;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

       $packageSlug = Str::slug($request->nama);
       $package = Package::create([
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
        $package->update([
            'nama' => $request->nama,
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

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/additional', $imageName);

        $slug = Str::slug($request->nama);

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
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/additional', $imageName);
            $fileName = $request->image->hashName();
        } else {
            $fileName = $request->oldImage;
        }
        $additional = Additional::find($request->id);
        $additional->update([
            'nama' => $request->nama,
            'additional_number' => $request->additional_number,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'image' => $imageName,
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
        return view('admin.review');
    }


    // Order
    public function order()
    {
        return view('admin.order');
    }
}
