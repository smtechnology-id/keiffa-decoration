@extends('layouts.app')

@section('active-additional', 'active-page')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Portfolio</h5>
            <form action="{{ route('admin.portfolio.updatePost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ $portfolio->id }}">
                    <div class="col-md-4 d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('storage/portfolios/' . $portfolio->image) }}" alt="Image"
                            style="max-width: 100%; margin-top: 10px; height: 200px; object-fit: cover;">
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"
                            onchange="previewImage(event)">
                        <input type="hidden" name="oldImage" value="{{ $portfolio->image }}">
                        <img id="imagePreview" src="#" alt="Image Preview"
                            style="display:none; max-width:100%; margin-top:10px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="package_name">Nama Paket</label>
                            <input type="text" name="package_name" id="package_name" class="form-control"
                                placeholder="Nama Paket" required value="{{ $portfolio->package_name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="venue_name">Nama Venue</label>
                            <input type="text" name="venue_name" id="venue_name" class="form-control"
                                placeholder="Nama Venue" required value="{{ $portfolio->venue_name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="bride_name">Nama Pengantin Wanita</label>
                            <input type="text" name="bride_name" id="bride_name" class="form-control"
                                placeholder="Nama Pengantin Wanita" required value="{{ $portfolio->bride_name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="groom_name">Nama Pengantin Pria</label>
                            <input type="text" name="groom_name" id="groom_name" class="form-control"
                                placeholder="Nama Pengantin Pria" required value="{{ $portfolio->groom_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="total_price">Total Harga</label>
                            <input type="number" name="total_price" id="total_price" class="form-control"
                                placeholder="Total Harga" required value="{{ $portfolio->total_price }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="code_order">Kode Pesanan</label>
                            <input type="text" name="code_order" id="code_order" class="form-control"
                                placeholder="Kode Pesanan" required value="{{ $portfolio->code_order }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="location">Lokasi</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Lokasi"
                                required value="{{ $portfolio->location }}">
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border-color: #fff;">Update</button>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
