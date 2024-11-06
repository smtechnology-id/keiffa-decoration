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
                                        <td>Rp. {{ number_format($item->package->harga, 0, ',', '.') }}</td>
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
                                        <a href="{{ asset('storage/payment_proof/' . $downPayment->payment_proof) }}"
                                            target="_blank">View Payment Proof</a>
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
                                        <a href="{{ asset('storage/payment_proof/' . $fullPayment->payment_proof) }}"
                                            target="_blank">View Payment Proof</a>
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
                        <table class="table">
                            <tr>
                                <th>Total Terbayar</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->payment_total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Sisa Pembayaran</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->total_price - $order->payment_total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Down Payment</th>
                                <td>:</td>
                                <td>
                                    @if ($downPayment)
                                        @if ($downPayment->status == 'pending')
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#dpModal">
                                                Konfirmasi DP
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="dpModal" tabindex="-1"
                                                aria-labelledby="dpModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.confirm-payment') }}" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="dpModalLabel">Konfirmasi DP</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                {{-- Input Nominal DP --}}
                                                                <input type="hidden" name="id"
                                                                    value="{{ $downPayment->id }}">
                                                                <input type="hidden" name="status" value="confirmed">
                                                                <div class="form-group">
                                                                    <label for="nominal">Nominal DP</label>
                                                                    <input type="number" name="nominal"
                                                                        class="form-control" id="nominal"
                                                                        placeholder="Masukkan Nominal DP" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Konfirmasi
                                                                    DP</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($downPayment->status == 'confirmed')
                                            <label for="" class="badge badge-success">Down Payment
                                                Terkonfirmasi</label>
                                        @endif
                                    @else
                                        <label for="" class="badge badge-danger">Down Payment Belum Dibayar</label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Remaining Payment</th>
                                <td>:</td>
                                <td>
                                    @if ($fullPayment)
                                        @if ($fullPayment->status == 'pending')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#rpModal">
                                                Konfirmasi Sisa Pembayaran
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="rpModal" tabindex="-1"
                                                aria-labelledby="rpModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.confirm-payment') }}" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rpModalLabel">Konfirmasi
                                                                    Sisa Pembayaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                {{-- Input Nominal DP --}}
                                                                <input type="hidden" name="id"
                                                                    value="{{ $fullPayment->id }}">
                                                                <input type="hidden" name="status" value="confirmed">
                                                                <div class="form-group">
                                                                    <label for="nominal">Nominal Sisa
                                                                        Pembayaran</label>
                                                                    <input type="number" name="nominal"
                                                                        class="form-control" id="nominal"
                                                                        placeholder="Masukkan Nominal Sisa Pembayaran"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Konfirmasi
                                                                    DP</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <label for="" class="badge badge-success">Remaining Payment
                                                Terkonfirmasi</label>
                                        @endif
                                    @else
                                        <label for="" class="badge badge-danger">Remaining Payment Belum
                                            Dibayar</label>
                                    @endif
                                </td>
                            </tr>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
