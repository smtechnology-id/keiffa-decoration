@extends('layouts.landing')

@section('content')
<div class="container mt-5 mb-5">
    <h3 class="text-center">Keranjang</h3>


    <div class="card">
        <div class="card-body" style="bo">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartCatalog as $cart)
                        <tr class="text-center">
                            <td>{{ $cart->package->nama }}</td>
                            <td>Rp. {{ number_format($cart->package->harga, 0, ',', '.') }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('user.cart.addQuantity', ['slug' => $cart->package->packageSlug]) }}"
                                    class="btn btn-primary mr-2" style="background-color: #7E4752; color: #fff;"><i
                                        class="fa fa-plus"></i></a>
                                <input type="number" class="form-control" value="{{ $cart->quantity }}" readonly
                                    style="width: 50px;">
                                <a href="{{ route('user.cart.subQuantity', ['slug' => $cart->package->packageSlug]) }}"
                                    class="btn btn-primary ml-2" style="background-color: #636F54; color: #fff;"><i
                                        class="fa fa-minus"></i></a>
                            </td>
                            <td>@if ($cart->jenis == 'package')
                                <span class="badge badge-primary" style="background-color: #7E4752; color: #fff;">Paket Dekorasi Wedding</span>
                                @else
                                <span class="badge badge-primary" style="background-color: #636F54; color: #fff;">Additional Dekorasi Wedding</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($cart->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        @foreach ($cartAdditional as $cart)
                        <tr class="text-center">
                            <td>{{ $cart->additional->nama }}</td>
                            <td>Rp. {{ number_format($cart->additional->harga, 0, ',', '.') }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('user.cart.addQuantity', ['slug' => $cart->additional->slug]) }}" class="btn btn-primary mr-2"
                                    style="background-color: #7E4752; color: #fff;"><i class="fa fa-plus"></i></a>
                                <input type="number" class="form-control" value="{{ $cart->quantity }}" readonly
                                    style="width: 50px;">
                                <a href="{{ route('user.cart.subQuantity', ['slug' => $cart->additional->slug]) }}" class="btn btn-primary ml-2"
                                    style="background-color: #636F54; color: #fff;"><i class="fa fa-minus"></i></a>
                            </td>
                            
                            <td>@if ($cart->jenis == 'package')
                                <span class="badge badge-primary" style="background-color: #7E4752; color: #fff;">Paket Dekorasi Wedding</span>
                                @else
                                <span class="badge badge-primary" style="background-color: #636F54; color: #fff;">Additional Dekorasi Wedding</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($cart->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Total Harga</td>
                            <td>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.checkout') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bride_name">Bride's Name</label>
                            <input type="text" name="bride_name" class="form-control" required placeholder="Nama Pengantin Perempuan">
                        </div>
                        <div class="form-group">
                            <label for="grooms_name">Groom's Name</label>
                            <input type="text" name="grooms_name" class="form-control" required placeholder="Nama Pengantin Laki-laki">
                        </div>
                        <div class="form-group">
                            <label for="wedding_theme">Wedding Theme</label>
                            <input type="text" name="wedding_theme" class="form-control" required placeholder="Tema Pernikahan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wedding_date">Wedding Date</label>
                            <input type="date" name="wedding_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="wedding_location">Wedding Location</label>
                            <input type="text" name="wedding_location" class="form-control" required placeholder="Lokasi Pernikahan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="background-color: #7E4752; color: #fff;">Lanjutkan ke Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection