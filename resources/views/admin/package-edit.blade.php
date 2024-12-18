@extends('layouts.app')

@section('active-package', 'active-page')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Package / Catalog</h5>
            <form action="{{ route('admin.package.updatePost') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" value="{{ $package->id }}">
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" value="{{ $package->image }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Package Name" required value="{{ $package->nama }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Package Price" required value="{{ $package->harga }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="properti">Properti</label>
                            <input type="text" name="properti" id="properti" class="form-control" placeholder="Package properti" required value="{{ $package->properti }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_bunga">Jenis Bunga</label>
                            <input type="text" name="jenis_bunga" id="jenis_bunga" class="form-control" placeholder="Package Flower Type" required value="{{ $package->jenis_bunga }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="hand_bouquet">Hand Bouquet</label>
                            <input type="text" name="hand_bouquet" id="hand_bouquet" class="form-control" placeholder="Hand Bouquet" required value="{{ $package->hand_bouquet }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="dekorasi">Pilihan Dekorasi Pelaminan</label>
                            <input type="text" name="dekorasi" id="dekorasi" class="form-control" placeholder="Pilihan Bunga" required value="{{ $package->dekorasi }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="luas_dekorasi">Luas Dekorasi Pelaminan</label>
                            <input type="text" name="luas_dekorasi" id="luas_dekorasi" class="form-control" placeholder="Luas Dekorasi Pelaminan" required value="{{ $package->luas_dekorasi }}">
                        </div>
                        <div class="form-group mb-3 ">
                            <label for="meja_angpao">Meja Angpao</label>
                            <input type="number" name="meja_angpao" id="meja_angpao" class="form-control" placeholder="Meja Angpao" required value="{{ $package->meja_angpao }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="kotak_angpao">Kotak Angpao</label>
                            <input type="number" name="kotak_angpao" id="kotak_angpao" class="form-control" placeholder="Kotak Angpao" required value="{{ $package->kotak_angpao }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi">{{ $package->deskripsi }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border-color: #fff;">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
