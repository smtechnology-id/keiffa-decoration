@extends('layouts.landing')

@section('content')
            <!-- BANNER-SECTION -->
            <div class="home-banner-section overflow-hidden position-relative">
                <figure class="banner-img1 mb-0">
                    <img src="{{ asset('assets-landing/images/banner-img1.png') }}" alt="" class="star">
                </figure>
                <figure class="banner-img2 mb-0">
                    <img src="{{ asset('assets-landing/images/banner-img2.png') }}" alt="" class="star">
                </figure>
                <div class="banner-container-box">
                    <div class="container">
                        <div class="row">
                            <div
                                class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-md-0 mb-4 text-md-left text-center order-lg-1 order-2">
    
                                <div class="banner-img-content position-relative">
                                    <figure class="banner-img mb-0">
                                        <img class="img-fluid banner-img-width"
                                            src="{{ asset('assets-landing/images/bridely-banner-left-img.png') }}"
                                            alt="">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 order-lg-2 order-1">
                                <div class="home-banner-text position-relative" data-aos="fade-up" id="myContentDIV">
                                    <figure class="ring-icon-img mb-0">
                                        <img src="{{ asset('assets-landing/images/ring-icon-banner.png') }}"
                                            alt="">
                                    </figure>
                                    <h1>Keiffa Decoration <span class="h1-text">Made Easy!</span></h1>
                                    <p class="banner-paragraph">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit sed doeiusm tempor incididunt
                                    </p>
                                    <div class="banner-btn discover-btn-banner">
                                        <a href="about.html" class="text-decoration-none"><i
                                                class="fa fa-clipboard-list"></i>Make Reservations</a>
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
                                <h5 class="autorix-text"><span>About
                                        Bridely</span></h5>
                                <h2>What We do, We do With Passion</h2>
                                <p class="aboutus-p">Lorem ipsum dolor sit
                                    amet consectetur adipiscing elit sed doeiusm tempor incididunt </p>
                                <div class="banner-btn discover-btn-banner">
                                    <a href="about.html" class="text-decoration-none">learn more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 order-lg-2 order-2">
                            <div class="about-content-img">
                                <figure class="mb-0 about-section-f1"><img
                                        src="{{ asset('assets-landing/images/about-bird-icon.png') }}" alt=""
                                        class="star">
                                </figure>
                                <figure class="mb-0 about-section-f2"><img
                                        src="{{ asset('assets-landing/images/about-img1.png') }}" alt="">
                                </figure>
                                <figure class="mb-0 about-section-f3"><img
                                        src="{{ asset('assets-landing/images/about-img2.png') }}" alt="">
                                </figure>
                                <figure class="mb-0 about-section-f4"><img
                                        src="{{ asset('assets-landing/images/about-img3.png') }}" alt="">
                                </figure>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="video-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="video-section-conten" data-aos="fade-up">
                                <figure class="mb-0 video-section-image">
                                    <img src="{{ asset('assets-landing/images/video-img.png') }}" alt=""
                                        class="fluid-img">
                                </figure>
                                <a class="popup-vimeo"
                                    href="https://previews.customer.envatousercontent.com/h264-video-previews/5afc8770-eb05-42ec-b854-9fb6b3bb52c5/40068661.mp4">
                                    <figure class="mb-0 vide-play-img">
                                        <img src="{{ asset('assets-landing/images/video-play-icon.png') }}"
                                            alt="" class="fluid-img">
                                    </figure>
                                </a>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
            <section class="insta-feed-section">
    
                <div class="container">
    
                    <h2>Paket Kami</h2>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <figure class="mb-0 insta-section-imgs">
                                <img src="{{ asset('assets-landing/images/insta-section-img1.png') }}" alt=""
                                    class="img-fluid">
                                <div class="hover_box_plus">
                                    <a href="#"><i class="fa-brands fa-instagram"></i>Bridely</a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <figure class="mb-0 insta-section-imgs">
                                <img src="{{ asset('assets-landing/images/insta-section-img2.png') }}" alt=""
                                    class="img-fluid">
                                <div class="hover_box_plus">
                                    <a href="#"><i class="fa-brands fa-instagram"></i>Bridely</a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <figure class="mb-0 insta-section-imgs insta-section-imgs-mb">
                                <img src="{{ asset('assets-landing/images/insta-section-img3.png') }}" alt=""
                                    class="img-fluid">
                                <div class="hover_box_plus">
                                    <a href="#"><i class="fa-brands fa-instagram"></i>Bridely</a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <figure class="mb-0 insta-section-imgs insta-section-imgs-mb">
                                <img src="{{ asset('assets-landing/images/insta-section-img4.png') }}" alt=""
                                    class="img-fluid">
                                <div class="hover_box_plus">
                                    <a href="#"><i class="fa-brands fa-instagram"></i>Bridely</a>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </section>
@endsection
