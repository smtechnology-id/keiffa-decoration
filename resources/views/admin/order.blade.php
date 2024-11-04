@extends('layouts.app')

@section('active-order', 'active-page')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Order Kaiffa Decoration</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="datatable1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Status Pembayaran</th>
                                <th>Customer</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->code_order }}</td>
                                    <td>
                                        @if ($order->status_pembayaran == 'dp')
                                            <span class="badge badge-warning">Down Payment</span>
                                        @elseif($order->status_pembayaran == 'full')
                                            <span class="badge badge-success">Full Payment</span>
                                        @elseif($order->status_pembayaran == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.order.detail', $order->code_order) }}" class="btn btn-primary" style="background-color: #7E4752; border: none;">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
