@extends('layouts.app')

@section('active-portfolio', 'active-page')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title">Portfolio Keiffa Decoration</h4>
            </div>
            <div class="col">
                <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary float-end btn-sm"
                    style="background-color: #7E4752; border-color: #fff;">Tambah Portfolio</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($portfolios as $portfolio)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/portfolios/' . $portfolio->image) }}" alt="Portfolio Image"
                                    class="img-fluid">
                            </div>
                            <div class="col-md-8 p-3">
                                <h5 class="card-title text-center">{{ $portfolio->package_name }}</h5>
                                <p class="card-title text-center">{{ $portfolio->venue_name }}</p>
                                <ul class="list-unstyled">
                                    <li><span class="fw-bold">Bride Name</span> : {{ $portfolio->bride_name }}</li>
                                    <li><span class="fw-bold">Groom Name</span> : {{ $portfolio->groom_name }}</li>
                                    <li><span class="fw-bold">Total Price</span> : Rp. {{
                                        number_format($portfolio->total_price, 0, ',', '.') }}</li>
                                    <li><span class="fw-bold">Code Order</span> : {{ $portfolio->code_order }}</li>
                                    <li><span class="fw-bold">Location</span> : {{ $portfolio->location }}</li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-end">
                                    <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}"
                                        class="btn btn-primary float-end btn-sm"
                                        style="background-color: #636F54; border-color: #fff;">Edit</a>
                                </div>
                                <div class="col-6 d-flex justify-content-start">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $portfolio->id }}" style="background-color: #7E4752; border-color: #fff;">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $portfolio->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Portfolio</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus portfolio ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin.portfolio.delete', $portfolio->id) }}" class="btn btn-primary" style="background-color: #7E4752; border-color: #fff;">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection