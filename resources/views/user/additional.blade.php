@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    
   <div class="box d-flex justify-content-center align-items-center mb-5">
    <a href="{{ route('user.catalog') }}" class="btn btn-outline-primary mb-3 mr-3" style="background-color: transparent; border-color: #7E4752; color: #7E4752;">Paket Dekorasi Wedding</a>   
    <a href="{{ route('user.additional') }}" class="btn btn-outline-primary mb-3 ml-3" style="background-color: transparent; border-color: #7E4752; color: #7E4752;">Additional Dekorasi Wedding</a>  
   </div>
    <div class="row" data-aos="fade-up">
        @foreach ($additional as $additional)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <div class="gallery_content">
                <figure class="contact-form-img">
                    <img src="{{ asset('storage/additional/' . $additional->image) }}" alt="" class="img-fluid" style="border-radius: 50px 0px 50px 0px;" width="100%">
                </figure>
                <div class="banner-btn discover-btn-banner">
                    <a href="" class="text-decoration-none">Rp. {{ number_format($additional->harga, 0, ',', '.') }}</a>
                </div>
                <h5 class="text-center">{{ $additional->nama }}</h5>
                <ul class="list-unstyled">
                    <div class="row">
                        <div class="col-md-6">
                            
                        <div class="col-md-6">
                            <li>Deskripsi : {{ $additional->deskripsi }}</li>
                        </div>
                    </div>
                </ul>
                <div class="banner-btn discover-btn-banner text-center">
                    <a href="{{ route('user.cart.add', ['slug' => $additional->slug]) }}" class="btn btn-primary text-decoration-none" style="background-color: #7E4752; color: #fff;"><i class="fa fa-clipboard-list"></i> Tambahkan Ke Keranjang</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
