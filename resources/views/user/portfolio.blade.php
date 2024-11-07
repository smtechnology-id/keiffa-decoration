@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    
    <div class="row" data-aos="fade-up">
        @foreach ($portfolio as $portfolio)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 p-3" style="background-color: #fff; border-radius: 20px;">
            <div class="gallery_content">
                <figure class="contact-form-img">
                    <img src="{{ asset('storage/portfolios/' . $portfolio->image) }}" alt="" class="img-fluid" style="border-radius: 50px 0px 50px 0px; height: 350px; object-fit: cover;" width="100%">
                </figure>
                <div class="banner-btn discover-btn-banner">
                </div>
                <h5 class="text-center">{{ $portfolio->package_name }}</h5>
                <p class="text-center">Rp. {{ number_format($portfolio->total_price, 0, ',', '.') }}</p>   
               
                <div class="box d-flex justify-content-center align-items-center flex-column">
                    <h5>{{ $portfolio->bride_name }} & {{ $portfolio->groom_name }}</h5>
                    <p>{{ $portfolio->venue_name }}</p>
                </div>
                
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
