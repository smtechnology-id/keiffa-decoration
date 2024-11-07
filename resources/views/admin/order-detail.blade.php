@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Detail Pesanan</h1>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr class="text-white" style="background-color: #7E4752;">
                                    <th class="text-white">Kode Pesanan</th>
                                    <th class="text-white">Status Pembayaran</th>
                                    <th class="text-white">Customer</th>
                                    <th class="text-white">Total Harga</th>
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
                        <h3>Detail Produk Pesanan</h3>
                        <table class="table">
                            <thead>
                                <tr class="text-white" style="background-color: #7E4752;">
                                    <th class="text-white">Produk</th>
                                    <th class="text-white">Harga</th>
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
                                <th>Nama Pengantin Wanita</th>
                                <td>:</td>
                                <td>{{ $order->bride_name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pengantin Pria</th>
                                <td>:</td>
                                <td>{{ $order->groom_name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pernikahan</th>
                                <td>:</td>
                                <td>{{ $order->wedding_date }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi Pernikahan</th>
                                <td>:</td>
                                <td>{{ $order->wedding_location }}</td>
                            </tr>
                            <tr>
                                <th>Tema Pernikahan</th>
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
                                <th>Total Harga</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Nominal Down Payment</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->total_price * 0.3, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Nominal Sisa Pembayaran</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->total_price * 0.7, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Terbayar Oleh Customer</th>
                                <td>:</td>
                                <td>Rp. {{ number_format($order->payment_total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tagihan Sisa Pembayaran</th>
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
                                            <button type="button" class="btn btn-primary mt-2"
                                                style="background-color: #7E4752; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#dpModal">
                                                Konfirmasi DP
                                            </button>
                                            <button type="button" class="btn btn-danger mt-2"
                                                style="background-color: #636F54; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#rejectDpModal">
                                                Reject
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
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="background-color: #7E4752; border: none;">Konfirmasi
                                                                    DP</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="rejectDpModal" tabindex="-1"
                                                aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.reject-payment') }}" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectDpModal">Reject
                                                                    Sisa Pembayaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                {{-- Input Nominal DP --}}
                                                                <input type="hidden" name="id"
                                                                    value="{{ $downPayment->id }}">
                                                                <input type="hidden" name="status" value="rejected">
                                                                <p>Apakah anda yakin ingin menolak pembayaran ini?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="background-color: #636F54; border: none;">Reject</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($downPayment->status == 'confirmed')
                                            <label for="" class="badge badge-success">Down Payment
                                                Terkonfirmasi</label>
                                        @elseif($downPayment->status == 'rejected')
                                            <label for="" class="badge badge-danger">Down Payment Ditolak</label>
                                        @endif
                                    @else
                                        <label for="" class="badge badge-danger">Down Payment Belum
                                            Dibayar</label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Remaining Payment</th>
                                <td>:</td>
                                <td>
                                    @if ($fullPayment)
                                        @if ($fullPayment->status == 'pending')
                                            <button type="button" class="btn btn-primary mt-2"
                                                style="background-color: #7E4752; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#rpModal">
                                                Konfirmasi Pelunasan
                                            </button>
                                            <button type="button" class="btn btn-danger mt-2"
                                                style="background-color: #636F54; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal">
                                                Reject
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="rpModal" tabindex="-1"
                                                aria-labelledby="rpModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.confirm-payment') }}"
                                                            method="POST">
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
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="background-color: #7E4752; border: none;">Konfirmasi
                                                                    DP</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="rejectModal" tabindex="-1"
                                                aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.reject-payment') }}"
                                                            method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectModalLabel">Reject
                                                                    Sisa Pembayaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                {{-- Input Nominal DP --}}
                                                                <input type="hidden" name="id"
                                                                    value="{{ $fullPayment->id }}">
                                                                <input type="hidden" name="status" value="rejected">
                                                                <p>Apakah anda yakin ingin menolak pembayaran ini?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="background-color: #636F54; border: none;">Reject</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($fullPayment->status == 'confirmed')
                                            <label for="" class="badge badge-success">Remaining Payment
                                                Terkonfirmasi</label>
                                        @elseif($fullPayment->status == 'rejected')
                                            <label for="" class="badge badge-danger">Remaining Payment
                                                Ditolak</label>
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
