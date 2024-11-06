@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    <h5 class="text-left mb-3">Riwayat Pemesanan</h5>

    @foreach ($orders as $order)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $order->code_order }} - {{ $order->created_at->format('d M Y') }} (
                @if ($order->status_pembayaran == 'dp')
                <span class="badge badge-warning">Down Payment</span>
                @elseif ($order->status_pembayaran == 'full')
                <span class="badge badge-success">Full Payment</span>
                @elseif ($order->status_pembayaran == 'done')
                <span class="badge badge-info">Done</span>
                @endif
                )
            </h5>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li>{{ $order->bride_name }} & {{ $order->groom_name }}</li>
                        <li>Wedding Date: {{ \Carbon\Carbon::parse($order->wedding_date)->format('d M Y') }}</li>
                        <li>Total Price: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</li>
                    </ul>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <a href="{{ route('user.payment', $order->code_order) }}" class="btn btn-primary"
                        style="background-color: #7E4752; border: none;">Detail</a>
                    @if ($order->status == 'pending')
                    <a href="{{ route('user.payment.remaining', $order->code_order) }}" class="btn btn-primary"
                        style="background-color: #7E4752; border: none;">Remaining Payment</a>
                    @endif
                    @if ($order->status_pembayaran == 'full' || $order->status_pembayaran == 'done')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary ml-2" style="background-color: #636F54; border: none;" data-toggle="modal"
                        data-target="#addReviewModal{{ $order->id }}">
                        Review
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addReviewModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="addReviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user.add-review') }}" method="post"
                                    enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addReviewModalLabel">Review</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <div class="form-group">
                                            <label for="image">Foto Venue</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_venue">Nama Venue</label>
                                            <input type="text" name="nama_venue" id="nama_venue" class="form-control" required placeholder="Nama Venue">
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review</label>
                                            <textarea name="review" id="review" class="form-control" required placeholder="Review"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border: none;">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @endsection