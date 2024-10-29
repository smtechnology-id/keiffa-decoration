@extends('layouts.app')

@section('active-package', 'active-page')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Katalog / Package Kaiffa Decoration</h4>
                </div>
                <div class="col">
                    <a href="{{ route('admin.package.create') }}" class="btn btn-primary float-end btn-sm"
                        style="background-color: #7E4752; border-color: #fff;">Tambah Package</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $package->nama }}</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                            <b>Harga</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            Rp. {{ number_format($package->harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Properti</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->properti }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Jenis Bunga</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->jenis_bunga }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Pilihan Dekorasi Pelaminan</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->dekorasi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Luas Dekorasi Pelaminan</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->luas_dekorasi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Meja Angpao</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->meja_angpao }} pcs
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Kotak Angpao</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->kotak_angpao }} pcs
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Hand Bouquet</b>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ $package->hand_bouquet }} pcs
                                        </td>
                                    </tr>
                                </table>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-6 text-center d-flex justify-content-end">
                                        <a href="{{ route('admin.package.edit', $package->packageSlug) }}"
                                            class="btn btn-primary float-end btn-sm"
                                            style="background-color: #636f54; border-color: #fff;">Edit</a>
                                    </div>
                                    <div class="col-6 text-center d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $package->id }}" style="background-color: #7E4752; border-color: #fff;">
                                            Hapus
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $package->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Package</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus package {{ $package->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin.package.delete', $package->packageSlug) }}" class="btn btn-danger btn-sm" style="background-color: #7E4752; border-color: #fff;">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach`
            </div>
        </div>
    </div>
@endsection
