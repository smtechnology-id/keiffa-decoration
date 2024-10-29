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
                                <th>ID Pembayaran</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
