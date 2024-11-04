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
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartCatalog as $cart)
                        <tr class="text-center">
                            <td>{{ $cart->package->nama }}</td>
                            <td>Rp. {{ number_format($cart->package->harga, 0, ',', '.') }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('user.cart.addQuantity', ['slug' => $cart->package->packageSlug]) }}" class="btn btn-primary mr-2" style="background-color: #7E4752; color: #fff;"><i class="fa fa-plus"></i></a>
                                <input type="number" class="form-control" value="{{ $cart->quantity }}" readonly style="width: 50px;">
                                <a href="{{ route('user.cart.subQuantity', ['slug' => $cart->package->packageSlug]) }}" class="btn btn-primary ml-2" style="background-color: #636F54; color: #fff;"><i class="fa fa-minus"></i></a>
                            </td>
                            <td>Rp. {{ number_format($cart->total_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
