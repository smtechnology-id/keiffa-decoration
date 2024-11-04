@extends('layouts.landing')

@section('content')
<div class="container-fluid mt-5 mb-5">
    {{-- banner --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('storage/portfolios/' . $portfolio->image) }}"
                    alt="First slide" style="max-height: 500px; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $portfolio->bride_name }} & {{ $portfolio->groom_name }}</h5>
                <p class="card-text text-center">{{ $portfolio->venue_name }}</p>
                <ul class="list-unstyled text-center">
                    <li>Package Name : {{ $portfolio->package_name }}</li>
                    <li>Total Price : Rp. {{ number_format($portfolio->total_price, 0, ',', '.') }}</li>
                    <li>Code Order : {{ $portfolio->code_order }}</li>
                    <li>Location : {{ $portfolio->location }}</li>
                </ul>
                <h5 class="card-title text-center">Total Price : Rp. {{ number_format($portfolio->total_price, 0, ',', '.') }}</h5>
            </div>
        </div>
    </div>

</div>
@endsection