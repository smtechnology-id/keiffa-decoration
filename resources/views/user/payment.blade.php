@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    <h5>Halaman Detail Checkout </h5>

    <div class="card">
        <div class="card-body">
           <table class="table">
            <tr>
                <th>Sub Total Harga Paket Dekorasi Wedding</th>
                <td>Rp. {{ number_format($totalPackage, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Sub Total Harga Additional</th>
                <td>Rp. {{ number_format($totalAdditional, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td><span class="font-weight-bold" style="color: #7E4752;">Rp. {{ number_format($total_price, 0, ',', '.') }}</span></td>
            </tr>
           </table>
           <div class="row">
            <div class="col-md-6">
                <h5>Informasi Pembayaran</h5>
                <ul class="list-unstyled">
                    <li>Down Payment : Rp. {{ number_format($total_price * 0.3, 0, ',', '.') }}</li>
                    <li>Remaining Payment : Rp. {{ number_format($total_price * 0.7, 0, ',', '.') }}</li>
                    <li>Date of Remaining Payment : <span class="font-weight-bold" style="color: #7E4752;">{{ $dateRemainingPayment }}</span></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5 class="">Metode Pembayaran</h5>
                <ul class="list-unstyled">
                    <li>BCA : 3423052461 a/n Yuli Siswandining</li>
                    <li>Mandiri : 0700004218314 a/n Yuli Siswandining</li>
                </ul>
            </div>
            <div class="col-md-12">
                @if (!$downPayment)
                <form action="{{ route('user.payment.down') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-group">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="code_order" value="{{ $order->code_order }}">
                                <label for="down_payment">Upload Bukti Pembayaran Down Payment</label>
                                <input type="file" class="form-control" id="down_payment" name="down_payment" required>
                                @error('down_payment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center"> 
                            <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border: none;">Konfirmasi DP</button>
                        </div>
                    </div>
                </form>
                @else
                    <table class="table">
                        <tr>
                            <th>Bukti Pembayaran Down Payment</th>
                            <td><a href="{{ asset('storage/payment_proof/' . $downPayment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a></td>
                            <td>
                                Nominal Terverifikasi : Rp. {{ number_format($downPayment->nominal, 0, ',', '.') }}
                            </td>
                            <td>
                                @if ($downPayment->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @elseif($downPayment->status == 'confirmed')
                                    <span class="badge badge-success">Pembayaran Valid</span>
                                @endif
                            </td>
                            <td>{{ $downPayment->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                @endif
            </div>
            <div class="col-md-12">
                @if (!$remainingPayment)
                <form action="{{ route('user.payment.remaining') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-group">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="code_order" value="{{ $order->code_order }}">
                                <label for="remaining_payment">Upload Bukti Pembayaran Remaining Payment</label>
                                <input type="file" class="form-control" id="remaining_payment" name="remaining_payment" required>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            
                            <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border: none;">Konfirmasi Remaining Payment</button>
                        </div>
                    </div>
                </form>
                @else
                    <table class="table">
                        <tr>
                            <th>Bukti Pembayaran Remaining Payment</th>
                            <td><a href="{{ asset('storage/payment_proof/' . $remainingPayment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a></td>
                            <td>
                                @if ($remainingPayment->status == 'pending')
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @elseif($remainingPayment->status == 'confirmed')
                                    <span class="badge badge-success">Pembayaran Valid</span>
                                @endif
                            </td>
                            <td>{{ $remainingPayment->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                @endif
            </div>
           </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            
            <div class="row mb-3">
                @foreach ($package as $item)
                <div class="col-md-6">
                    <div class="card" style="">
                        <img src="{{ asset('storage/packages/' . $item->package->image) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text text-center">{{ $item->package->nama }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <h5>Description</h5>
                   <ul class="list-unstyled">
                    <li>Harga : Rp. {{ number_format($item->package->harga, 0, ',', '.') }}</li>
                    <li>Properti : {{ $item->package->properti }}</li>
                    <li>Jenis Bunga : {{ $item->package->jenis_bunga }}</li>
                    <li>Hand Bouquet : {{ $item->package->hand_bouquet }}</li>
                    <li>Dekorasi Pelaminan : {{ $item->package->dekorasi }}</li>
                    <li>Luas Dekorasi : {{ $item->package->luas_dekorasi }}</li>
                    <li>Meja Angpao : {{ $item->package->meja_angpao }}</li>
                    <li>Kotak Angpao : {{ $item->package->kotak_angpao }}</li>
                   </ul>
                   <hr>
                   <h5>Detail Pemesanan</h5>
                   <ul class="list-unstyled">
                    <li>Jumlah : {{ $item->quantity }} Item</li>
                    <li><span class="font-weight-bold" style="color: #7E4752;">Total Harga : Rp. {{ number_format($item->total_price, 0, ',', '.') }} </span></li>
                   </ul>
                </div>
                @endforeach
            </div>
            <h5 class="mb-3">Additional Paket Wedding</h5>
            <div class="row">
                @foreach ($additional as $item)
                <div class="col-md-4 mb-3">
                    <div class="card" style="">
                        <img src="{{ asset('storage/additional/' . $item->additional->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <span class="font-weight-bold" style="color: #7E4752;">Rp. {{ number_format($item->additional->harga, 0, ',', '.') }} x {{ $item->quantity }} = Rp. {{ number_format($item->total_price, 0, ',', '.') }}</span>
                          <p class="card-text mt-2">{{ $item->additional->nama }}</p>
                          <p class="card-text">{{ $item->additional->deskripsi }}</p>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>

           
        </div>
    </div>
</div>
@endsection