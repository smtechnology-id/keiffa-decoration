@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    
   <div class="box d-flex justify-content-center align-items-center mb-5">
       <a href="{{ route('user.catalog') }}" class="btn btn-outline-primary mb-3 mr-3" style="background-color: transparent; border-color: #7E4752; color: #7E4752;">Paket Dekorasi Wedding</a>   
       <a href="{{ route('user.additional') }}" class="btn btn-outline-primary mb-3 ml-3" style="background-color: transparent; border-color: #7E4752; color: #7E4752;">Additional Dekorasi Wedding</a>   
   </div>
   <div class="row" data-aos="fade-up">
    @foreach ($packages as $package)
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex">
        <div class="gallery_content d-flex flex-column" style="border: none; height: 100%;">
            <figure class="contact-form-img">
                <img src="{{ asset('storage/packages/' . $package->image) }}" alt="" class="img-fluid" style="border-radius: 50px 0px 50px 0px; height: 350px; object-fit: cover;" width="100%">
            </figure>
            <div class="banner-btn discover-btn-banner text-center mt-3">
                <a href="" class="text-decoration-none">Rp. {{ number_format($package->harga, 0, ',', '.') }}</a>
            </div>
            <h5 class="text-center">{{ $package->nama }}</h5>
            <ul class="list-unstyled flex-grow-1">
                <div class="row">
                    <div class="col-md-6">
                        <li>Properti : {{ $package->properti }}</li>
                        <li>Jenis Bunga : {{ $package->jenis_bunga }}</li>
                        <li>Hand Bouquet : {{ $package->hand_bouquet }}</li>
                    </div>
                    <div class="col-md-6">
                        <li>Pilihan Dekorasi Pelaminan : {{ $package->dekorasi }}</li>
                        <li>Luas Dekorasi : {{ $package->luas_dekorasi }}</li>
                        <li>Meja Angpao : {{ $package->meja_angpao }}</li>
                        <li>Kotak Angpao : {{ $package->kotak_angpao }}</li>
                    </div>
                </div>
            </ul>
            <div class="banner-btn discover-btn-banner text-center mt-auto">
                <a href="{{ route('user.cart.add', ['slug' => $package->packageSlug]) }}" class="btn btn-primary text-decoration-none" style="background-color: #7E4752; color: #fff;">
                    <i class="fa fa-clipboard-list"></i> Tambahkan Ke Keranjang
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

</div>
@endsection
