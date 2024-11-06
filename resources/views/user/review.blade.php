@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    <h5 class="text-center">Review</h5>

    <div class="row">
        @foreach ($reviews as $review)
            <div class="col-md-6">
                    <div class="card" style="border: none;">
                        <img class="card-img-top" src="{{ asset('storage/review_image/' . $review->image) }}" alt="Card image cap" style="border-radius: 20px 0px 20px 0px;">
                        <div class="card-body text-center">
                        <p class="card-text" style="font-size: 14px; font-style: italic;" >"{{ $review->review }}"</p>
                        <h5 class="card-title">{{ $review->nama_venue }}</h5>
                        <label class="badge badge-primary" style="background-color: #7E4752; border: none;">{{ $review->user->name }}</label>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
</div>
@endsection