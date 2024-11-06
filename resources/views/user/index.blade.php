@extends('layouts.landing')

@section('content')
<!-- BANNER-SECTION -->
<div class="home-banner-section overflow-hidden position-relative">
    <div class="banner-container-box">
        <div class="container">
            <div class="row">
                <div
                    class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-md-0 mb-4 text-md-left text-center order-lg-1 order-2">

                    <div class="banner-img-content position-relative">
                        <figure class="banner-img mb-0">
                            <img class="img-fluid banner-img-width"
                                src="{{ asset('assets-landing/images/foto/1.jpeg') }}" alt="" style="border-radius: 20px 0px 20px 0px; width: 475px; height: 530px; object-fit: cover;">
                        </figure>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 order-lg-2 order-1">
                    <div class="home-banner-text position-relative" data-aos="fade-up" id="myContentDIV">
                        <figure class="ring-icon-img mb-0">
                            <img src="{{ asset('assets-landing/images/ring-icon-banner.png') }}" alt="">
                        </figure>
                        <h1>Keiffa Decoration <span class="h1-text">Made Easy!</span></h1>
                        <p class="banner-paragraph">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit sed doeiusm tempor incididunt
                        </p>
                        <div class="banner-btn discover-btn-banner">
                            <a href="about.html" class="text-decoration-none"><i class="fa fa-clipboard-list"></i>Make
                                Reservations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About-us-section -->
<div class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 order-lg-1 order-1">
                <div class="about-us-content aos-init aos-animate" data-aos="fade-up">
                    <h5 class="autorix-text"><span>Tentang
                            Keiffa Decoration</span></h5>
                    <h2>Apa yang Kami Lakukan, Kami Lakukan Dengan Semangat</h2>
                    <p class="aboutus-p">Kami selalu berusaha memberikan yang terbaik untuk Anda</p>
                    <div class="banner-btn discover-btn-banner">
                        <a href="{{ route('user.catalog') }}" class="text-decoration-none">Lihat Paket</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 order-lg-2 order-2">
                <div class="about-content-img">
                    <figure class="mb-0 about-section-f1"><img
                            src="{{ asset('assets-landing/images/about-bird-icon.png') }}" alt="" class="star">
                    </figure>
                    <figure class="mb-0 about-section-f2"><img src="{{ asset('assets-landing/images/foto/1.jpeg') }}"
                            alt="" style="border-radius: 20px 0px 20px 0px; width: 100%; height: 300px; object-fit: cover;">
                    </figure>

                    <figure class="mb-0 about-section-f4"><img src="{{ asset('assets-landing/images/foto/3.jpeg') }}"
                            alt="" style="border-radius: 20px 0px 20px 0px; width: 100%; height: 100px; object-fit: cover;">
                    </figure>
                </div>
            </div>

        </div>
    </div>
</div>
<section class="insta-feed-section pt-5 pb-5">

    <div class="container">

        <h2>Paket Kami</h2>
        <div class="row">
            @foreach ($packages as $package)
            <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <figure class="mb-0 insta-section-imgs">
                    <img src="{{ asset('storage/packages/' . $package->image) }}" alt="" class="img-fluid"
                        style="border-radius: 20px 0px 20px 0px; height: 300px; object-fit: cover;">
                </figure>
                <label for="" class="badge badge-primary text-center"
                    style="background-color: #7E4752; border: none;">Rp. {{ number_format($package->harga, 0, ',', '.')
                    }}</label>
                <h5 class="text-center"> <a href="{{ route('user.catalog') }}" class="text-decoration-none">{{
                        $package->nama }}</a></h5>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection