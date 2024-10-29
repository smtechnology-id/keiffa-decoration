@extends('layouts.app')

@section('active-additional', 'active-page')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Additional Kaiffa Decoration</h4>
                </div>
                <div class="col">
                    <a href="{{ route('admin.additional.create') }}" class="btn btn-primary float-end btn-sm"
                        style="background-color: #7E4752; border-color: #fff;">Tambah Additional</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($additionals as $additional)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $additional->nama }}</h5>
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('storage/additional/' . $additional->image) }}" alt="Image"
                                            style="max-width: 200px; margin-top: 10px; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Additional Number</td>
                                                <td>:</td>
                                                <td>{{ $additional->additional_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>Rp. {{ number_format($additional->harga, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>:</td>
                                                <td>{{ $additional->deskripsi }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-6 text-center d-flex justify-content-end">
                                        <a href="{{ route('admin.additional.edit', $additional->slug) }}"
                                            class="btn btn-primary float-end btn-sm"
                                            style="background-color: #636f54; border-color: #fff;">Edit</a>
                                    </div>
                                    <div class="col-6 text-center d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $additional->id }}"
                                            style="background-color: #7E4752; border-color: #fff;">
                                            Hapus
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $additional->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Additional</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus additional {{ $additional->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin.additional.delete', $additional->slug) }}"
                                                            class="btn btn-danger btn-sm"
                                                            style="background-color: #7E4752; border-color: #fff;">Hapus</a>
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
