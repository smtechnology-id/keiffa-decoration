@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="card">
        <div class="card-body">
            <h1>Detail Order</h1>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                       <thead>
                        <tr class="text-white" style="background-color: #7E4752;">
                            <th class="text-white">Order ID</th>
                            <th class="text-white">Payment Status</th>
                            <th class="text-white">Customer</th>
                            <th class="text-white">Total Price</th>
                        </tr>
                       </thead>
                       <tbody>
                        <tr>
                            <td>{{ $order->code_order }}</td>
                            <td>
                                @if ($order->status_pembayaran == 'dp')
                                    <span class="badge badge-warning">Down Payment</span>
                                @elseif($order->status_pembayaran == 'full')
                                    <span class="badge badge-success">Full Payment</span>
                                @endif
                            </td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                       </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <h3>Product Order</h3>
                    <table class="table">
                        <thead>
                            <tr class="text-white" style="background-color: #7E4752;">
                                <th class="text-white">Product</th>
                                <th class="text-white">Price</th>
                                <th class="text-white">Qty</th>
                                <th class="text-white">Total</th>
                            </tr>   
                        </thead>
                        <tbody>
                            @foreach ($package as $item)
                                <tr>
                                    <td>{{ $item->package->nama }}</td>
                                    <td>Rp. {{ number_format($item->package->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            @foreach ($additional as $item)
                                <tr>
                                    <td>{{ $item->additional->nama }}</td>
                                    <td>Rp. {{ number_format($item->additional->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Total</td>
                                <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Detail Order</h3>
                    <table class="table">
                        <tr>
                            <th>Bride Name</th>
                            <td>:</td>
                            <td>{{ $order->bride_name }}</td>
                        </tr>
                        <tr>
                            <th>Groom Name</th>
                            <td>:</td>
                            <td>{{ $order->groom_name }}</td>
                        </tr>
                        <tr>
                            <th>Wedding Date</th>
                            <td>:</td>
                            <td>{{ $order->wedding_date }}</td>
                        </tr>
                        <tr>
                            <th>Wedding Location</th>
                            <td>:</td>
                            <td>{{ $order->wedding_location }}</td>
                        </tr>
                        <tr>
                            <th>Wedding Theme</th>
                            <td>:</td>
                            <td>{{ $order->wedding_theme }}</td>
                        </tr>
                        <tr>
                            <th>Bukti Pembayaran DP</th>
                            <td>:</td>
                            <td>
                                @if ($downPayment)
                                   <a href="{{ asset('storage/payment_proof/' . $downPayment->payment_proof) }}" target="_blank">View Payment Proof</a>
                                   @if ($downPayment->status == 'pending')
                                     <span class="badge badge-warning">Perlu Konfirmasi</span>
                                   @elseif($downPayment->status == 'confirmed')
                                     <span class="badge badge-success">Pembayaran Valid</span>
                                   @endif
                                @else
                                    <span class="badge badge-danger">Unsubmitted</span>
                                @endif
                            </td>
                        </tr>   
                        <tr>
                            <th>Bukti Pembayaran Remaining Payment</th>
                            <td>:</td>
                            <td>
                                @if ($fullPayment)
                                   <a href="{{ asset('storage/payment_proof/' . $fullPayment->payment_proof) }}" target="_blank">View Payment Proof</a>
                                   @if ($fullPayment->status == 'pending')
                                     <span class="badge badge-warning">Perlu Konfirmasi</span>
                                   @elseif($fullPayment->status == 'confirmed')
                                     <span class="badge badge-success">Pembayaran Valid</span>
                                   @endif
                                @else
                                    <span class="badge badge-danger">Unsubmitted</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center flex-column">
                    <h5 class="text-left mb-3">Manage Payment Status</h5>
                    <a href="{{ route('admin.confirm-payment', ['id' => $downPayment->id, 'status' => 'confirmed']) }}" class="btn btn-success mb-2" style="background-color: #7E4752; border: none;">Konfirmasi DP</a>
                    <a href="{{ route('admin.confirm-payment', ['id' => $fullPayment->id, 'status' => 'confirmed']) }}" class="btn btn-success mb-2" style="background-color: #7E4752; border: none;">Konfirmasi Remaining Payment</a>
                </div>
            </div>
        </div>
       </div>
    </div>
@endsection
