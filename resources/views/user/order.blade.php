@extends('layouts.landing')

@section('content')
    <div class="container mt-5 mb-5">
        <h5 class="text-left mb-3">Riwayat Pemesanan</h5>

        @foreach ($orders as $order)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->code_order }} - {{ $order->created_at->format('d M Y') }}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li>{{ $order->bride_name }} & {{ $order->groom_name }}</li>
                                <li>Wedding Date: {{ \Carbon\Carbon::parse($order->wedding_date)->format('d M Y') }}</li>
                                <li>Total Price: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <a href="{{ route('user.payment', $order->code_order) }}" class="btn btn-primary" style="background-color: #7E4752; border: none;">Detail</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>
@endsection
