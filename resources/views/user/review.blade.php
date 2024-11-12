@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    <h5 class="text-center">Review</h5>

    <div class="row d-flex align-items-stretch">
        @foreach ($reviews as $review)
            <div class="col-md-6 d-flex">
                <div class="card d-flex flex-column" style="border: none; height: 100%;">
                    <img class="card-img-top" src="{{ asset('storage/review_image/' . $review->image) }}" alt="Card image cap" style="border-radius: 20px 0px 20px 0px; height: 350px; object-fit: cover;">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <p class="card-text" style="font-size: 14px; font-style: italic;">"{{ $review->review }}"</p>
                        <div>
                            <h5 class="card-title">{{ $review->nama_venue }}</h5>
                            <label class="badge badge-primary" style="background-color: #7E4752; border: none;">{{ $review->user->name }}</label>
                            <br>
                            <label class="badge badge-success" style="background-color: #636F54; border: none;">{{ $review->order->code_order }}</label>
                            <br>
                            <p>{{ $review->order->bride_name }} & {{ $review->order->groom_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
@endsection