@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="gallery_content">
                    <figure class="contact-form-img">
                        <img src="{{ asset('assets-landing/images/gallery-img4.png') }}" alt="" class="img-fluid">
                    </figure>
                    <div class="banner-btn discover-btn-banner">
                        <a href="about.html" class="text-decoration-none">19/03/2022</a>
                    </div>
                    <h4>Jose and Clarence</h4>
                    <p>Scottsdale, Arizona</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="gallery_content gallery_content-mb gallery-bottom">
                    <figure class="contact-form-img">
                        <img src="{{ asset('assets-landing/images/gallery-img5.png') }}" alt="" class="img-fluid">
                    </figure>
                    <div class="banner-btn discover-btn-banner">
                        <a href="about.html" class="text-decoration-none">09/02/2022</a>
                    </div>
                    <h4>Gilbert and William</h4>
                    <p>Scottsdale, Arizona</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="gallery_content gallery_content-mb">
                    <figure class="contact-form-img">
                        <img src="{{ asset('assets-landing/images/gallery-img6.png') }}" alt="" class="img-fluid">
                    </figure>
                    <div class="banner-btn discover-btn-banner">
                        <a href="about.html" class="text-decoration-none">17/04/2032</a>
                    </div>
                    <h4>Alberta and Ryan</h4>
                    <p>Scottsdale, Arizona</p>
                </div>
            </div>
        </div>
    </div>
@endsection
